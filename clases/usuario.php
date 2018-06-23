<?php
class Usuario{

    public $id;
    public $nombre;
    public $apellido;
    public $mail;
    public $password;
    public $tipo;


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
    public static function AltaUsuario($nombre,$apellido,$mail,$password,$tipo){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO `usuarios`(`nombre`, `apellido`, `mail`, `password`, `tipo`) VALUES (:nombre, :apellido, :mail, :password, :tipo)");
        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido',$apellido);
        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':password',$password);
        $consulta->bindValue(':tipo',$tipo);

        if ($consulta->execute()){
            $rta = "ok";
        }
        return $rta;
    }
}
?>