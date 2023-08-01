<?php
class PolizasModel
{
    function __construct()
    {
    }

    public static function Get_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        if (!$result = mysqli_query($conexion, $sql)) {
            die('Error en la consulta: ' . mysqli_error($conexion));
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

    public static function ListarPolizas()
    {
        $sql_polizas = "SELECT Numero, fecha_apertura, fecha_cierre, cuota_anual, cuota_mensual, observaciones FROM polizas_de_seguro ORDER BY Numero ASC";
        $result_polizas = PolizasModel::Get_Data($sql_polizas);
        return $result_polizas;
    }

    public static function IngresarPoliza($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones)
    {
        $sql_polizas = "INSERT INTO polizas_de_seguro (Numero, fecha_apertura, fecha_cierre, cuota_anual, cuota_mensual, observaciones) VALUES ('$numero', '$fecha_apertura', '$fecha_cierre', '$cuota_anual', '$cuota_mensual', '$observaciones')";
        $result_polizas = PolizasModel::Update_Data($sql_polizas);
        return $result_polizas;
    }

    public static function BuscarPolizaPorNumero($numero)
    {
        $sql_polizas = "SELECT Numero, fecha_apertura, fecha_cierre, cuota_anual, cuota_mensual, observaciones FROM polizas_de_seguro WHERE Numero = '$numero'";
        $result_polizas = PolizasModel::Get_Data($sql_polizas);
        return $result_polizas;
    }

    // Función para buscar el último número de póliza utilizado en el modelo.
    public static function BuscarUltimoNumeroPoliza()
    {
        $sql_polizas = "SELECT MAX(Numero) AS ultimo_numero FROM polizas_de_seguro";
        $result_polizas = PolizasModel::Get_Data($sql_polizas);
        return $result_polizas; // Devuelve el resultado de la consulta que contiene el último número de póliza.
    }

    public static function UpdatePoliza($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones)
    {
        $sql_polizas = "UPDATE polizas_de_seguro SET fecha_apertura = '$fecha_apertura', fecha_cierre = '$fecha_cierre', cuota_anual = '$cuota_anual', cuota_mensual = '$cuota_mensual', observaciones = '$observaciones' WHERE Numero = '$numero'";
        $result_polizas = PolizasModel::Update_Data($sql_polizas);
        return $result_polizas;
    }

    public static function DeletePoliza($numero)
    {
        $sql_polizas = "DELETE FROM polizas_de_seguro WHERE Numero = '$numero'";
        $result_polizas = PolizasModel::Update_Data($sql_polizas);
        return $result_polizas;
    }
}