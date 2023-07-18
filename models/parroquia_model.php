<?php
class ParroquiaModel
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

    public static function ListarParroquia()
    {
        $sql_parroquia = "SELECT p.codigo, p.descripcion, m.descripcion AS municipio_descripcion, e.descripcion AS estado_descripcion 
                          FROM parroquia AS p 
                          INNER JOIN municipio AS m ON p.Municipio_Codigo = m.codigo
                          INNER JOIN estado AS e ON m.Estado_Codigo = e.codigo 
                          ORDER BY p.codigo ASC";
        $result_parroquia = ParroquiaModel::Get_Data($sql_parroquia);
        return $result_parroquia;
    }


    public static function BuscarUltimaParroquia()
    {
        $sql_parroquia = "SELECT MAX(codigo) AS identific FROM parroquia";
        $result_parroquia = ParroquiaModel::Get_Data($sql_parroquia);
        return $result_parroquia;
    }

    public static function IngresarParroquia2($codigo, $descripcion, $municipio_codigo)
    {
        try {
            require_once('../../core/conectar.php');
            $conexion = conectar::conexion();
            $sql_parroquia = "INSERT INTO parroquia (codigo, descripcion, Municipio_Codigo) VALUES ($codigo, '$descripcion', $municipio_codigo)";
            $result_parroquia = mysqli_query($conexion, $sql_parroquia);

            if (!$result_parroquia) {
                if (mysqli_errno($conexion) === 1062) {
                    throw new Exception("Error: La parroquia con el código $codigo ya existe.");
                } else {
                    throw new Exception(mysqli_error($conexion));
                }
            }

            $conexion = conectar::desconexion($conexion);

            return true;
        } catch (Exception $e) {
            throw new Exception("Error al agregar la parroquia: " . $e->getMessage());
        }
    }

    public static function BuscarParroquiaByCodigo($codigo)
    {
        $sql_parroquia = "SELECT * FROM parroquia WHERE codigo = $codigo";
        $result_parroquia = ParroquiaModel::Get_Data($sql_parroquia);
        return $result_parroquia;
    }

    public static function UpdateParroquia2($codigo, $descripcion, $municipio_codigo)
    {
        $sql_parroquia = "UPDATE parroquia SET codigo = '$codigo', descripcion = '$descripcion', Municipio_Codigo = $municipio_codigo WHERE codigo = $codigo";
        $result_parroquia = ParroquiaModel::Update_Data($sql_parroquia);
        return $result_parroquia;
    }

    public static function DeleteParroquia($codigo)
    {
        $sql_parroquia = "DELETE FROM parroquia WHERE codigo = $codigo";
        $result_parroquia = ParroquiaModel::Update_Data($sql_parroquia);
        return $result_parroquia;
    }
}