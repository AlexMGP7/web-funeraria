<?php
class PolizaXdifuntoModel
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
     public static function ListarPolizasXdifunto()
    {
        $sql_polizas_x_difunto = "SELECT Difunto_cedula, Polizas_De_Seguro_Numero FROM Difunto_has_Polizas_De_Seguro";
        $result_polizas_x_difunto = PolizaXdifuntoModel::Get_Data($sql_polizas_x_difunto);
        return $result_polizas_x_difunto;
    }
     public static function IngresarPolizasXdifunto($difunto_cedula, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_difunto = "INSERT INTO Difunto_has_Polizas_De_Seguro (Difunto_cedula, Polizas_De_Seguro_Numero) VALUES ('$difunto_cedula', '$polizas_de_seguro_numero')";
        $result_polizas_x_difunto = PolizaXdifuntoModel::Update_Data($sql_polizas_x_difunto);
        return $result_polizas_x_difunto;
    }
     public static function BuscarPolizasXdifunto($difunto_cedula, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_difunto = "SELECT Difunto_cedula, Polizas_De_Seguro_Numero FROM Difunto_has_Polizas_De_Seguro WHERE Difunto_cedula = '$difunto_cedula' AND Polizas_De_Seguro_Numero = '$polizas_de_seguro_numero'";
        $result_polizas_x_difunto = PolizaXdifuntoModel::Get_Data($sql_polizas_x_difunto);
        return $result_polizas_x_difunto;
    }
     public static function DeletePolizasXdifunto($difunto_cedula, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_difunto = "DELETE FROM Difunto_has_Polizas_De_Seguro WHERE Difunto_cedula = '$difunto_cedula' AND Polizas_De_Seguro_Numero = '$polizas_de_seguro_numero'";
        $result_polizas_x_difunto = PolizaXdifuntoModel::Update_Data($sql_polizas_x_difunto);
        return $result_polizas_x_difunto;
    }
}
?>