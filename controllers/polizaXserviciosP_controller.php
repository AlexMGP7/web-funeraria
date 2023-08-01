<?php
class PolizasXservicioPController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los polizasXservicioP.
    function ListarPolizasXservicioP()
    {
        require_once('../../views/polizasXserviciosP/list_polizasXserviciosP.php');
    }

    static public function BuscarPolizaXservicioP($poliza_numero, $servicios_prestados_codigo)
    {
        require_once('../../models/polizasXserviciosP_model.php');
        $result_poliza_x_servicioP = PolizasXservicioPModel::BuscarPolizasXservicioP($poliza_numero, $servicios_prestados_codigo);
        return $result_poliza_x_servicioP; // Devuelve el resultado de la consulta que contiene el polizaXservicioP encontrado.
    }

    // Función estática para obtener la lista de polizasXservicioP del modelo.
    static public function ListarPolizasXservicioP1()
    {
        require_once('../../models/polizasXserviciosP_model.php');
        $result_Listar = PolizasXservicioPModel::ListarPolizasXservicioP();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de polizasXservicioP.
    }

    // Función para mostrar la vista de inserción de un nuevo polizaXservicioP y actualizarlo.
    function IngresarPolizaXservicioP()
    {
        require_once('../../views/polizasXserviciosP/insert_polizasXservicioP.php');
    }

    // Función estática para insertar un nuevo polizaXservicioP en el modelo.
    static public function IngresarPolizaXservicioP2($poliza_numero, $servicios_prestados_codigo)
    {
        require_once('../../models/polizasXserviciosP_model.php');
        $result_Listar = PolizasXservicioPModel::IngresarPolizasXservicioP($poliza_numero, $servicios_prestados_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Función para mostrar la vista de eliminación de un polizaXservicioP.
    function DeletePolizaXservicioP()
    {
        require_once('../../views/polizasXserviciosP/delete_polizasXservicioP.php');
    }

    // Función estática para eliminar un polizaXservicioP de la tabla 'polizasXservicioP' en el modelo.
    static public function DeletePolizaXservicioP1($poliza_numero, $servicios_prestados_codigo)
    {
        require_once('../../models/polizasXserviciosP_model.php');
        $result_Listar = PolizasXservicioPModel::DeletePolizasXservicioP($poliza_numero, $servicios_prestados_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
?>