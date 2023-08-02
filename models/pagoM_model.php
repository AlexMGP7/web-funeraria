<?php
class PagoMModel
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
    public static function ListarPagoM()
    {
        $sql_pagoM = "SELECT numero, fecha, monto, numero_poliza FROM pago_mensual ORDER BY numero ASC";
        $result_pagoM = PagoMModel::Get_Data($sql_pagoM);
        return $result_pagoM;
    }

    // Para la insersión
    public static function IngresarPagoM($numero, $fecha, $monto, $numero_poliza)
    {
        $sql_pagoM = "INSERT INTO pago_mensual (numero, fecha, monto, numero_poliza) VALUES ('$numero', '$fecha', '$monto', '$numero_poliza')";
        $result_pagoM = PagoMModel::Update_Data($sql_pagoM);
        return $result_pagoM;
    }

    // Para la actualización
    public static function BuscarPagoMByNumero($numero)
    {
        $sql_pagoM = "SELECT numero, fecha, monto, numero_poliza FROM pago_mensual WHERE numero = '$numero'";
        $result_pagoM = PagoMModel::Get_Data($sql_pagoM);
        return $result_pagoM;
    }

    public static function BuscarUltimoPagoM()
    {
        $sql_pagoM = "SELECT * FROM pago_mensual ORDER BY numero DESC LIMIT 1";
        $result_pagoM = PagoMModel::Get_Data($sql_pagoM);
        return $result_pagoM;
    }

    public static function UpdatePagoM($numero, $fecha, $monto, $numero_poliza)
    {
        $sql_pagoM = "UPDATE pago_mensual SET fecha = '$fecha', monto = '$monto', numero_poliza = '$numero_poliza' WHERE numero = '$numero'";
        $result_pagoM = PagoMModel::Update_Data($sql_pagoM);
        return $result_pagoM;
    }

    // Para eliminar
    public static function DeletePagoM($numero)
    {
        $sql_pagoM = "DELETE FROM pago_mensual WHERE numero = '$numero'";
        $result_pagoM = PagoMModel::Update_Data($sql_pagoM);
        return $result_pagoM;
    }
}
?>
