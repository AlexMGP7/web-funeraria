<?php

class PersonaController
{

    function __construct()
    {
    }

    function ListarPersona()
    {
        require_once('../../views/persona/list_persona.php');
    }

    static public function ListarCiudades()
    {
        require_once('../../models/ciudad_model.php');
        $result_estados = CiudadModel::ListarCiudad();
        return $result_estados;
    }

    static public function ListarPersona1()
    {
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::ListarPersona();
        return $result_Listar;
    }

    // Para insertar

    static public function BuscarUltimaPersona()
    {
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::BuscarUltimaPersona();
        return $result_Listar;
    }

    function IngresarPersona()
    {
        require_once('../../views/persona/insert_persona.php');
    }

    function IngresarPersona1()
    {
        require_once('../../views/persona/insert_persona1.php');
    }

    static public function IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo)
    {
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo);
        return $result_Listar;
    }

    // Para actualizar

    static public function BuscarPersonaByCedula($cedula)
    {
        require_once('../../models/persona_model.php');
        $persona_model = new PersonaModel();
        $result_persona = $persona_model->BuscarPersonaByCedula($cedula); // Llama al método correcto en el modelo
        return $result_persona;
    }

    function UpdatePersona()
    {
        require_once('../../views/persona/update_persona.php');
    }

    function UpdatePersona1()
    {
        require_once('../../views/persona/update_persona1.php');
    }

    function UpdatePersona2($cedula, $nombre, $apellido, $ciudadCodigo)
    {
        require_once('../../models/persona_model.php');
        $result_Listar = PersonaModel::UpdatePersona2($cedula, $nombre, $apellido, $ciudadCodigo);
        return $result_Listar;
    }

    // Para eliminar

    function DeletePersona()
    {
        require_once('../../views/persona/delete_persona.php');
    }

    static public function DeletePersona1($cedula)
    {
        require_once('../../models/persona_model.php');

        // Verificar si existen registros relacionados en otras tablas
        $hasReferencedRecords = PersonaModel::CheckReferencedRecords($cedula);

        if ($hasReferencedRecords) {
            throw new Exception("No se puede eliminar la persona porque tiene claves foráneas referenciadas en otras tablas.");
        }

        // Si no hay referencias, procede con la eliminación
        $result_Listar = PersonaModel::DeletePersona($cedula);
        return $result_Listar;
    }
}
