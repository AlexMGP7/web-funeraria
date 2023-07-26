<?php
class UsuarioController
{

    function __construct()
    {
    }

    function ListarUsuario()
    {
        // Mostrar la vista que lista todos los usuarios
        require_once('../../views/usuario/list_usuario.php');
    }

    static public function ListarUsuario1()
    {
        // Obtener la lista de personas del modelo "PersonaModel"
        require_once('../../models/usuario_model.php');
        $result_Listar = UsuarioModel::ListarUsuario();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de personas.
    }

    static public function ListarPersonas()
    {
        // Obtener la lista de personas del modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_personas = PersonaModel::ListarPersona();
        return $result_personas; // Devuelve el resultado de la consulta que contiene la lista de personas.
    }

    // Para insertar

    static public function BuscarUltimoUsuario()
    {
        // Buscar el último usuario en el modelo "UsuarioModel"
        require_once('../../models/usuario_model.php');
        $result_ultimo_usuario = UsuarioModel::BuscarUltimoUsuario();
        return $result_ultimo_usuario; // Devuelve el resultado de la consulta que contiene el último usuario.
    }

    function IngresarUsuario()
    {
        // Mostrar la vista para insertar un nuevo usuario
        require_once('../../views/usuario/insert_usuario.php');
    }

    static public function IngresarUsuario2($cedula, $username, $password, $telefono)
    {
        // Insertar un nuevo usuario en el modelo "UsuarioModel"
        require_once('../../models/usuario_model.php');
        $result_insertar_usuario = UsuarioModel::IngresarUsuario2($cedula, $username, $password, $telefono);
        return $result_insertar_usuario; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarUsuarioByCedula($cedula)
    {
        // Buscar un usuario por su cédula en el modelo "UsuarioModel"
        require_once('../../models/usuario_model.php');
        $usuario_model = new UsuarioModel();
        $result_usuario = $usuario_model->BuscarUsuarioByCedula($cedula); // Llama al método correcto en el modelo
        return $result_usuario; // Devuelve el resultado de la consulta que contiene el usuario encontrado.
    }

    function UpdateUsuario()
    {
        // Mostrar la vista para actualizar un usuario
        require_once('../../views/usuario/update_usuario.php');
    }

    function UpdateUsuario2($cedula, $username, $password, $telefono)
    {
        // Actualizar un usuario existente en el modelo "UsuarioModel"
        require_once('../../models/usuario_model.php');
        $result_actualizar_usuario = UsuarioModel::UpdateUsuario2($cedula, $username, $password, $telefono);
        return $result_actualizar_usuario; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeleteUsuario()
    {
        // Mostrar la vista para eliminar un usuario
        require_once('../../views/usuario/delete_usuario.php');
    }

    static public function DeleteUsuario1($cedula)
    {
        // Eliminar un usuario de la tabla 'usuario' en el modelo "UsuarioModel"
        require_once('../../models/usuario_model.php');
        $result_eliminar_usuario = UsuarioModel::DeleteUsuario($cedula);
        return $result_eliminar_usuario; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
?>
