<?php
class PolizaXpersonaNModel
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

    public static function ListarPolizasXpersonaN()
    {
        $sql_polizas_x_persona_n = "SELECT Persona_Natural_cedula, Polizas_De_Seguro_Numero FROM Persona_Natural_has_Polizas_De_Seguro";
        $result_polizas_x_persona_n = PolizaXpersonaNModel::Get_Data($sql_polizas_x_persona_n);
        return $result_polizas_x_persona_n;
    }

    public static function IngresarPolizasXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_persona_n = "INSERT INTO Persona_Natural_has_Polizas_De_Seguro (Persona_Natural_cedula, Polizas_De_Seguro_Numero) VALUES ('$persona_natural_cedula', '$polizas_de_seguro_numero')";
        $result_polizas_x_persona_n = PolizaXpersonaNModel::Update_Data($sql_polizas_x_persona_n);
        return $result_polizas_x_persona_n;
    }

    public static function BuscarPolizasXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_persona_n = "SELECT Persona_Natural_cedula, Polizas_De_Seguro_Numero FROM Persona_Natural_has_Polizas_De_Seguro WHERE Persona_Natural_cedula = '$persona_natural_cedula' AND Polizas_De_Seguro_Numero = '$polizas_de_seguro_numero'";
        $result_polizas_x_persona_n = PolizaXpersonaNModel::Get_Data($sql_polizas_x_persona_n);
        return $result_polizas_x_persona_n;
    }

    public static function DeletePolizasXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero)
    {
        $sql_polizas_x_persona_n = "DELETE FROM Persona_Natural_has_Polizas_De_Seguro WHERE Persona_Natural_cedula = '$persona_natural_cedula' AND Polizas_De_Seguro_Numero = '$polizas_de_seguro_numero'";
        $result_polizas_x_persona_n = PolizaXpersonaNModel::Update_Data($sql_polizas_x_persona_n);
        return $result_polizas_x_persona_n;
    }
}
