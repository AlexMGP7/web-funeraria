<?php
class ResponsableJuridicoController
{

    function __construct()
    {
    }

    function ListarResponsableJ()
    {
        require_once('../../views/responsableJ/list_responsableJ.php');
    }

    static public function ListarResponsableJ1()
    {
        require_once('../../models/responsableJ_model.php');
        $result_Listar = ResponsableJuridicoModel::ListarResponsableJ();
        return $result_Listar;
    }

    static public function BuscarUltimoResponsableJ()
    {
        require_once('../../models/responsableJ_model.php');
        $result_ultimo_responsable_juridico = ResponsableJuridicoModel::BuscarUltimoResponsableJ();
        return $result_ultimo_responsable_juridico;
    }

    function IngresarResponsableJ()
    {
        require_once('../../views/responsableJ/insert_responsableJ.php');
    }

    static public function IngresarResponsableJ2($rif, $correo, $telefono, $razonSocial)
    {
        require_once('../../models/responsableJ_model.php');
        $result_insertar_responsable_juridico = ResponsableJuridicoModel::IngresarResponsableJ($rif, $correo, $telefono, $razonSocial);
        return $result_insertar_responsable_juridico;
    }

    static public function BuscarResponsableJByRif($rif)
    {
        require_once('../../models/responsableJ_model.php');
        $responsable_juridico_model = new ResponsableJuridicoModel();
        $result_responsable_juridico = $responsable_juridico_model->BuscarResponsableJByRif($rif);
        return $result_responsable_juridico;
    }

    function UpdateResponsableJ()
    {
        require_once('../../views/responsableJ/update_responsableJ.php');
    }

    function UpdateResponsableJ2($rif, $correo, $telefono, $razonSocial)
    {
        require_once('../../models/responsableJ_model.php');
        $result_actualizar_responsable_juridico = ResponsableJuridicoModel::UpdateResponsableJ($rif, $correo, $telefono, $razonSocial);
        return $result_actualizar_responsable_juridico;
    }

    function DeleteResponsableJ()
    {
        require_once('../../views/responsableJ/delete_responsableJ.php');
    }

    static public function DeleteResponsableJ1($rif)
    {
        require_once('../../models/responsableJ_model.php');
        $result_eliminar_responsable_juridico = ResponsableJuridicoModel::DeleteResponsableJ($rif);
        return $result_eliminar_responsable_juridico;
    }
}