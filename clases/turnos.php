<?php
class Turnos{

    public $id;
    public $id_mascota;
    public $fecha;
    public $estado;
    public $descripcion;


    public static function AgregarTurno($id_mascota, $fecha, $estado,$descripcion){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO `turnos`(`id_mascota`, `fecha`, `estado`, `descripcion`) VALUES (:id_mascota,:fecha,1,:descripcion)");
        $consulta->bindValue(':id_mascota',$id_mascota);
        $consulta->bindValue(':fecha',$fecha);
        $consulta->bindValue(':descripcion',$descripcion);
        if ($consulta->execute()){
            $rta = "ok";
        }
        return $rta;
    }

    public static function TraerMisTurnos($id_usuario){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT t.id, t.id_mascota, m.raza, m.color, t.fecha,t.estado,t.descripcion
                                                        FROM turnos AS t, mascotas AS m, usuarios AS u
                                                        WHERE m.id = t.id_mascota
                                                        AND m.id_usuario = :id_usuario
                                                        GROUP BY t.id
                                                        ORDER BY t.fecha ASC");
        $consulta->bindValue(':id_usuario',$id_usuario);
        if ($consulta->execute()){
            $rta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        return $rta;
    }
    public static function TraerTodosLosTurnos(){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT t.id,u.nombre,u.apellido, t.id_mascota, m.raza, m.color, t.fecha,t.estado,t.descripcion
                                                        FROM turnos AS t, mascotas AS m, usuarios AS u
                                                        WHERE m.id = t.id_mascota
                                                        AND m.id_usuario = u.id
                                                        GROUP BY t.id
                                                        ORDER BY t.fecha ASC ");
        if ($consulta->execute()){
            $rta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        return $rta;
    }
    public static function ModificarTurno($id,$estado,$descripcion){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `turnos` SET `estado`=:estado,`descripcion`=:descripcion WHERE id=:id");
        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':estado',$estado);
        $consulta->bindValue(':descripcion',$descripcion);
        if ($consulta->execute()){
            $rta = 'ok';
        }
        return $rta;
    }
}
?>