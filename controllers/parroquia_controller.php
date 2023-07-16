<?php
class ParroquiaController
{
    function __construct()
    {
    }

    function ListarParroquia()
    {
        require_once('../../views/parroquia/list_parroquia.php');
    }

    static public function ListarParroquia1()
    {
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::ListarParroquia();
        return $result_Listar;
    }

    // Para insertar

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

    static public function BuscarUltimaParroquia()
    {
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::BuscarUltimaParroquia();
        return $result_Listar;
    }

    static public function ObtenerMunicipiosPorEstado($estadoCodigo)
    {
        require_once('../../models/municipio_model.php');
        $result_municipios = MunicipioModel::ObtenerMunicipiosPorEstado($estadoCodigo);
        return $result_municipios;
    }



    function IngresarParroquia()
    {
        require_once('../../views/parroquia/insert_parroquia.php');
    }

    function IngresarParroquia1()
    {
        require_once('../../views/parroquia/insert_parroquia1.php');
    }

    static public function IngresarParroquia2($codigo, $descripcion, $municipio_codigo)
    {
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::IngresarParroquia2($codigo, $descripcion, $municipio_codigo);
        return $result_Listar;
    }

    // Para actualizar

    static public function BuscarParroquiaByCodigo($codigo)
    {
        require_once('../../models/parroquia_model.php');
        $parroquia_model = new ParroquiaModel();
        $result_parroquia = $parroquia_model->BuscarParroquiaByCodigo($codigo);
        return $result_parroquia;
    }

    function UpdateParroquia()
    {
        require_once('../../views/parroquia/update_parroquia.php');
    }

    function UpdateParroquia1()
    {
        require_once('../../views/parroquia/update_parroquia1.php');
    }

    function UpdateParroquia2($codigo, $descripcion, $municipio_codigo)
    {
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::UpdateParroquia2($codigo, $descripcion, $municipio_codigo);
        return $result_Listar;
    }

    // Para eliminar

    function DeleteParroquia()
    {
        require_once('../../views/parroquia/delete_parroquia.php');
    }

    static public function DeleteParroquia1($codigo)
    {
        require_once('../../models/parroquia_model.php');
        $result_Listar = ParroquiaModel::DeleteParroquia($codigo);
        return $result_Listar;
    }
}
