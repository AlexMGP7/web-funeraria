<?php
class PersonaNaturalController
{

    function __construct()
    {
    }

    function ListarPersonaN()
    {
        // Mostrar la vista que lista todas las personas naturales
        require_once('../../views/personan/list_personan.php');
    }

    static public function ListarPersonaN1()
    {
        // Obtener la lista de personas naturales del modelo "PersonaNaturalModel"
        require_once('../../models/personan_model.php');
        $result_Listar = PersonaNaturalModel::ListarPersonaN();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de personas naturales.
    }

    static public function ListarPersonas()
    {
        // Obtener la lista de personas del modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_personas = PersonaModel::ListarPersona();
        return $result_personas; // Devuelve el resultado de la consulta que contiene la lista de personas.
    }

    // Para insertar

    static public function BuscarUltimaPersonaN()
    {
        // Buscar la última persona natural en el modelo "PersonaNaturalModel"
        require_once('../../models/personan_model.php');
        $result_ultima_personan = PersonaNaturalModel::BuscarUltimaPersonaN();
        return $result_ultima_personan; // Devuelve el resultado de la consulta que contiene la última persona natural.
    }

    function IngresarPersonaN()
    {
        // Mostrar la vista para insertar una nueva persona natural
        require_once('../../views/personan/insert_personan.php');
    }

    static public function IngresarPersonaN2($cedula, $correo, $telefono)
    {
        // Insertar una nueva persona natural en el modelo "PersonaNaturalModel"
        require_once('../../models/personan_model.php');
        $result_insertar_personan = PersonaNaturalModel::IngresarPersonaN2($cedula, $correo, $telefono);
        return $result_insertar_personan; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarPersonaNByCedula($cedula)
    {
        // Buscar una persona natural por su cédula en el modelo "PersonaNaturalModel"
        require_once('../../models/personan_model.php');
        $personan_model = new PersonaNaturalModel();
        $result_personan = $personan_model->BuscarPersonaNByCedula($cedula); // Llama al método correcto en el modelo
        return $result_personan; // Devuelve el resultado de la consulta que contiene la persona natural encontrada.
    }

    function UpdatePersonaN()
    {
        // Mostrar la vista para actualizar una persona natural
        require_once('../../views/personan/update_personan.php');
    }

    function UpdatePersonaN2($cedula, $correo, $telefono)
    {
        // Actualizar una persona natural existente en el modelo "PersonaNaturalModel"
        require_once('../../models/personan_model.php');
        $result_actualizar_personan = PersonaNaturalModel::UpdatePersonaN2($cedula, $correo, $telefono);
        return $result_actualizar_personan; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeletePersonaN()
    {
        // Mostrar la vista para eliminar una persona natural
        require_once('../../views/personan/delete_personan.php');
    }

    static public function DeletePersonaN1($cedula)
    {
        // Eliminar una persona natural de la tabla 'personan' en el modelo "PersonaNaturalModel"
        require_once('../../models/personan_model.php');
        $result_eliminar_personan = PersonaNaturalModel::DeletePersonaN($cedula);
        return $result_eliminar_personan; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
