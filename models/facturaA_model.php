<?php
class FacturaAModel
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
    public static function ListarFacturaA()
    {
        $sql_facturaA = "SELECT numero, fecha, monto, numero_poliza FROM factura_anual ORDER BY numero ASC";
        $result_facturaA = FacturaAModel::Get_Data($sql_facturaA);
        return $result_facturaA;
    }

    // Para la insersión
    public static function IngresarFacturaA($numero, $fecha, $monto, $numero_poliza)
    {
        $sql_facturaA = "INSERT INTO factura_anual (numero, fecha, monto, numero_poliza) VALUES ('$numero', '$fecha', '$monto', '$numero_poliza')";
        $result_facturaA = FacturaAModel::Update_Data($sql_facturaA);
        return $result_facturaA;
    }

    // Para la actualización
    public static function BuscarFacturaAByNumero($numero)
    {
        $sql_facturaA = "SELECT numero, fecha, monto, numero_poliza FROM factura_anual WHERE numero = '$numero'";
        $result_facturaA = FacturaAModel::Get_Data($sql_facturaA);
        return $result_facturaA;
    }

    public static function BuscarUltimaFacturaA()
    {
        $sql_facturaA = "SELECT * FROM factura_anual ORDER BY numero DESC LIMIT 1";
        $result_facturaA = FacturaAModel::Get_Data($sql_facturaA);
        return $result_facturaA;
    }

    public static function UpdateFacturaA($numero, $fecha, $monto, $numero_poliza)
    {
        $sql_facturaA = "UPDATE factura_anual SET fecha = '$fecha', monto = '$monto', numero_poliza = '$numero_poliza' WHERE numero = '$numero'";
        $result_facturaA = FacturaAModel::Update_Data($sql_facturaA);
        return $result_facturaA;
    }

    // Para eliminar
    public static function DeleteFacturaA($numero)
    {
        $sql_facturaA = "DELETE FROM factura_anual WHERE numero = '$numero'";
        $result_facturaA = FacturaAModel::Update_Data($sql_facturaA);
        return $result_facturaA;
    }
}
?>
