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
        $sql_pagos_mensuales = "SELECT numero, fecha, monto, numero_poliza FROM pagos_mensuales ORDER BY numero ASC";
        $result_pagos_mensuales = PagoMModel::Get_Data($sql_pagos_mensuales);
        return $result_pagos_mensuales;
    }

    // Para la insersión
    public static function IngresarPagoM($numero, $fecha, $monto, $numero_poliza)
    {
        $sql_pago_mensual = "INSERT INTO pagos_mensuales (numero, fecha, monto, numero_poliza) VALUES ('$numero', '$fecha', '$monto', '$numero_poliza')";
        $result_pago_mensual = PagoMModel::Update_Data($sql_pago_mensual);
        return $result_pago_mensual;
    }

    // Para la actualización
    public static function UpdatePagoM($numero, $fecha, $monto, $numero_poliza)
    {
        $sql_pago_mensual = "UPDATE pagos_mensuales SET fecha = '$fecha', monto = '$monto', numero_poliza = '$numero_poliza' WHERE numero = '$numero'";
        $result_pago_mensual = PagoMModel::Update_Data($sql_pago_mensual);
        return $result_pago_mensual;
    }

    public static function BuscarUltimoPagoM()
    {
        $sql_pago_mensual = "SELECT * FROM pagos_mensuales ORDER BY numero DESC LIMIT 1";
        $result_pago_mensual = PagoMModel::Get_Data($sql_pago_mensual);
        return $result_pago_mensual;
    }

    public static function BuscarPagoMPorNumero($numero)
    {
        $sql_pago_mensual = "SELECT numero, fecha, monto, numero_poliza FROM pagos_mensuales WHERE numero = '$numero'";
        $result_pago_mensual = PagoMModel::Get_Data($sql_pago_mensual);
        return $result_pago_mensual;
    }

    // Para eliminar
    public static function DeletePagoM($numero)
    {
        $sql_pago_mensual = "DELETE FROM pagos_mensuales WHERE numero = '$numero'";
        $result_pago_mensual = PagoMModel::Update_Data($sql_pago_mensual);
        return $result_pago_mensual;
    }
}
?>
