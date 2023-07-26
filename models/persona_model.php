<?php

class PersonaModel
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

    // para el resto de las operaciones

    public static function ListarPersona()
    {
        $sql_persona = "SELECT p.cedula, p.nombre, p.apellido, c.descripcion AS ciudad_descripcion
                    FROM persona p
                    JOIN ciudad c ON p.Ciudad_Codigo = c.codigo
                    ORDER BY p.cedula ASC";
        $result_persona = PersonaModel::Get_Data($sql_persona);
        return $result_persona;
    }


    // Para la insersión

    public static function BuscarUltimaPersona()
    {

        $sql_persona = "SELECT (max(cedula)) as identific FROM persona order BY cedula asc";
        $result_persona = PersonaModel::Get_Data($sql_persona);
        return $result_persona;
    }

    public static function IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo)
    {

        $sql_persona = "INSERT INTO persona (cedula, nombre, apellido, Ciudad_Codigo) VALUES ($cedula, '$nombre', '$apellido', $ciudadCodigo)";
        $result_persona = PersonaModel::Update_Data($sql_persona);
        return $result_persona;
    }

    // Para la actualización

    public static function BuscarPersonaByCedula($cedula)
    {
        //$sql_persona = "SELECT cedula, nombre, apellido, Ciudad_Codigo FROM persona ORDER BY cedula ASC";
        $sql_persona = "SELECT cedula, nombre, apellido, Ciudad_Codigo FROM persona WHERE cedula = $cedula";
        $result_persona = PersonaModel::Get_Data($sql_persona);

        return $result_persona;
    }

    public static function UpdatePersona2($cedula, $nombre, $apellido, $ciudadCodigo)
    {
        $sql_persona = "UPDATE persona SET cedula = $cedula, nombre = '$nombre', apellido = '$apellido', Ciudad_Codigo = $ciudadCodigo WHERE cedula = $cedula";
        $result_persona = PersonaModel::Update_Data($sql_persona);
        return $result_persona;
    }

    // Para eliminar

    public static function DeletePersona($cedula)
    {
        $sql_persona = "DELETE FROM persona WHERE cedula = $cedula";
        $result_persona = PersonaModel::Update_Data($sql_persona);
        return $result_persona;
    }
    public static function CheckReferencedRecords($cedula)
    {
        // Your code to check if the person has references in other tables goes here
        // For example, if the person is referenced in other tables, return true, else return false.
        // Modify this method based on your database schema and relationships.
        // For simplicity, this example assumes no referenced records.
        return false;
    }
}
