<?php
class MunicipioController
{
    function __construct()
    {
    }

    function ListarMunicipio()
    {
        // Mostrar la vista que lista todos los municipios
        require_once('../../views/domicilio/municipio/list_municipio.php');
    }

    static public function ListarMunicipio1()
    {
        // Obtener la lista de municipios del modelo "MunicipioModel"
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::ListarMunicipio();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de municipios.
    }

    // Para insertar

    static public function ListarEstados()
    {
        // Obtener la lista de estados del modelo "EstadoModel"
        require_once('../../models/estado_model.php');
        $result_estados = EstadoModel::ListarEstado();
        return $result_estados; // Devuelve el resultado de la consulta que contiene la lista de estados.
    }

    static public function BuscarUltimoMunicipio()
    {
        // Buscar el último municipio en el modelo "MunicipioModel"
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::BuscarUltimoMunicipio();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene el último municipio.
    }

    function IngresarMunicipio()
    {
        // Mostrar la vista para insertar un nuevo municipio
        require_once('../../views/domicilio/municipio/insert_municipio.php');
    }

    function IngresarMunicipio1()
    {
        // Logica que ingresa al nuevo municipio y manda mensaje
        require_once('../../views/domicilio/municipio/insert_municipio1.php');
    }

    static public function IngresarMunicipio2($codigo, $descripcion, $codigoEstado)
    {
        // Insertar un nuevo municipio en el modelo "MunicipioModel"
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::IngresarMunicipio2($codigo, $descripcion, $codigoEstado);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarMunicipioByCodigo($codigo)
    {
        // Buscar un municipio por su código en el modelo "MunicipioModel"
        require_once('../../models/municipio_model.php');
        $municipio_model = new MunicipioModel();
        $result_municipio = $municipio_model->BuscarMunicipioByCodigo($codigo);
        return $result_municipio; // Devuelve el resultado de la consulta que contiene el municipio encontrado.
    }

    function UpdateMunicipio()
    {
        // Mostrar la vista para actualizar un municipio
        require_once('../../views/domicilio/municipio/update_municipio.php');
    }

    function UpdateMunicipio1()
    {
        // Logica para actualizar al municipio y manda el mensaje
        require_once('../../views/domicilio/municipio/update_municipio1.php');
    }

    function UpdateMunicipio2($codigo, $descripcion, $codigoEstado)
    {
        // Actualizar un municipio existente en el modelo "MunicipioModel"
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::UpdateMunicipio2($codigo, $descripcion, $codigoEstado);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeleteMunicipio()
    {
        // Mostrar la vista para eliminar un municipio
        require_once('../../views/domicilio/municipio/delete_municipio.php');
    }

    static public function DeleteMunicipio1($codigo)
    {
        // Eliminar un municipio de la tabla 'municipio' en el modelo "MunicipioModel"

        require_once('../../models/municipio_model.php');

        // Verificar si existen registros relacionados en otras tablas
        $hasReferencedRecords = MunicipioModel::CheckReferencedRecords($codigo);

        if ($hasReferencedRecords) {
            throw new Exception("No se puede eliminar el municipio porque tiene claves foráneas referenciadas en otras tablas.");
        }

        // Si no hay referencias, procede con la eliminación
        $result_Listar = MunicipioModel::DeleteMunicipio($codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
