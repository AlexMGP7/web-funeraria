<?php
class PersonaController
{

    function __construct()
    {
    }

    function ListarPersona()
    {
        // Mostrar la vista que lista todas las personas
        require_once('../../views/persona/list_persona.php');
    }

    static public function ListarCiudades()
    {
        // Obtener la lista de ciudades del modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $result_estados = CiudadModel::ListarCiudad();
        return $result_estados; // Devuelve el resultado de la consulta que contiene la lista de ciudades.
    }

    static public function ListarPersona1()
    {
        // Obtener la lista de personas del modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::ListarPersona();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de personas.
    }

    // Para insertar

    static public function BuscarUltimaPersona()
    {
        // Buscar la última persona en el modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::BuscarUltimaPersona();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la última persona.
    }

    function IngresarPersona()
    {
        // Mostrar la vista para insertar una nueva persona
        require_once('../../views/persona/insert_persona.php');
    }

    function IngresarPersona1()
    {
        // Mostrar la vista con un formulario para insertar una nueva persona
        require_once('../../views/persona/insert_persona1.php');
    }

    static public function IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo)
    {
        // Insertar una nueva persona en el modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarPersonaByCedula($cedula)
    {
        // Buscar una persona por su cédula en el modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $persona_model = new PersonaModel();
        $result_persona = $persona_model->BuscarPersonaByCedula($cedula); // Llama al método correcto en el modelo
        return $result_persona; // Devuelve el resultado de la consulta que contiene la persona encontrada.
    }

    function UpdatePersona()
    {
        // Mostrar la vista para actualizar una persona
        require_once('../../views/persona/update_persona.php');
    }

    function UpdatePersona1()
    {
        // Mostrar la vista con un formulario para actualizar una persona
        require_once('../../views/persona/update_persona1.php');
    }

    function UpdatePersona2($cedula, $nombre, $apellido, $ciudadCodigo)
    {
        // Actualizar una persona existente en el modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::UpdatePersona2($cedula, $nombre, $apellido, $ciudadCodigo);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeletePersona()
    {
        // Mostrar la vista para eliminar una persona
        require_once('../../views/persona/delete_persona.php');
    }

    static public function DeletePersona1($cedula)
    {
        // Eliminar una persona de la tabla 'persona' en el modelo "PersonaModel"

        require_once('../../models/persona_model.php');

        // Verificar si existen registros relacionados en otras tablas
        $hasReferencedRecords = PersonaModel::CheckReferencedRecords($cedula);

        if ($hasReferencedRecords) {
            throw new Exception("No se puede eliminar la persona porque tiene claves foráneas referenciadas en otras tablas.");
        }

        // Si no hay referencias, procede con la eliminación
        $result_Listar = PersonaModel::DeletePersona($cedula);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
