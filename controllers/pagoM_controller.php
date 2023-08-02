<?php
class PagoMController
{

    function __construct()
    {
    }

    function ListarPagoM()
    {
        require_once('../../views/pagoM/list_pagoM.php');
    }

    static public function ListarPagoM1()
    {
        require_once('../../models/pagoM_model.php');
        $result_Listar = PagoMModel::ListarPagoM();
        return $result_Listar;
    }

    static public function BuscarUltimoPagoM()
    {
        require_once('../../models/pagoM_model.php');
        $result_ultima_pagoM = PagoMModel::BuscarUltimoPagoM();
        return $result_ultima_pagoM;
    }

    function IngresarPagoM()
    {
        require_once('../../views/pagoM/insert_pagoM.php');
    }

    static public function IngresarPagoM2($numero, $fecha, $monto, $numero_poliza)
    {
        require_once('../../models/pagoM_model.php');
        $result_insertar_pagoM = PagoMModel::IngresarPagoM($numero, $fecha, $monto, $numero_poliza);
        return $result_insertar_pagoM;
    }

    static public function BuscarPagoMPorNumero($numero)
    {
        require_once('../../models/pagoM_model.php');
        $pagoM_model = new PagoMModel();
        $result_pagoM = $pagoM_model->BuscarPagoMByNumero($numero);
        return $result_pagoM;
    }

    function UpdatePagoM()
    {
        require_once('../../views/pagoM/update_pagoM.php');
    }

    function UpdatePagoM2($numero, $fecha, $monto, $numero_poliza)
    {
        require_once('../../models/pagoM_model.php');
        $result_actualizar_pagoM = PagoMModel::UpdatePagoM($numero, $fecha, $monto, $numero_poliza);
        return $result_actualizar_pagoM;
    }

    function DeletePagoM()
    {
        require_once('../../views/pagoM/delete_pagoM.php');
    }

    static public function DeletePagoM1($numero)
    {
        require_once('../../models/pagoM_model.php');
        $result_eliminar_pagoM = PagoMModel::DeletePagoM($numero);
        return $result_eliminar_pagoM;
    }
}
?>
