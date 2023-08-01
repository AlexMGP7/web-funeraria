<?php
class FunerariaModel
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
            die('Error in query: ' . mysqli_error($conexion));
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

    // Para el resto de las operaciones
    public static function ListarFunerarias()
    {
        $sql_funeraria = "SELECT f.rif, f.tipo
                    FROM funeraria f
                    ORDER BY f.rif ASC";
        $result_funeraria = FunerariaModel::Get_Data($sql_funeraria);
        return $result_funeraria;
    }

    // Para la insersión
    public static function IngresarFuneraria($rif, $tipo)
    {
        $sql_funeraria = "INSERT INTO funeraria (rif, tipo) VALUES ('$rif', '$tipo')";
        $result_funeraria = FunerariaModel::Update_Data($sql_funeraria);
        return $result_funeraria;
    }

    // Para la actualización
    public static function BuscarFunerariaByRif($rif)
    {
        $sql_funeraria = "SELECT rif, tipo FROM funeraria WHERE rif = '$rif'";
        $result_funeraria = FunerariaModel::Get_Data($sql_funeraria);
        return $result_funeraria;
    }

    public static function BuscarUltimaFuneraria()
    {
        $sql_funeraria = "SELECT * FROM funeraria ORDER BY rif DESC LIMIT 1";
        $result_funeraria = FunerariaModel::Get_Data($sql_funeraria);
        return $result_funeraria;
    }

    public static function UpdateFuneraria($rif, $tipo)
    {
        $sql_funeraria = "UPDATE funeraria SET rif = '$rif', tipo = '$tipo' WHERE rif = '$rif'";
        $result_funeraria = FunerariaModel::Update_Data($sql_funeraria);
        return $result_funeraria;
    }

    // Para eliminar
    public static function DeleteFuneraria($rif)
    {
        $sql_funeraria = "DELETE FROM funeraria WHERE rif = '$rif'";
        $result_funeraria = FunerariaModel::Update_Data($sql_funeraria);
        return $result_funeraria;
    }
}
?>