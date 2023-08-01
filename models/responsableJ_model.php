<?php
class ResponsableJuridicoModel
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
     public static function ListarResponsableJ()
    {
        $sql_responsable_juridico = "SELECT rj.rif, rj.correo, rj.telefono, rj.razon_s
                    FROM responsable_juridico rj
                    ORDER BY rj.rif ASC";
        $result_responsable_juridico = ResponsableJuridicoModel::Get_Data($sql_responsable_juridico);
        return $result_responsable_juridico;
    }
     // Para la insersión
     public static function IngresarResponsableJ($rif, $correo, $telefono, $razon_s)
    {
        $sql_responsable_juridico = "INSERT INTO responsable_juridico (rif, correo, telefono, razon_s) VALUES ('$rif', '$correo', '$telefono', '$razon_s')";
        $result_responsable_juridico = ResponsableJuridicoModel::Update_Data($sql_responsable_juridico);
        return $result_responsable_juridico;
    }
     // Para la actualización
     public static function BuscarResponsableJByRif($rif)
    {
        $sql_responsable_juridico = "SELECT rif, correo, telefono, razon_s FROM responsable_juridico WHERE rif = '$rif'";
        $result_responsable_juridico = ResponsableJuridicoModel::Get_Data($sql_responsable_juridico);
        return $result_responsable_juridico;
    }

    public static function BuscarUltimoResponsableJ()
{
    $sql_responsable_juridico = "SELECT * FROM responsable_juridico ORDER BY rif DESC LIMIT 1";
    $result_responsable_juridico = ResponsableJuridicoModel::Get_Data($sql_responsable_juridico);
    return $result_responsable_juridico;
}

     public static function UpdateResponsableJ($rif, $correo, $telefono, $razon_s)
    {
        $sql_responsable_juridico = "UPDATE responsable_juridico SET rif = '$rif', correo = '$correo', telefono = '$telefono', razon_s = '$razon_s' WHERE rif = '$rif'";
        $result_responsable_juridico = ResponsableJuridicoModel::Update_Data($sql_responsable_juridico);
        return $result_responsable_juridico;
    }
     // Para eliminar
     public static function DeleteResponsableJ($rif)
    {
        $sql_responsable_juridico = "DELETE FROM responsable_juridico WHERE rif = '$rif'";
        $result_responsable_juridico = ResponsableJuridicoModel::Update_Data($sql_responsable_juridico);
        return $result_responsable_juridico;
    }
 }