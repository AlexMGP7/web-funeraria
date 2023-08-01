<?php
class ServiciosXFunerariaController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los serviciosXfuneraria.
    function ListarServiciosXFuneraria()
    {
        require_once('../../views/serviciosXfuneraria/list_serviciosXfuneraria.php');
    }

    static public function BuscarServicioXFuneraria($funeraria_rif, $servicios_prestados_codigo)
    {
        require_once('../../models/serviciosXfuneraria_model.php');
        $result_servicio_x_funeraria = ServiciosXFunerariaModel::BuscarServiciosXFuneraria($funeraria_rif, $servicios_prestados_codigo);
        return $result_servicio_x_funeraria; // Devuelve el resultado de la consulta que contiene el servicioXfuneraria encontrado.
    }

    // Función estática para obtener la lista de serviciosXfuneraria del modelo.
    static public function ListarServiciosXFuneraria1()
    {
        require_once('../../models/serviciosXfuneraria_model.php');
        $result_Listar = ServiciosXFunerariaModel::ListarServiciosXFuneraria();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de serviciosXfuneraria.
    }

    // Función para mostrar la vista de inserción de un nuevo servicioXfuneraria y actualizarlo.
    function IngresarServicioXFuneraria()
    {
        require_once('../../views/serviciosXfuneraria/insert_serviciosXfuneraria.php');
    }

    // Función estática para insertar un nuevo servicioXfuneraria en el modelo.
    static public function IngresarServicioXFuneraria2($funeraria_rif, $servicios_prestados_codigo)
    {
        require_once('../../models/serviciosXfuneraria_model.php');
        $result_Listar = ServiciosXFunerariaModel::IngresarServiciosXFuneraria($funeraria_rif, $servicios_prestados_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Función para mostrar la vista de eliminación de un servicioXfuneraria.
    function DeleteServicioXFuneraria()
    {
        require_once('../../views/serviciosXfuneraria/delete_serviciosXfuneraria.php');
    }

    // Función estática para eliminar un servicioXfuneraria de la tabla 'serviciosXfuneraria' en el modelo.
    static public function DeleteServicioXFuneraria1($funeraria_rif, $servicios_prestados_codigo)
    {
        require_once('../../models/serviciosXfuneraria_model.php');
        $result_Listar = ServiciosXFunerariaModel::DeleteServiciosXFuneraria($funeraria_rif, $servicios_prestados_codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}