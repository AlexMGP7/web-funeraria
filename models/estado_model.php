<?php

class estado_model
{

    function __construct()
    {
    }

    // FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

    public static function Get_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        if (!$result = mysqli_query($conexion, $sql)) die();
        $conexion = conectar::desconexion($conexion);
        return $result;
    }

    public static function Update_Data($sql)
    {
        include_once('core/conectar.php');
        $conexion = conectar::conexion();
        mysqli_autocommit($conexion, FALSE);
        $result = mysqli_query($conexion, $sql);

        if ($result == true) // la consulta fue exitosa
        {
            if (mysqli_affected_rows($conexion) == 0) // si no hizo la actualizacion
            {
                mysqli_rollback($conexion);
                $result = false;
            } else   // si hizo la actualizacion
            {
                mysqli_commit($conexion);
                $result = true;
            }
        }

        $conexion = conectar::desconexion($conexion);

        return $result;
    }


    // para el resto de las operaciones


    public static function ListarEstado()
    {
        $sql_estado = "SELECT codigo, trim(descripcion) as descripcion FROM estado ORDER BY codigo asc";
        $result_estado = estado_model::Get_Data($sql_estado);
        return $result_estado;
    }

    // Para la insersión

    public static function BuscarUltimoEstado()
    {

        $sql_estado = "SELECT (max(codigo)) as identific FROM estado order BY codigo asc";
        $result_estado = estado_model::Get_Data($sql_estado);
        return $result_estado;
    }

    public static function IngresarEstado2($codigo, $descripcion)
    {

        $sql_estado = "INSERT INTO estado (codigo, descripcion) VALUES ($codigo, '$descripcion')";
        $result_estado = estado_model::Update_Data($sql_estado);
        return $result_estado;
    }

    // Para la actualización

    public static function BuscarEstadoByCodigo($codigo)
    {
        $sql_estado = "SELECT * FROM estado WHERE codigo = $codigo";
        $result_estado = estado_model::Get_Data($sql_estado);
        return $result_estado;
    }

    public static function UpdateEstado2($codigo, $descripcion)
    {

        $sql_estado = "UPDATE estado SET titular = '$descripcion' WHERE id = $codigo";
        $result_estado = estado_model::Update_Data($sql_estado);
        return $result_estado;
    }


    // Para eliminar

    public static function DeleteEstado($codigo)
    {
        $sql_estado = "DELETE FROM estado WHERE codigo = $codigo";
        $result_estado = estado_model::Update_Data($sql_estado);
        return $result_estado;
    }
}
