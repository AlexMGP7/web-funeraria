<?php

class DifuntoController
{

    function __construct()
    {
    }

    function ListarDifuntos()
    {
        // Mostrar la vista que lista todos los difuntos
        require_once('../../views/difunto/list_difunto.php');
    }

    static public function ListarPersonas()
    {
        // Obtener la lista de personas del modelo "PersonaModel"
        require_once('../../models/persona_model.php');
        $result_personas = PersonaModel::ListarPersona();
        return $result_personas; // Devuelve el resultado de la consulta que contiene la lista de personas.
    }

    static public function ListarCementerios()
    {
        // Obtener la lista de cementerios del modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $result_cementerios = CementerioModel::ListarCementerios();
        return $result_cementerios; // Devuelve el resultado de la consulta que contiene la lista de cementerios.
    }

    static public function ListarDifuntos1()
    {
        // Obtener la lista de ciudades del modelo "CiudadModel"
        require_once('../../models/difunto_model.php');
        $result_Listar = DifuntoModel::ListarDifuntos();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de ciudades.
    }

    // Para insertar

    static public function BuscarUltimaCedula()
    {
        // Buscar la última cédula en el modelo "DifuntoModel"
        require_once('../../models/difunto_model.php');
        $result_ultima_cedula = DifuntoModel::BuscarUltimaCedula();
        return $result_ultima_cedula; // Devuelve el resultado de la consulta que contiene la última cédula.
    }

    function IngresarDifunto()
    {
        // Mostrar la vista para insertar un nuevo difunto
        require_once('../../views/difunto/insert_difunto.php');
    }

    static public function IngresarDifunto2($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif)
    {
        // Insertar un nuevo difunto en el modelo "DifuntoModel"
        require_once('../../models/difunto_model.php');
        $result_insertar_difunto = DifuntoModel::IngresarDifunto($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif);
        return $result_insertar_difunto; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarDifuntoByCedula($cedula)
    {
        // Buscar un difunto por su cédula en el modelo "DifuntoModel"
        require_once('../../models/difunto_model.php');
        $result_difunto = DifuntoModel::BuscarDifuntoByCedula($cedula);
        return $result_difunto; // Devuelve el resultado de la consulta que contiene el difunto encontrado.
    }

    function UpdateDifunto()
    {
        // Mostrar la vista para actualizar un difunto
        require_once('../../views/difunto/update_difunto.php');
    }

    function UpdateDifunto2($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif)
    {
        // Actualizar un difunto existente en el modelo "DifuntoModel"
        require_once('../../models/difunto_model.php');
        $result_actualizar_difunto = DifuntoModel::UpdateDifunto($cedula, $fechaN, $fechaD, $partidaN, $causaM, $cementerioRif);
        return $result_actualizar_difunto; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeleteDifunto()
    {
        // Mostrar la vista para eliminar un difunto
        require_once('../../views/difunto/delete_difunto.php');
    }

    static public function DeleteDifunto1($cedula)
    {
        // Eliminar un difunto de la tabla 'difunto' en el modelo "DifuntoModel"
        require_once('../../models/difunto_model.php');
        $result_eliminar_difunto = DifuntoModel::DeleteDifunto($cedula);
        return $result_eliminar_difunto; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
