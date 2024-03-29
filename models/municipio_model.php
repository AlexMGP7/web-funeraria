<?php
class MunicipioModel
{
    function __construct()
    {
    }

    // FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

    public static function Get_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        if (!$result = mysqli_query($conexion, $sql))
            die();
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
            } else // si hizo la actualizacion
            {
                mysqli_commit($conexion);
                $result = true;
            }
        }

        $conexion = conectar::desconexion($conexion);

        return $result;
    }


    // para el resto de las operaciones


    public static function ListarMunicipio()
    {
        $sql_municipio = "SELECT m.codigo, m.descripcion, e.descripcion AS estado_descripcion 
                          FROM municipio AS m 
                          INNER JOIN estado AS e ON m.Estado_Codigo = e.codigo 
                          ORDER BY m.codigo ASC";
        $result_municipio = MunicipioModel::Get_Data($sql_municipio);
        return $result_municipio;
    }

    // Para la insersión

    public static function BuscarUltimoMunicipio()
    {
        $sql_municipio = "SELECT (max(codigo)) as identific FROM municipio";
        $result_municipio = MunicipioModel::Get_Data($sql_municipio);
        return $result_municipio;
    }

    public static function IngresarMunicipio2($codigo, $descripcion, $estado_codigo)
    {
            require_once('../../core/conectar.php');
            $conexion = conectar::conexion();
            $sql_municipio = "INSERT INTO municipio (codigo, descripcion, Estado_Codigo) VALUES ($codigo, '$descripcion', $estado_codigo)";
            $result_municipio = mysqli_query($conexion, $sql_municipio);
            return $result_municipio;

    }

    // Para la actualización

    public static function BuscarMunicipioByCodigo($codigo)
    {
        $sql_municipio = "SELECT m.codigo, m.descripcion AS municipio_descripcion,
                             e.codigo AS estado_codigo, e.descripcion AS estado_descripcion
                      FROM municipio AS m
                      INNER JOIN estado AS e ON m.Estado_codigo = e.Codigo
                      WHERE m.codigo = $codigo";

        $result_municipio = MunicipioModel::Get_Data($sql_municipio);
        return $result_municipio;
    }

    public static function UpdateMunicipio2($codigo, $descripcion, $estado_codigo)
    {
        $sql_municipio = "UPDATE municipio SET codigo = '$codigo', descripcion = '$descripcion', Estado_Codigo = $estado_codigo WHERE codigo = $codigo";
        $result_municipio = MunicipioModel::Update_Data($sql_municipio);
        return $result_municipio;
    }

    // Para eliminar

    public static function DeleteMunicipio($codigo)
    {
        $sql_municipio = "DELETE FROM municipio WHERE codigo = $codigo";
        $result_municipio = MunicipioModel::Update_Data($sql_municipio);
        return $result_municipio;
    }

    public static function CheckReferencedRecords($codigo)
    {
        // Verificar si hay parroquias relacionadas con el municipio
        $sql_check_parroquia = "SELECT COUNT(*) AS num_referenced_parroquias FROM Parroquia WHERE Municipio_codigo = $codigo";
        $result_check_parroquia = MunicipioModel::Get_Data($sql_check_parroquia);
        $row_parroquia = mysqli_fetch_assoc($result_check_parroquia);
        $num_referenced_parroquias = $row_parroquia['num_referenced_parroquias'];

        // Verificar si hay ciudades relacionadas con el municipio
        $sql_check_ciudad = "SELECT COUNT(*) AS num_referenced_ciudades FROM Ciudad WHERE Parroquia_codigo IN (SELECT Codigo FROM Parroquia WHERE Municipio_codigo = $codigo)";
        $result_check_ciudad = MunicipioModel::Get_Data($sql_check_ciudad);
        $row_ciudad = mysqli_fetch_assoc($result_check_ciudad);
        $num_referenced_ciudades = $row_ciudad['num_referenced_ciudades'];

        // Si hay alguna parroquia o ciudad relacionada, entonces no se puede eliminar el municipio
        if ($num_referenced_parroquias > 0 || $num_referenced_ciudades > 0) {
            return true;
        }

        return false;
    }

}
