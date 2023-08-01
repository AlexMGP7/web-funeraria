<?php
class FunerariaController
{

    function __construct()
    {
    }

    function ListarFuneraria()
    {
        require_once('../../views/funeraria/list_funeraria.php');
    }

    static public function ListarFuneraria1()
    {
        require_once('../../models/funeraria_model.php');
        $result_Listar = FunerariaModel::ListarFunerarias();
        return $result_Listar;
    }

    static public function BuscarUltimaFuneraria()
    {
        require_once('../../models/funeraria_model.php');
        $result_ultima_funeraria = FunerariaModel::BuscarUltimaFuneraria();
        return $result_ultima_funeraria;
    }

    function IngresarFuneraria()
    {
        require_once('../../views/funeraria/insert_funeraria.php');
    }

    static public function IngresarFuneraria2($rif, $tipo)
    {
        require_once('../../models/funeraria_model.php');
        $result_insertar_funeraria = FunerariaModel::IngresarFuneraria($rif, $tipo);
        return $result_insertar_funeraria;
    }

    static public function BuscarFunerariaPorRif($rif)
    {
        require_once('../../models/funeraria_model.php');
        $funeraria_model = new FunerariaModel();
        $result_funeraria = $funeraria_model->BuscarFunerariaByRif($rif);
        return $result_funeraria;
    }

    function UpdateFuneraria()
    {
        require_once('../../views/funeraria/update_funeraria.php');
    }

    function UpdateFuneraria2($rif, $tipo)
    {
        require_once('../../models/funeraria_model.php');
        $result_actualizar_funeraria = FunerariaModel::UpdateFuneraria($rif, $tipo);
        return $result_actualizar_funeraria;
    }

    function DeleteFuneraria()
    {
        require_once('../../views/funeraria/delete_funeraria.php');
    }

    static public function DeleteFuneraria1($rif)
    {
        require_once('../../models/funeraria_model.php');
        $result_eliminar_funeraria = FunerariaModel::DeleteFuneraria($rif);
        return $result_eliminar_funeraria;
    }
}