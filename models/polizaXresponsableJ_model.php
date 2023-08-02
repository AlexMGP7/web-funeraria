<?php
class PolizaXResponsableJModel
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

    public static function ListarPolizasXResponsableJ()
    {
        $sql_polizas_x_responsableJ = "SELECT Responsable_Juridico_Rif, Polizas_De_Seguro_Numero FROM Responsable_Juridico_has_Polizas_De_Seguro";
        $result_polizas_x_responsableJ = PolizaXResponsableJModel::Get_Data($sql_polizas_x_responsableJ);
        return $result_polizas_x_responsableJ;
    }

    public static function IngresarPolizasXResponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_responsableJ = "INSERT INTO Responsable_Juridico_has_Polizas_De_Seguro (Responsable_Juridico_Rif, Polizas_De_Seguro_Numero) VALUES ('$responsable_juridico_rif', '$polizas_de_seguro_numero')";
        $result_polizas_x_responsableJ = PolizaXResponsableJModel::Update_Data($sql_polizas_x_responsableJ);
        return $result_polizas_x_responsableJ;
    }

    public static function BuscarPolizasXResponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_responsableJ = "SELECT Responsable_Juridico_Rif, Polizas_De_Seguro_Numero FROM Responsable_Juridico_has_Polizas_De_Seguro WHERE Responsable_Juridico_Rif = '$responsable_juridico_rif' AND Polizas_De_Seguro_Numero = '$polizas_de_seguro_numero'";
        $result_polizas_x_responsableJ = PolizaXResponsableJModel::Get_Data($sql_polizas_x_responsableJ);
        return $result_polizas_x_responsableJ;
    }

    public static function DeletePolizasXResponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_responsableJ = "DELETE FROM Responsable_Juridico_has_Polizas_De_Seguro WHERE Responsable_Juridico_Rif = '$responsable_juridico_rif' AND Polizas_De_Seguro_Numero = '$polizas_de_seguro_numero'";
        $result_polizas_x_responsableJ = PolizaXResponsableJModel::Update_Data($sql_polizas_x_responsableJ);
        return $result_polizas_x_responsableJ;
    }
}
?>
