<?php
class PolizaXpersonaNController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los polizaXpersonaN. 
    function ListarPolizasXpersonaN()
    {
        require_once('../../views/polizaXpersonaN/list_polizaXpersonaN.php');
    }

    static public function BuscarPolizaXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXpersonaN_model.php');
        $result_poliza_x_personaN = PolizaXpersonaNModel::BuscarPolizasXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero);
        return $result_poliza_x_personaN; // Devuelve el resultado de la consulta que contiene el polizaXpersonaN encontrado. 
    }

    // Función estática para obtener la lista de polizaXpersonaN del modelo. 
    static public function ListarPolizasXpersonaN1()
    {
        require_once('../../models/polizaXpersonaN_model.php');
        $result_Listar = PolizaXpersonaNModel::ListarPolizasXpersonaN();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de polizaXpersonaN. 
    }

    // Función para mostrar la vista de inserción de un nuevo polizaXpersonaN y actualizarlo. 
    function IngresarPolizaXpersonaN()
    {
        require_once('../../views/polizaXpersonaN/insert_polizaXpersonaN.php');
    }

    // Función estática para insertar un nuevo polizaXpersonaN en el modelo. 
    static public function IngresarPolizaXpersonaN2($persona_natural_cedula, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXpersonaN_model.php');
        $result_Listar = PolizaXpersonaNModel::IngresarPolizasXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false). 
    }

    // Función para mostrar la vista de eliminación de un polizaXpersonaN. 
    function DeletePolizaXpersonaN()
    {
        require_once('../../views/polizaXpersonaN/delete_polizaXpersonaN.php');
    }

    // Función estática para eliminar un polizaXpersonaN de la tabla 'Persona_Natural_has_Polizas_De_Seguro' en el modelo. 
    static public function DeletePolizaXpersonaN1($persona_natural_cedula, $polizas_de_seguro_numero)
    {
        require_once('../../models/polizaXpersonaN_model.php');
        $result_Listar = PolizaXpersonaNModel::DeletePolizasXpersonaN($persona_natural_cedula, $polizas_de_seguro_numero);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false). 
    }
}
