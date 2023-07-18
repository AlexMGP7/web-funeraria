<?php
class CiudadController
{
    function __construct()
    {
    }

    function ListarCiudad()
    {
        require_once('../../views/ciudad/list_ciudad.php');
    }

    static public function ListarCiudad1()
    {
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::ListarCiudad();
        return $result_Listar;
    }

    static public function ListarMunicipios()
    {
        require_once('../../models/municipio_model.php');
        $result_municipios = MunicipioModel::ListarMunicipio();
        return $result_municipios;
    }

    static public function ListarEstados()
    {
        require_once('../../models/estado_model.php');
        $result_estados = EstadoModel::ListarEstado();
        return $result_estados;
    }

    // Para insertar

    static public function ListarParroquias()
    {
        require_once('../../models/parroquia_model.php');
        $result_parroquias = ParroquiaModel::ListarParroquia();
        return $result_parroquias;
    }

    static public function BuscarUltimaCiudad()
    {
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::BuscarUltimaCiudad();
        return $result_Listar;
    }
    function IngresarCiudad()
    {
        require_once('../../views/ciudad/insert_ciudad.php');
    }

    function IngresarCiudad1()
    {
        require_once('../../views/ciudad/insert_ciudad1.php');
    }

    static public function IngresarCiudad2($codigo, $descripcion, $parroquia_codigo)
    {
        require_once('../../models/ciudad_model.php');
        $result_Ingresar = CiudadModel::IngresarCiudad2($codigo, $descripcion, $parroquia_codigo);
        return $result_Ingresar;
    }

    // Para actualizar

    static public function BuscarCiudadByCodigo($codigo)
    {
        require_once('../../models/ciudad_model.php');
        $ciudad_model = new CiudadModel();
        $result_ciudad = $ciudad_model->BuscarCiudadByCodigo($codigo);
        return $result_ciudad;
    }

    function UpdateCiudad()
    {
        require_once('../../views/ciudad/update_ciudad.php');
    }

    function UpdateCiudad1()
    {
        require_once('../../views/ciudad/update_ciudad1.php');
    }

    function UpdateCiudad2($codigo, $descripcion, $parroquia_codigo)
    {
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::UpdateCiudad2($codigo, $descripcion, $parroquia_codigo);
        return $result_Listar;
    }

    // Para eliminar

    function DeleteCiudad()
    {
        require_once('../../views/ciudad/delete_ciudad.php');
    }

    static public function DeleteCiudad1($codigo)
    {
        require_once('../../models/ciudad_model.php');
        $result_Listar = CiudadModel::DeleteCiudad($codigo);
        return $result_Listar;
    }
}
