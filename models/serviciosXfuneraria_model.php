<?php
class ServiciosXFunerariaModel
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

    public static function ListarServiciosXFuneraria()
    {
        $sql_servicios_x_funeraria = "SELECT Funeraria_Rif, Servicios_Prestados_Codigo FROM Funeraria_has_Servicios_Prestados";
        $result_servicios_x_funeraria = ServiciosXFunerariaModel::Get_Data($sql_servicios_x_funeraria);
        return $result_servicios_x_funeraria;
    }

    public static function IngresarServiciosXFuneraria($funeraria_rif, $servicios_prestados_codigo)
    {
        $sql_servicios_x_funeraria = "INSERT INTO Funeraria_has_Servicios_Prestados (Funeraria_Rif, Servicios_Prestados_Codigo) VALUES ('$funeraria_rif', '$servicios_prestados_codigo')";
        $result_servicios_x_funeraria = ServiciosXFunerariaModel::Update_Data($sql_servicios_x_funeraria);
        return $result_servicios_x_funeraria;
    }

    public static function BuscarServiciosXFuneraria($funeraria_rif, $servicios_prestados_codigo)
    {
        $sql_servicios_x_funeraria = "SELECT Funeraria_Rif, Servicios_Prestados_Codigo FROM Funeraria_has_Servicios_Prestados WHERE Funeraria_Rif = '$funeraria_rif' AND Servicios_Prestados_Codigo = '$servicios_prestados_codigo'";
        $result_servicios_x_funeraria = ServiciosXFunerariaModel::Get_Data($sql_servicios_x_funeraria);
        return $result_servicios_x_funeraria;
    }

    public static function DeleteServiciosXFuneraria($funeraria_rif, $servicios_prestados_codigo)
    {
        $sql_servicios_x_funeraria = "DELETE FROM Funeraria_has_Servicios_Prestados WHERE Funeraria_Rif = '$funeraria_rif' AND Servicios_Prestados_Codigo = '$servicios_prestados_codigo'";
        $result_servicios_x_funeraria = ServiciosXFunerariaModel::Update_Data($sql_servicios_x_funeraria);
        return $result_servicios_x_funeraria;
    }
}