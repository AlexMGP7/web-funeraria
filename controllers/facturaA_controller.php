<?php
class FacturaAController
{

    function __construct()
    {
    }

    function ListarFacturaA()
    {
        require_once('../../views/facturaA/list_facturaA.php');
    }

    static public function ListarFacturaA1()
    {
        require_once('../../models/facturaA_model.php');
        $result_Listar = FacturaAModel::ListarFacturaA();
        return $result_Listar;
    }

    static public function BuscarUltimaFacturaA()
    {
        require_once('../../models/facturaA_model.php');
        $result_ultima_facturaA = FacturaAModel::BuscarUltimaFacturaA();
        return $result_ultima_facturaA;
    }

    function IngresarFacturaA()
    {
        require_once('../../views/facturaA/insert_facturaA.php');
    }

    static public function IngresarFacturaA2($numero, $fecha, $monto, $numero_poliza)
    {
        require_once('../../models/facturaA_model.php');
        $result_insertar_facturaA = FacturaAModel::IngresarFacturaA($numero, $fecha, $monto, $numero_poliza);
        return $result_insertar_facturaA;
    }

    static public function BuscarFacturaAPorNumero($numero)
    {
        require_once('../../models/facturaA_model.php');
        $facturaA_model = new FacturaAModel();
        $result_facturaA = $facturaA_model->BuscarFacturaAByNumero($numero);
        return $result_facturaA;
    }

    function UpdateFacturaA()
    {
        require_once('../../views/facturaA/update_facturaA.php');
    }

    function UpdateFacturaA2($numero, $fecha, $monto, $numero_poliza)
    {
        require_once('../../models/facturaA_model.php');
        $result_actualizar_facturaA = FacturaAModel::UpdateFacturaA($numero, $fecha, $monto, $numero_poliza);
        return $result_actualizar_facturaA;
    }

    function DeleteFacturaA()
    {
        require_once('../../views/facturaA/delete_facturaA.php');
    }

    static public function DeleteFacturaA1($numero)
    {
        require_once('../../models/facturaA_model.php');
        $result_eliminar_facturaA = FacturaAModel::DeleteFacturaA($numero);
        return $result_eliminar_facturaA;
    }
}
?>
