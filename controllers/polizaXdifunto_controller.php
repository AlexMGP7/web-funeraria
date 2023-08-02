<?php
class PolizaXdifuntoController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los polizaXdifunto.
    function ListarPolizasXdifunto()
    {
        require_once('../../views/polizaXdifunto/list_polizaXdifunto.php');
    }

    static public function BuscarPolizaXdifunto($difunto_cedula, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXdifunto_model.php');
        $result_poliza_x_difunto = PolizaXdifuntoModel::BuscarPolizasXdifunto($difunto_cedula, $polizas_de_seguro_numero);
        return $result_poliza_x_difunto; // Devuelve el resultado de la consulta que contiene el polizaXdifunto encontrado.
    }

    // Función estática para obtener la lista de polizaXdifunto del modelo.
    static public function ListarPolizasXdifunto1()
    {
        require_once('../../models/polizaXdifunto_model.php');
        $result_Listar = PolizaXdifuntoModel::ListarPolizasXdifunto();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de polizaXdifunto.
    }

    // Función para mostrar la vista de inserción de un nuevo polizaXdifunto y actualizarlo.
    function IngresarPolizaXdifunto()
    {
        require_once('../../views/polizaXdifunto/insert_polizaXdifunto.php');
    }

    // Función estática para insertar un nuevo polizaXdifunto en el modelo.
    static public function IngresarPolizaXdifunto2($difunto_cedula, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXdifunto_model.php');
        $result_Listar = PolizaXdifuntoModel::IngresarPolizasXdifunto($difunto_cedula, $polizas_de_seguro_numero);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Función para mostrar la vista de eliminación de un polizaXdifunto.
    function DeletePolizaXdifunto()
    {
        require_once('../../views/polizaXdifunto/delete_polizaXdifunto.php');
    }

    // Función estática para eliminar un polizaXdifunto de la tabla 'Difunto_has_Polizas_De_Seguro' en el modelo.
    static public function DeletePolizaXdifunto1($difunto_cedula, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXdifunto_model.php');
        $result_Listar = PolizaXdifuntoModel::DeletePolizasXdifunto($difunto_cedula, $polizas_de_seguro_numero);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
?>