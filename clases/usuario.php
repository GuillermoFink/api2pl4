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

    public static function TraerTodosLosUsuarios(){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");
        if($consulta->execute()){
            $rta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        return $rta;
    }

    public static function ModificarUsuario($id,$nombre,$apellido,$mail,$tipo){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `usuarios` SET `nombre`=:nombre,`apellido`=:apellido,`mail`=:mail,`tipo`=:tipo WHERE id=:id");
        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido',$apellido);
        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':tipo',$tipo);
        if($consulta->execute()){
            $rta = "ok";
        }
        return $rta;
    }
}
?>