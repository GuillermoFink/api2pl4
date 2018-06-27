<?php
class Mascota{

    public $id;
    public $id_usuario;
    public $raza;
    public $color;
    public $edad;
    public $tipo;

    public static function TraerTodasLasMascotas(){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM mascotas");
        if ($consulta->execute()){
            $rta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        return $rta;
    }

    public static function AgregarMascota($id_usuario,$raza,$color,$edad,$tipo){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO `mascotas`(`id_usuario`, `raza`, `color`, `edad`, `tipo`) VALUES (:id_usuario, :raza, :color, :edad, :tipo)");
        $consulta->bindValue(':id_usuario',$id_usuario);
        $consulta->bindValue(':raza',$raza);
        $consulta->bindValue(':color',$color);
        $consulta->bindValue(':edad',$edad);
        $consulta->bindValue(':tipo',$tipo);
        if ($consulta->execute()){
            $rta = "ok";
        }
        return $rta;
    }

    public static function TraerMascotaPorId($id_mascota){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM mascotas WHERE id = :id_mascota");
        $consulta->bindValue(':id_mascota',$id_mascota);
        if ($consulta->execute()){
            $rta = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $rta;
        }
        return $rta;
    }

    public static function TraerMascotasPorDuenio($id_duenio){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM mascotas WHERE id_usuario = :id_duenio");
        $consulta->bindValue(':id_duenio',$id_duenio);
        if ($consulta->execute()){
            $rta = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $rta;
        }
        return $rta;
    }

    public static function ModificarMascota($id,$raza,$color,$edad,$tipo){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `mascotas` SET `raza`=:raza,`color`=:color,`edad`=:edad,`tipo`=:tipo WHERE id = :id");
        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':raza',$raza);
        $consulta->bindValue(':color',$color);
        $consulta->bindValue(':edad',$edad);
        $consulta->bindValue(':tipo',$tipo);
        if ($consulta->execute()){
            $rta = "ok";
        }
        return $rta;
    }
}
?>