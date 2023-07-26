<?php
class UsuarioModel
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

    // FUNCIONES ESPECÍFICAS DEL MODELO USUARIO

    public static function ListarUsuario()
    {
        $sql_usuario = "SELECT cedula, id, login, password, telefono FROM usuario";
        $result_usuario = UsuarioModel::Get_Data($sql_usuario);
        return $result_usuario;
    }

    public static function BuscarUltimoUsuario()
    {
        $sql_usuario = "SELECT MAX(id) AS ultimo_id FROM usuario";
        $result_ultimo_usuario = UsuarioModel::Get_Data($sql_usuario);
        return $result_ultimo_usuario;
    }

    public static function IngresarUsuario2($cedula, $username, $password, $telefono)
    {
        $sql_usuario = "INSERT INTO usuario (cedula, login, password, telefono) VALUES ($cedula, '$username', '$password', '$telefono')";
        $result_insertar_usuario = UsuarioModel::Update_Data($sql_usuario);
        return $result_insertar_usuario;
    }

    public static function BuscarUsuarioByCedula($cedula)
    {
        $sql_usuario = "SELECT cedula, id, login, password, telefono FROM usuario WHERE cedula = $cedula";
        $result_usuario = UsuarioModel::Get_Data($sql_usuario);
        return $result_usuario;
    }

    public static function UpdateUsuario2($cedula, $username, $password, $telefono)
    {
        $sql_usuario = "UPDATE usuario SET login = '$username', password = '$password', telefono = '$telefono' WHERE cedula = $cedula";
        $result_actualizar_usuario = UsuarioModel::Update_Data($sql_usuario);
        return $result_actualizar_usuario;
    }

    public static function DeleteUsuario($cedula)
    {
        $sql_usuario = "DELETE FROM usuario WHERE cedula = $cedula";
        $result_eliminar_usuario = UsuarioModel::Update_Data($sql_usuario);
        return $result_eliminar_usuario;
    }
}
