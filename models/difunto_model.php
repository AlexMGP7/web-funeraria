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
    $sql_difunto = "SELECT d.cedula, d.`Fecha de N.`, d.`Fecha de D.`, d.`Partida de N.`, d.`Causa de M.`, pj.nombre AS nombre_persona_juridica, ciudad.descripcion AS ciudad_descripcion
                    FROM difunto d
                    JOIN persona pj ON d.cedula = pj.cedula
                    JOIN persona_juridica pj_cementerio ON d.Cementerio_Rif = pj_cementerio.Rif
                    JOIN ciudad ON pj_cementerio.Ciudad_Codigo = ciudad.Codigo
                    ORDER BY d.cedula ASC";
    $result_difunto = DifuntoModel::Get_Data($sql_difunto);
    return $result_difunto;
}

    public static function ListarCementerios()
    {
        $sql_cementerio = "SELECT rif, codigo, tipo FROM cementerio";
        $result_cementerio = DifuntoModel::Get_Data($sql_cementerio);
        return $result_cementerio;
    }

    public static function ListarPersonas()
    {
        $sql_persona = "SELECT cedula, nombre FROM persona";
        $result_persona = DifuntoModel::Get_Data($sql_persona);
        return $result_persona;
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
        $sql_difunto = "INSERT INTO difunto (cedula, FechaN, FechaD, PartidaN, CausaM, Cementerio_Rif) 
                        VALUES ('$cedula', '$fechaN', '$fechaD', '$partidaN', '$causaM', '$cementerioRif')";
        $result_difunto = DifuntoModel::Update_Data($sql_difunto);
        return $result_difunto;
    }

    // Para la actualización

    public static function BuscarDifuntoByCedula($cedula)
    {
        $sql_difunto = "SELECT cedula, FechaN, FechaD, PartidaN, CausaM, Cementerio_Rif FROM difunto WHERE cedula = '$cedula'";
        $result_difunto = DifuntoModel::Get_Data($sql_difunto);
        return $result_difunto;
    }

    public static function UpdateDifunto($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif)
    {
        $sql_difunto = "UPDATE difunto SET cedula = '$cedula', FechaN = '$fechaN', FechaD = '$fechaD', PartidaN = '$partidaN', 
                        CausaM = '$causaM', Cementerio_Rif = '$cementerioRif' WHERE cedula = '$cedula'";
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
