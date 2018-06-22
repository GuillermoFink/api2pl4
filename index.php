<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/AutentificadorJWT.php';

require_once './clases/usuario.php';
require_once './clases/chofer.php';
require_once './clases/cliente.php';
require_once './clases/encargado.php';
require_once './clases/vehiculo.php';
require_once './clases/viaje.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

$mdAuth = function ( $request, $response , $next) {
    $token = $request->getHeader('token');
    if(AutentificadorJWT::verificarToken($token[0])){
        $response = $next($request,$response);
    }
    return $response;  
};

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework WAZAAAA");
    return $response;

});

$app->post('/login', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    return Usuario::Login($datos["mail"],$datos["password"]);
});


$app->run();
?>