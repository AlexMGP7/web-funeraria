<?php
class CiudadModel
{
    function __construct()
    {
    }

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

        if ($result == true) {
            if (mysqli_affected_rows($conexion) == 0) {
                mysqli_rollback($conexion);
                $result = false;
            } else {
                mysqli_commit($conexion);
                $result = true;
            }
        }

        $conexion = conectar::desconexion($conexion);

        return $result;
    }

    public static function ListarCiudad()
    {
        $sql_ciudad = "SELECT c.codigo, c.descripcion, p.descripcion AS parroquia_descripcion, m.descripcion AS municipio_descripcion, e.descripcion AS estado_descripcion 
                       FROM ciudad AS c 
                       INNER JOIN parroquia AS p ON c.Parroquia_Codigo = p.codigo
                       INNER JOIN municipio AS m ON p.Municipio_Codigo = m.codigo
                       INNER JOIN estado AS e ON m.Estado_Codigo = e.codigo 
                       ORDER BY c.codigo ASC";
        $result_ciudad = CiudadModel::Get_Data($sql_ciudad);
        return $result_ciudad;
    }

    public static function BuscarUltimaCiudad()
    {
        $sql_ciudad = "SELECT MAX(codigo) AS identific FROM ciudad";
        $result_ciudad = CiudadModel::Get_Data($sql_ciudad);
        return $result_ciudad;
    }

    public static function IngresarCiudad2($codigo, $descripcion, $parroquia_codigo)
    {
        try {
            require_once('../../core/conectar.php');
            $conexion = conectar::conexion();
            $sql_ciudad = "INSERT INTO ciudad (codigo, descripcion, Parroquia_Codigo) VALUES ($codigo, '$descripcion', $parroquia_codigo)";
            $result_ciudad = mysqli_query($conexion, $sql_ciudad);

            if (!$result_ciudad) {
                if (mysqli_errno($conexion) === 1062) {
                    throw new Exception("Error: La ciudad con el código $codigo ya existe.");
                } else {
                    throw new Exception(mysqli_error($conexion));
                }
            }

            $conexion = conectar::desconexion($conexion);

            return true;
        } catch (Exception $e) {
            throw new Exception("Error al agregar la ciudad: " . $e->getMessage());
        }
    }

    public static function BuscarCiudadByCodigo($codigo)
    {
        $sql_ciudad = "SELECT * FROM ciudad WHERE codigo = $codigo";
        $result_ciudad = CiudadModel::Get_Data($sql_ciudad);
        return $result_ciudad;
    }


    public static function UpdateCiudad2($codigo, $descripcion, $parroquia_codigo)
    {
        $sql_ciudad = "UPDATE ciudad SET codigo = '$codigo', descripcion = '$descripcion', Parroquia_Codigo = $parroquia_codigo WHERE codigo = $codigo";
        $result_ciudad = CiudadModel::Update_Data($sql_ciudad);
        return $result_ciudad;
    }

    public static function DeleteCiudad($codigo)
    {
        $sql_ciudad = "DELETE FROM ciudad WHERE codigo = $codigo";
        $result_ciudad = CiudadModel::Update_Data($sql_ciudad);
        return $result_ciudad;
    }
}
