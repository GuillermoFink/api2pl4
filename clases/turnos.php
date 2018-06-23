<?php
class Usuario{

    public $id;
    public $id_mascota;
    public $fecha;
    public $estado;


    public static function Login($mail, $password){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE mail=:mail AND password=:password");
        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':password', $password);
        if ($consulta->execute()){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if (isset($datos[0]['nombre'])){
                //$datos=json_encode($datos); 
                return AutentificadorJWT::CrearToken($datos);
            }
        }
        return $rta;
    }
}
?>