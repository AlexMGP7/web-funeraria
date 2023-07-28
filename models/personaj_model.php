<?php

class PersonaJuridicaModel
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

    public static function ListarPersonaJ()
    {
        $sql_persona_juridica = "SELECT pj.rif, pj.nombre, c.descripcion AS ciudad_descripcion
                    FROM persona_juridica pj
                    JOIN ciudad c ON pj.Ciudad_Codigo = c.codigo
                    ORDER BY pj.rif ASC";
        $result_persona_juridica = PersonaJuridicaModel::Get_Data($sql_persona_juridica);
        return $result_persona_juridica;
    }

    // Para la insersión

    public static function BuscarUltimaPersonaJ()
    {

        $sql_persona_juridica = "SELECT MAX(rif) as identific FROM persona_juridica";
        $result_persona_juridica = PersonaJuridicaModel::Get_Data($sql_persona_juridica);
        return $result_persona_juridica;
    }

    public static function IngresarPersonaJ2($rif, $nombre, $ciudadCodigo)
    {

        $sql_persona_juridica = "INSERT INTO persona_juridica (rif, nombre, Ciudad_Codigo) VALUES ('$rif', '$nombre', $ciudadCodigo)";
        $result_persona_juridica = PersonaJuridicaModel::Update_Data($sql_persona_juridica);
        return $result_persona_juridica;
    }

    // Para la actualización

    public static function BuscarPersonaJByRif($rif)
    {
        $sql_persona_juridica = "SELECT rif, nombre, Ciudad_Codigo FROM persona_juridica WHERE rif = '$rif'";
        $result_persona_juridica = PersonaJuridicaModel::Get_Data($sql_persona_juridica);
        return $result_persona_juridica;
    }

    public static function UpdatePersonaJ2($rif, $nombre, $ciudadCodigo)
    {
        $sql_persona_juridica = "UPDATE persona_juridica SET rif = '$rif', nombre = '$nombre', Ciudad_Codigo = $ciudadCodigo WHERE rif = '$rif'";
        $result_persona_juridica = PersonaJuridicaModel::Update_Data($sql_persona_juridica);
        return $result_persona_juridica;
    }

    // Para eliminar

    public static function DeletePersonaJ($rif)
    {
        $sql_persona_juridica = "DELETE FROM persona_juridica WHERE rif = '$rif'";
        $result_persona_juridica = PersonaJuridicaModel::Update_Data($sql_persona_juridica);
        return $result_persona_juridica;
    }

}
