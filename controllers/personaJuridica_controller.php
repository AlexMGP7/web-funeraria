<?php
class PersonaJuridicaController
{

    function __construct()
    {
    }

    function ListarPersonaJ()
    {
        // Mostrar la vista que lista todas las personas jurídicas
        require_once('../../views/personaJ/list_personaJ.php');
    }

    static public function ListarCiudades()
    {
        // Obtener la lista de ciudades del modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $result_ciudades = CiudadModel::ListarCiudad();
        return $result_ciudades; // Devuelve el resultado de la consulta que contiene la lista de ciudades.
    }

    static public function ListarPersonaJ1()
    {
        // Obtener la lista de personas jurídicas del modelo "PersonaJuridicaModel"
        require_once('../../models/personaJ_model.php');
        $result_Listar = PersonaJuridicaModel::ListarPersonaJ();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de personas jurídicas.
    }

    // Para insertar

    static public function BuscarUltimaPersonaJ()
    {
        // Buscar la última persona jurídica en el modelo "PersonaJuridicaModel"
        require_once('../../models/personaJ_model.php');
        $result_ultima_persona_juridica = PersonaJuridicaModel::BuscarUltimaPersonaJ();
        return $result_ultima_persona_juridica; // Devuelve el resultado de la consulta que contiene la última persona jurídica.
    }

    function IngresarPersonaJ()
    {
        // Mostrar la vista para insertar una nueva persona jurídica
        require_once('../../views/personaJ/insert_personaJ.php');
    }

    static public function IngresarPersonaJ2($rif, $nombre, $ciudadCodigo)
    {
        // Insertar una nueva persona jurídica en el modelo "PersonaJuridicaModel"
        require_once('../../models/personaJ_model.php');
        $result_insertar_persona_juridica = PersonaJuridicaModel::IngresarPersonaJ2($rif, $nombre, $ciudadCodigo);
        return $result_insertar_persona_juridica; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarPersonaJByRif($rif)
    {
        // Buscar una persona jurídica por su RIF en el modelo "PersonaJuridicaModel"
        require_once('../../models/personaJ_model.php');
        $persona_juridica_model = new PersonaJuridicaModel();
        $result_persona_juridica = $persona_juridica_model->BuscarPersonaJByRif($rif); // Llama al método correcto en el modelo
        return $result_persona_juridica; // Devuelve el resultado de la consulta que contiene la persona jurídica encontrada.
    }

    function UpdatePersonaJ()
    {
        // Mostrar la vista para actualizar una persona jurídica
        require_once('../../views/personaJ/update_personaJ.php');
    }

    function UpdatePersonaJ2($rif, $nombre, $ciudadCodigo)
    {
        // Actualizar una persona jurídica existente en el modelo "PersonaJuridicaModel"
        require_once('../../models/personaJ_model.php');
        $result_actualizar_persona_juridica = PersonaJuridicaModel::UpdatePersonaJ2($rif, $nombre, $ciudadCodigo);
        return $result_actualizar_persona_juridica; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeletePersonaJ()
    {
        // Mostrar la vista para eliminar una persona jurídica
        require_once('../../views/personaJ/delete_personaJ.php');
    }

    static public function DeletePersonaJ1($rif)
    {
        // Eliminar una persona jurídica de la tabla 'persona_juridica' en el modelo "PersonaJuridicaModel"
        require_once('../../models/personaJ_model.php');
        $result_eliminar_persona_juridica = PersonaJuridicaModel::DeletePersonaJ($rif);
        return $result_eliminar_persona_juridica; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
