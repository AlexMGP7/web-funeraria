<?php

class CementerioController
{

    function __construct()
    {
    }

    function ListarCementerios()
    {
        // Mostrar la vista que lista todos los cementerios
        require_once('../../views/cementerio/list_cementerio.php');
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
        require_once('../../models/personaJuridica_model.php');
        $result_Listar = PersonaJuridicaModel::ListarPersonaJ();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de personas jurídicas.
    }

    static public function ListarCementerios1()
    {
        // Obtener la lista de cementerios del modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $result_Listar = CementerioModel::ListarCementerios();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de cementerios.
    }

    // Para insertar

    static public function BuscarUltimoCementerio()
    {
        // Buscar el último cementerio en el modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $result_ultima_cementerio = CementerioModel::BuscarUltimoCementerio();
        return $result_ultima_cementerio; // Devuelve el resultado de la consulta que contiene el último cementerio.
    }

    function IngresarCementerio()
    {
        // Mostrar la vista para insertar un nuevo cementerio
        require_once('../../views/cementerio/insert_cementerio.php');
    }

    static public function IngresarCementerio2($rif, $codigo, $tipo)
    {
        // Insertar un nuevo cementerio en el modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $result_insertar_cementerio = CementerioModel::IngresarCementerio2($rif, $codigo, $tipo);
        return $result_insertar_cementerio; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarCementerioByRif($rif)
    {
        // Buscar un cementerio por su RIF en el modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $cementerio_model = new CementerioModel();
        $result_cementerio = $cementerio_model->BuscarCementerioByRif($rif); // Llama al método correcto en el modelo
        return $result_cementerio; // Devuelve el resultado de la consulta que contiene el cementerio encontrado.
    }

    function UpdateCementerio()
    {
        // Mostrar la vista para actualizar un cementerio
        require_once('../../views/cementerio/update_cementerio.php');
    }

    function UpdateCementerio2($rif, $codigo, $tipo)
    {
        // Actualizar un cementerio existente en el modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $result_actualizar_cementerio = CementerioModel::UpdateCementerio2($rif, $codigo, $tipo);
        return $result_actualizar_cementerio; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeleteCementerio()
    {
        // Mostrar la vista para eliminar un cementerio
        require_once('../../views/cementerio/delete_cementerio.php');
    }

    static public function DeleteCementerio1($rif)
    {
        // Eliminar un cementerio de la tabla 'cementerio' en el modelo "CementerioModel"
        require_once('../../models/cementerio_model.php');
        $result_eliminar_cementerio = CementerioModel::DeleteCementerio($rif);
        return $result_eliminar_cementerio; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
