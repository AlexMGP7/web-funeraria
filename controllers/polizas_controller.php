<?php
class PolizasController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todas las pólizas.
    function ListarPolizas()
    {
        require_once('../../views/polizas/list_polizas.php');
    }

    // Función estática para obtener la lista de pólizas del modelo.
    static public function ListarPolizas1()
    {
        require_once('../../models/polizas_model.php');
        $result_Listar = PolizasModel::ListarPolizas();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de pólizas.
    }

    // Para insertar

    // Función estática para buscar el último número de póliza utilizado en el modelo.
    static public function BuscarUltimoNumeroPoliza()
    {
        require_once('../../models/polizas_model.php');
        $result_Listar = PolizasModel::BuscarUltimoNumeroPoliza();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene el último número de póliza.
    }

    // Función para mostrar la vista de inserción de una nueva póliza y actualizarla.
    function IngresarPoliza()
    {
        require_once('../../views/polizas/insert_polizas.php');
    }

    // Función estática para insertar una nueva póliza en el modelo.
    static public function IngresarPoliza2($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones)
    {
        require_once('../../models/polizas_model.php');
        $result_Listar = PolizasModel::IngresarPoliza($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    // Función estática para buscar una póliza por su número en el modelo.
    static public function BuscarPolizaPorNumero($numero)
    {
        require_once('../../models/polizas_model.php');
        $polizas_model = new PolizasModel();
        $result_poliza = $polizas_model->BuscarPolizaPorNumero($numero); // Llama al método correcto en el modelo
        return $result_poliza; // Devuelve el resultado de la consulta que contiene la póliza encontrada.
    }

    // Función para mostrar la vista de actualización de una póliza y actualizarla.
    function UpdatePoliza()
    {
        require_once('../../views/polizas/update_polizas.php');
    }

    // Función estática para actualizar una póliza existente en el modelo.
    function UpdatePoliza2($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones)
    {
        require_once('../../models/polizas_model.php');
        $result_Listar = PolizasModel::UpdatePoliza($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    // Función para mostrar la vista de eliminación de una póliza.
    function DeletePoliza()
    {
        require_once('../../views/polizas/delete_polizas.php');
    }

    // Función estática para eliminar una póliza de la tabla 'polizas_de_seguro' en el modelo.
    static public function DeletePoliza1($numero)
    {
        require_once('../../models/polizas_model.php');

        $result_Listar = PolizasModel::DeletePoliza($numero);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}