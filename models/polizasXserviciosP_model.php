<?php
class PolizasXservicioPModel
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

    public static function ListarPolizasXservicioP()
    {
        $sql_polizas_x_servicioP = "SELECT Polizas_De_Seguro_Numero, Servicios_Prestados_Codigo FROM Polizas_De_Seguro_has_Servicios_Prestados";
        $result_polizas_x_servicioP = PolizasXservicioPModel::Get_Data($sql_polizas_x_servicioP);
        return $result_polizas_x_servicioP;
    }

    public static function IngresarPolizasXservicioP($poliza_numero, $servicios_prestados_codigo)
    {
        $sql_polizas_x_servicioP = "INSERT INTO Polizas_De_Seguro_has_Servicios_Prestados (Polizas_De_Seguro_Numero, Servicios_Prestados_Codigo) VALUES ('$poliza_numero', '$servicios_prestados_codigo')";
        $result_polizas_x_servicioP = PolizasXservicioPModel::Update_Data($sql_polizas_x_servicioP);
        return $result_polizas_x_servicioP;
    }

    public static function BuscarPolizasXservicioP($poliza_numero, $servicios_prestados_codigo)
    {
        $sql_polizas_x_servicioP = "SELECT Polizas_De_Seguro_Numero, Servicios_Prestados_Codigo FROM Polizas_De_Seguro_has_Servicios_Prestados WHERE Polizas_De_Seguro_Numero = '$poliza_numero' AND Servicios_Prestados_Codigo = '$servicios_prestados_codigo'";
        $result_polizas_x_servicioP = PolizasXservicioPModel::Get_Data($sql_polizas_x_servicioP);
        return $result_polizas_x_servicioP;
    }

    public static function DeletePolizasXservicioP($poliza_numero, $servicios_prestados_codigo)
    {
        $sql_polizas_x_servicioP = "DELETE FROM Polizas_De_Seguro_has_Servicios_Prestados WHERE Polizas_De_Seguro_Numero = '$poliza_numero' AND Servicios_Prestados_Codigo = '$servicios_prestados_codigo'";
        $result_polizas_x_servicioP = PolizasXservicioPModel::Update_Data($sql_polizas_x_servicioP);
        return $result_polizas_x_servicioP;
    }
}
?>