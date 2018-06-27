<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/AutentificadorJWT.php';

require_once './clases/usuario.php';
require_once './clases/mascota.php';
require_once './clases/turnos.php';

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

$app->get('/traerTodasLasMascotas', function (Request $request, Response $response) {
    
    $newResponse = $response->withJson(Mascota::TraerTodasLasMascotas());
    return $newResponse;
});

$app->get('/traerTodosLosTurnos', function (Request $request, Response $response) {
    
    $newResponse = $response->withJson(Turnos::TraerTodosLosTurnos());
    return $newResponse;
});

$app->get('/traerTodosLosUsuarios', function (Request $request, Response $response) {
    
    $newResponse = $response->withJson(Usuario::TraerTodosLosUsuarios());
    return $newResponse;
});

$app->post('/login', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $mail = $datos["mail"];
    $pw = $datos["password"];
    $newResponse = $response->withJson(Usuario::Login($mail,$pw));
    return $newResponse;
});

$app->post('/altaUsuario', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $nombre = $datos["nombre"];
    $apellido = $datos["apellido"];
    $mail = $datos["mail"];
    $password = $datos["password"];
    $tipo = $datos["tipo"];
    $newResponse = $response->withJson(Usuario::AltaUsuario($nombre,$apellido,$mail,$password,$tipo));
    return $newResponse;
});

$app->post('/modificarUsuario', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id = $datos["id"];
    $nombre = $datos["nombre"];
    $apellido = $datos["apellido"];
    $mail = $datos["mail"];
    $tipo = $datos["tipo"];
    $newResponse = $response->withJson(Usuario::ModificarUsuario($id,$nombre,$apellido,$mail,$tipo));
    return $newResponse;
});

$app->post('/traerMascotaPorId', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id = $datos["id_mascota"];
    $newResponse = $response->withJson(Mascota::TraerMascotaPorId($id));
    return $newResponse;
});

$app->post('/traerMascotasPorDuenio', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id = $datos["id_usuario"];
    $newResponse = $response->withJson(Mascota::TraerMascotasPorDuenio($id));
    return $newResponse;
});

$app->post('/agregarMascota', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id = $datos["id_usuario"];
    $raza = $datos["raza"];
    $color = $datos["color"];
    $edad = $datos["edad"];
    $tipo = $datos["tipo"];
    $newResponse = $response->withJson(Mascota::AgregarMascota($id,$raza,$color,$edad,$tipo));
    return $newResponse;
});

$app->post('/modificarMascota', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id = $datos["id"];
    $raza = $datos["raza"];
    $color = $datos["color"];
    $edad = $datos["edad"];
    $tipo = $datos["tipo"];
    $newResponse = $response->withJson(Mascota::ModificarMascota($id,$raza,$color,$edad,$tipo));
    return $newResponse;
});

$app->post('/agregarTurno', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id_mascota = $datos["id_mascota"];
    $fecha = $datos["fecha"];
    $estado = $datos["estado"];
    $descripcion = $datos["descripcion"];
    $newResponse = $response->withJson(Turnos::AgregarTurno($id_mascota,$fecha,$estado,$descripcion));
    return $newResponse;
});
$app->post('/actualizarTurno', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id = $datos["id"];
    $estado = $datos["estado"];
    $descripcion = $datos["descripcion"];
    $newResponse = $response->withJson(Turnos::ModificarTurno($id,$estado,$descripcion));
    return $newResponse;
});
$app->post('/traerMisTurnos', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $id_usuario = $datos["id_usuario"];
    $newResponse = $response->withJson(Turnos::TraerMisTurnos($id_usuario));
    return $newResponse;
});

$app->run();
?>