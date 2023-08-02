<?php
class PolizaXResponsableJController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los polizaXresponsableJ.
    function ListarPolizasXResponsableJ()
    {
        require_once('../../views/polizaXresponsableJ/list_polizaXresponsableJ.php');
    }

    static public function BuscarPolizaXResponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXresponsableJ_model.php');
        $result_poliza_x_responsableJ = PolizaXResponsableJModel::BuscarPolizasXResponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero);
        return $result_poliza_x_responsableJ; // Devuelve el resultado de la consulta que contiene el polizaXresponsableJ encontrado.
    }

    // Función estática para obtener la lista de polizaXresponsableJ del modelo.
    static public function ListarPolizasXResponsableJ1()
    {
        require_once('../../models/polizaXresponsableJ_model.php');
        $result_Listar = PolizaXResponsableJModel::ListarPolizasXResponsableJ();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de polizaXresponsableJ.
    }

    // Función para mostrar la vista de inserción de un nuevo polizaXresponsableJ y actualizarlo.
    function IngresarPolizaXResponsableJ()
    {
        require_once('../../views/polizaXresponsableJ/insert_polizaXresponsableJ.php');
    }

    // Función estática para insertar un nuevo polizaXresponsableJ en el modelo.
    static public function IngresarPolizaXResponsableJ2($responsable_juridico_rif, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXresponsableJ_model.php');
        $result_Listar = PolizaXresponsableJModel::IngresarPolizasXResponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Función para mostrar la vista de eliminación de un polizaXresponsableJ.
    function DeletePolizaXResponsableJ()
    {
        require_once('../../views/polizaXresponsableJ/delete_polizaXresponsableJ.php');
    }

    // Función estática para eliminar un polizaXresponsableJ de la tabla 'polizasXresponsableJ' en el modelo.
    static public function DeletePolizaXResponsableJ1($responsable_juridico_rif, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXresponsableJ_model.php');
        $result_Listar = PolizaXresponsableJModel::DeletePolizasXresponsableJ($responsable_juridico_rif, $polizas_de_seguro_numero);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
?>
