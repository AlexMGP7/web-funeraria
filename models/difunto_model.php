<?php

class DifuntoModel
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
            die('Error in query: ' . mysqli_error($conexion)); // Print the error message
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

    public static function ListarDifuntos()
    {
        $sql_difunto = "SELECT d.cedula, d.`Fecha de N.`, d.`Fecha de D.`, d.`Partida de N.`, d.`Causa de M.`, d.Cementerio_Rif, pj.nombre AS nombre_persona_juridica, ciudad.descripcion AS ciudad_descripcion
                        FROM difunto d
                        JOIN persona pj ON d.cedula = pj.cedula
                        JOIN persona_juridica pj_cementerio ON d.Cementerio_Rif = pj_cementerio.Rif
                        JOIN ciudad ON pj_cementerio.Ciudad_Codigo = ciudad.Codigo
                        ORDER BY d.cedula ASC";
        $result_difunto = DifuntoModel::Get_Data($sql_difunto);
        return $result_difunto;
    }

    // Para la insersión

    public static function BuscarUltimaCedula()
    {
        $sql_difunto = "SELECT MAX(cedula) as identific FROM difunto";
        $result_difunto = DifuntoModel::Get_Data($sql_difunto);
        return $result_difunto;
    }

    public static function IngresarDifunto($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif)
    {
        $sql_difunto = "INSERT INTO difunto (`cedula`, `Fecha de N.`, `Fecha de D.`, `Partida de N.`, `Causa de M.`, `Cementerio_Rif`)
                VALUES ('$cedula', '$fechaN', '$fechaD', '$partidaN', '$causaM', '$cementerioRif')";
        $result_difunto = DifuntoModel::Update_Data($sql_difunto);
        return $result_difunto;
    }


    // Para la actualización

    public static function BuscarDifuntoByCedula($cedula)
    {
        $sql_difunto = "SELECT `cedula`, `Fecha de N.`, `Fecha de D.`, `Partida de N.`, `Causa de M.`, `Cementerio_Rif` FROM difunto WHERE cedula = '$cedula'";
        $result_difunto = DifuntoModel::Get_Data($sql_difunto);
        return $result_difunto;
    }

    public static function UpdateDifunto($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif)
    {
        $sql_difunto = "UPDATE difunto SET cedula = '$cedula', Fecha de N. = '$fechaN', Fecha de D. = '$fechaD', Partida de N. = '$partidaN', 
                        Causa de M. = '$causaM', Cementerio_Rif = '$cementerioRif' WHERE cedula = '$cedula'";
        $result_difunto = DifuntoModel::Update_Data($sql_difunto);
        return $result_difunto;
    }

    // Para eliminar

    public static function DeleteDifunto($cedula)
    {
        $sql_difunto = "DELETE FROM difunto WHERE cedula = '$cedula'";
        $result_difunto = DifuntoModel::Update_Data($sql_difunto);
        return $result_difunto;
    }
}
