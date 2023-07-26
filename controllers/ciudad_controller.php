<?php
class CiudadController
{
    function __construct()
    {
    }

    function ListarCiudad()
    {
        // Mostrar la vista que lista todas las ciudades
        require_once('../../views/domicilio/ciudad/list_ciudad.php');
    }

    static public function ListarCiudad1()
    {
        // Obtener la lista de ciudades del modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::ListarCiudad();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de ciudades.
    }

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

    // Para insertar

    static public function ListarParroquias()
    {
        // Obtener la lista de parroquias del modelo "ParroquiaModel"
        require_once('../../models/parroquia_model.php');
        $result_parroquias = ParroquiaModel::ListarParroquia();
        return $result_parroquias; // Devuelve el resultado de la consulta que contiene la lista de parroquias.
    }

    static public function BuscarUltimaCiudad()
    {
        // Buscar la última ciudad en el modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::BuscarUltimaCiudad();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la última ciudad.
    }

    function IngresarCiudad()
    {
        // Mostrar la vista para insertar una nueva ciudad
        require_once('../../views/domicilio/ciudad/insert_ciudad.php');
    }

    static public function IngresarCiudad2($codigo, $descripcion, $parroquia_codigo)
    {
        // Insertar una nueva ciudad en el modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $result_Ingresar = CiudadModel::IngresarCiudad2($codigo, $descripcion, $parroquia_codigo);
        return $result_Ingresar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    static public function BuscarCiudadByCodigo($codigo)
    {
        // Buscar una ciudad por su código en el modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $ciudad_model = new CiudadModel();
        $result_ciudad = $ciudad_model->BuscarCiudadByCodigo($codigo);
        return $result_ciudad; // Devuelve el resultado de la consulta que contiene la ciudad encontrada.
    }

    function UpdateCiudad()
    {
        // Mostrar la vista para actualizar una ciudad
        require_once('../../views/domicilio/ciudad/update_ciudad.php');
    }

    function UpdateCiudad2($codigo, $descripcion, $parroquia_codigo)
    {
        // Actualizar una ciudad existente en el modelo "CiudadModel"
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::UpdateCiudad2($codigo, $descripcion, $parroquia_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    function DeleteCiudad()
    {
        // Mostrar la vista para eliminar una ciudad
        require_once('../../views/domicilio/ciudad/delete_ciudad.php');
    }

    static public function DeleteCiudad1($codigo)
    {
        // Eliminar una ciudad de la tabla 'ciudad' en el modelo "CiudadModel"

        require_once('../../models/ciudad_model.php');

        $result_Listar = CiudadModel::DeleteCiudad($codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
