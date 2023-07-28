<?php

class CementerioModel
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

    public static function ListarCementerios()
{
    $sql_cementerio = "SELECT c.rif, c.codigo, c.tipo, pj.nombre AS nombre_persona_juridica, ciudad.descripcion AS ciudad_descripcion
                       FROM cementerio c
                       JOIN persona_juridica pj ON c.Rif = pj.rif
                       JOIN ciudad ON pj.ciudad_codigo = ciudad.codigo
                       ORDER BY c.rif ASC";
    $result_cementerio = CementerioModel::Get_Data($sql_cementerio);
    return $result_cementerio;
}

    // Para la insersión

    public static function BuscarUltimoCementerio()
    {

        $sql_cementerio = "SELECT MAX(rif) as identific FROM cementerio";
        $result_cementerio = CementerioModel::Get_Data($sql_cementerio);
        return $result_cementerio;
    }

    public static function IngresarCementerio2($rif, $codigo, $tipo)
    {

        $sql_cementerio = "INSERT INTO cementerio (rif, codigo, tipo) VALUES ('$rif', '$codigo', '$tipo')";
        $result_cementerio = CementerioModel::Update_Data($sql_cementerio);
        return $result_cementerio;
    }

    // Para la actualización

    public static function BuscarCementerioByRif($rif)
    {
        $sql_cementerio = "SELECT rif, codigo, tipo FROM cementerio WHERE rif = '$rif'";
        $result_cementerio = CementerioModel::Get_Data($sql_cementerio);
        return $result_cementerio;
    }

    public static function UpdateCementerio2($rif, $codigo, $tipo)
    {
        $sql_cementerio = "UPDATE cementerio SET rif = '$rif', codigo = '$codigo', tipo = '$tipo' WHERE rif = '$rif'";
        $result_cementerio = CementerioModel::Update_Data($sql_cementerio);
        return $result_cementerio;
    }

    // Para eliminar

    public static function DeleteCementerio($rif)
    {
        $sql_cementerio = "DELETE FROM cementerio WHERE rif = '$rif'";
        $result_cementerio = CementerioModel::Update_Data($sql_cementerio);
        return $result_cementerio;
    }

}
