<?php
class ServiciosPModel
{
    function __construct()
    {
    }

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

    public static function ListarServiciosP()
    {
        $sql_servicios_prestados = "SELECT codigo, nombre, tipo, monto FROM servicios_prestados ORDER BY codigo ASC";
        $result_servicios_prestados = ServiciosPModel::Get_Data($sql_servicios_prestados);
        return $result_servicios_prestados;
    }

    public static function IngresarServiciosP($codigo, $nombre, $tipo, $monto)
    {
        $sql_servicios_prestados = "INSERT INTO servicios_prestados (codigo, nombre, tipo, monto) VALUES ('$codigo', '$nombre', '$tipo', '$monto')";
        $result_servicios_prestados = ServiciosPModel::Update_Data($sql_servicios_prestados);
        return $result_servicios_prestados;
    }

    public static function BuscarServiciosPByCodigo($codigo)
    {
        $sql_servicios_prestados = "SELECT codigo, nombre, tipo, monto FROM servicios_prestados WHERE codigo = '$codigo'";
        $result_servicios_prestados = ServiciosPModel::Get_Data($sql_servicios_prestados);
        return $result_servicios_prestados;
    }

    // Función para buscar el último código de servicio prestado utilizado en el modelo.
    public static function BuscarUltimoServiciosP()
    {
        $sql_servicios_prestados = "SELECT MAX(codigo) AS ultimo_codigo FROM servicios_prestados";
        $result_servicios_prestados = ServiciosPModel::Get_Data($sql_servicios_prestados);
        return $result_servicios_prestados; // Devuelve el resultado de la consulta que contiene el último código de servicio prestado.
    }

    public static function UpdateServiciosP($codigo, $nombre, $tipo, $monto)
    {
        $sql_servicios_prestados = "UPDATE servicios_prestados SET nombre = '$nombre', tipo = '$tipo', monto = '$monto' WHERE codigo = '$codigo'";
        $result_servicios_prestados = ServiciosPModel::Update_Data($sql_servicios_prestados);
        return $result_servicios_prestados;
    }

    public static function DeleteServiciosP($codigo)
    {
        $sql_servicios_prestados = "DELETE FROM servicios_prestados WHERE codigo = '$codigo'";
        $result_servicios_prestados = ServiciosPModel::Update_Data($sql_servicios_prestados);
        return $result_servicios_prestados;
    }
}
