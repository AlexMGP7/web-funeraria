<?php
class PersonaNaturalModel
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
            die('Error in query: ' . mysqli_error($conexion)); // Imprimir el mensaje de error
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

        if ($result == true) // La consulta fue exitosa
        {
            if (mysqli_affected_rows($conexion) == 0) // Si no hizo la actualización
            {
                mysqli_rollback($conexion);
                $result = false;
            } else   // Si hizo la actualización
            {
                mysqli_commit($conexion);
                $result = true;
            }
        }

        $conexion = conectar::desconexion($conexion);

        return $result;
    }

    // FUNCIONES ESPECÍFICAS DEL MODELO PERSONA NATURAL

    public static function ListarPersonaN()
    {
        $sql_personan = "SELECT cedula, correo, telefono FROM persona_natural";
        $result_personan = PersonaNaturalModel::Get_Data($sql_personan);
        return $result_personan;
    }

    public static function BuscarUltimaPersonaN()
    {
        $sql_personan = "SELECT MAX(cedula) AS ultima_cedula FROM persona_natural";
        $result_ultima_personan = PersonaNaturalModel::Get_Data($sql_personan);
        return $result_ultima_personan;
    }

    public static function IngresarPersonaN2($cedula, $correo, $telefono)
    {
        $sql_personan = "INSERT INTO persona_natural (cedula, correo, telefono) VALUES ($cedula, '$correo', '$telefono')";
        $result_insertar_personan = PersonaNaturalModel::Update_Data($sql_personan);
        return $result_insertar_personan;
    }

    public static function BuscarPersonaNByCedula($cedula)
    {
        $sql_personan = "SELECT cedula, correo, telefono FROM persona_natural WHERE cedula = $cedula";
        $result_personan = PersonaNaturalModel::Get_Data($sql_personan);
        return $result_personan;
    }

    public static function UpdatePersonaN2($cedula, $correo, $telefono)
    {
        $sql_personan = "UPDATE persona_natural SET correo = '$correo', telefono = '$telefono' WHERE cedula = $cedula";
        $result_actualizar_personan = PersonaNaturalModel::Update_Data($sql_personan);
        return $result_actualizar_personan;
    }

    public static function DeletePersonaN($cedula)
    {
        $sql_personan = "DELETE FROM persona_natural WHERE cedula = $cedula";
        $result_eliminar_personan = PersonaNaturalModel::Update_Data($sql_personan);
        return $result_eliminar_personan;
    }
}
