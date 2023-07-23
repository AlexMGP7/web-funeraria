<?php

class EstadoModel
{

    function __construct()
    {
    }

    // FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

    public static function Get_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        if (!$result = mysqli_query($conexion, $sql)) {
            die('Error in query: ' . mysqli_error($conexion)); // Print the error message
        }
        $conexion = conectar::desconexion($conexion);
        return $result;
    }

    public static function Update_Data($sql)
    {
        include_once('../../core/conectar.php');
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
        $sql_estado = "SELECT codigo, descripcion FROM estado ORDER BY codigo ASC";
        $result_estado = EstadoModel::Get_Data($sql_estado);
        return $result_estado;
    }

    // Para la insersión

    public static function BuscarUltimoEstado()
    {

        $sql_estado = "SELECT (max(codigo)) as identific FROM estado order BY codigo asc";
        $result_estado = EstadoModel::Get_Data($sql_estado);
        return $result_estado;
    }

    public static function IngresarEstado2($codigo, $descripcion)
    {

        $sql_estado = "INSERT INTO estado (codigo, descripcion) VALUES ($codigo, '$descripcion')";
        $result_estado = EstadoModel::Update_Data($sql_estado);
        return $result_estado;
    }

    // Para la actualización

    public static function BuscarEstadoByCodigo($codigo)
    {
        //$sql_estado = "SELECT codigo, descripcion FROM estado ORDER BY codigo ASC";
        $sql_estado = "SELECT codigo, descripcion FROM estado WHERE codigo = $codigo";
        $result_estado = EstadoModel::Get_Data($sql_estado);

        return $result_estado;
    }



    public static function UpdateEstado2($codigo, $descripcion)
    {
        $sql_estado = "UPDATE estado SET codigo = '$codigo', descripcion = '$descripcion' WHERE codigo = $codigo";
        $result_estado = EstadoModel::Update_Data($sql_estado);
        return $result_estado;
    }

    // Para eliminar

    public static function DeleteEstado($codigo)
    {
        $sql_estado = "DELETE FROM estado WHERE codigo = $codigo";
        $result_estado = EstadoModel::Update_Data($sql_estado);
        return $result_estado;
    }
    public static function CheckReferencedRecords($codigo)
    {
        // Verificar si hay municipios relacionados con el estado
        $sql_check_municipio = "SELECT COUNT(*) AS num_referenced_municipios FROM Municipio WHERE Estado_codigo = $codigo";
        $result_check_municipio = EstadoModel::Get_Data($sql_check_municipio);
        $row_municipio = mysqli_fetch_assoc($result_check_municipio);
        $num_referenced_municipios = $row_municipio['num_referenced_municipios'];

        // Verificar si hay parroquias relacionadas con el estado
        $sql_check_parroquia = "SELECT COUNT(*) AS num_referenced_parroquias FROM Parroquia WHERE Municipio_codigo IN (SELECT Codigo FROM Municipio WHERE Estado_codigo = $codigo)";
        $result_check_parroquia = EstadoModel::Get_Data($sql_check_parroquia);
        $row_parroquia = mysqli_fetch_assoc($result_check_parroquia);
        $num_referenced_parroquias = $row_parroquia['num_referenced_parroquias'];

        // Verificar si hay ciudades relacionadas con el estado
        $sql_check_ciudad = "SELECT COUNT(*) AS num_referenced_ciudades FROM Ciudad WHERE Parroquia_codigo IN (SELECT Codigo FROM Parroquia WHERE Municipio_codigo IN (SELECT Codigo FROM Municipio WHERE Estado_codigo = $codigo))";
        $result_check_ciudad = EstadoModel::Get_Data($sql_check_ciudad);
        $row_ciudad = mysqli_fetch_assoc($result_check_ciudad);
        $num_referenced_ciudades = $row_ciudad['num_referenced_ciudades'];

        // Si hay algún municipio, parroquia o ciudad relacionada, entonces no se puede eliminar el estado
        if ($num_referenced_municipios > 0 || $num_referenced_parroquias > 0 || $num_referenced_ciudades > 0) {
            return true;
        }

        return false;
    }
}
