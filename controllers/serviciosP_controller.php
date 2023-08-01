<?php
class ServiciosPController
{
    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los servicios prestados.
    function ListarServiciosP()
    {
        require_once('../../views/serviciosP/list_serviciosP.php');
    }

    // Función estática para obtener la lista de servicios prestados del modelo.
    static public function ListarServiciosP1()
    {
        require_once('../../models/serviciosP_model.php');
        $result_Listar = ServiciosPModel::ListarServiciosP();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de servicios prestados.
    }

    // Para insertar

    // Función estática para buscar el último código de servicio prestado utilizado en el modelo.
    static public function BuscarUltimoServicioP()
    {
        require_once('../../models/serviciosP_model.php');
        $result_Listar = ServiciosPModel::BuscarUltimoServiciosP();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene el último código de servicio prestado.
    }

    // Función para mostrar la vista de inserción de un nuevo servicio prestado y actualizarlo.
    function IngresarServicioP()
    {
        require_once('../../views/serviciosP/insert_serviciosP.php');
    }

    // Función estática para insertar un nuevo servicio prestado en el modelo.
    static public function IngresarServicioP2($codigo, $nombre, $tipo, $monto)
    {
        require_once('../../models/serviciosP_model.php');
        $result_Listar = ServiciosPModel::IngresarServiciosP($codigo, $nombre, $tipo, $monto);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    // Función estática para buscar un servicio prestado por su código en el modelo.
    static public function BuscarServicioPByCodigo($codigo)
    {
        require_once('../../models/serviciosP_model.php');
        $serviciosP_model = new ServiciosPModel();
        $result_servicioP = $serviciosP_model->BuscarServiciosPByCodigo($codigo); // Llama al método correcto en el modelo
        return $result_servicioP; // Devuelve el resultado de la consulta que contiene el servicio prestado encontrado.
    }

    // Función para mostrar la vista de actualización de un servicio prestado y actualizarlo.
    function UpdateServicioP()
    {
        require_once('../../views/serviciosP/update_serviciosP.php');
    }

    // Función estática para actualizar un servicio prestado existente en el modelo.
    function UpdateServicioP2($codigo, $nombre, $tipo, $monto)
    {
        require_once('../../models/serviciosP_model.php');
        $result_Listar = ServiciosPModel::UpdateServiciosP($codigo, $nombre, $tipo, $monto);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    // Función para mostrar la vista de eliminación de un servicio prestado.
    function DeleteServicioP()
    {
        require_once('../../views/serviciosP/delete_serviciosP.php');
    }

    // Función estática para eliminar un servicio prestado de la tabla 'serviciosP' en el modelo.
    static public function DeleteServicioP1($codigo)
    {
        require_once('../../models/serviciosP_model.php');

        $result_Listar = ServiciosPModel::DeleteServiciosP($codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}