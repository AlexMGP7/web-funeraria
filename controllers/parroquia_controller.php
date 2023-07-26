<?php
class ParroquiaController
{
    function __construct()
    {
    }

    function ListarParroquia()
    {
        // Mostrar la vista que lista todas las parroquias
        require_once('../../views/domicilio/parroquia/list_parroquia.php');
    }

    static public function ListarParroquia1()
    {
        // Obtener la lista de parroquias del modelo "ParroquiaModel"
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::ListarParroquia();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de parroquias.
    }

    // Para insertar

    static public function ListarMunicipios()
    {
        // Obtener la lista de municipios del modelo "MunicipioModel"
        require_once('../../models/municipio_model.php');
        $result_municipios = MunicipioModel::ListarMunicipio();
        return $result_municipios; // Devuelve el resultado de la consulta que contiene la lista de municipios.
    }

    static public function ListarEstados()
    {
        // Obtener la lista de estados del modelo "EstadoModel"
        require_once('../../models/estado_model.php');
        $result_estados = EstadoModel::ListarEstado();
        return $result_estados; // Devuelve el resultado de la consulta que contiene la lista de estados.
    }

    static public function BuscarUltimaParroquia()
    {
        // Buscar la última parroquia en el modelo "ParroquiaModel"
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::BuscarUltimaParroquia();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la última parroquia.
    }

    function IngresarParroquia()
    {
        // Mostrar la vista para insertar una nueva parroquia
        require_once('../../views/domicilio/parroquia/insert_parroquia.php');
    }

    static public function IngresarParroquia2($codigo, $descripcion, $municipio_codigo)
    {
        // Insertar una nueva parroquia en el modelo "ParroquiaModel"
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::IngresarParroquia2($codigo, $descripcion, $municipio_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarParroquiaByCodigo($codigo)
    {
        // Buscar una parroquia por su código en el modelo "ParroquiaModel"
        require_once('../../models/parroquia_model.php');
        $parroquia_model = new ParroquiaModel();
        $result_parroquia = $parroquia_model->BuscarParroquiaByCodigo($codigo);
        return $result_parroquia; // Devuelve el resultado de la consulta que contiene la parroquia encontrada.
    }

    function UpdateParroquia()
    {
        // Mostrar la vista para actualizar una parroquia
        require_once('../../views/domicilio/parroquia/update_parroquia.php');
    }

    function UpdateParroquia2($codigo, $descripcion, $municipio_codigo)
    {
        // Actualizar una parroquia existente en el modelo "ParroquiaModel"
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::UpdateParroquia2($codigo, $descripcion, $municipio_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeleteParroquia()
    {
        // Mostrar la vista para eliminar una parroquia
        require_once('../../views/domicilio/parroquia/delete_parroquia.php');
    }

    static public function DeleteParroquia1($codigo)
    {
        // Eliminar una parroquia de la tabla 'parroquia' en el modelo "ParroquiaModel"

        require_once('../../models/parroquia_model.php');

        $result_Listar = ParroquiaModel::DeleteParroquia($codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
