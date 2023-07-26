<?php

class EstadoController
{

    function __construct()
    {
    }

    // Función para mostrar la vista que lista todos los estados.
    function ListarEstado()
    {
        require_once('../../views/domicilio/estado/list_estado.php');
    }

    // Función estática para obtener la lista de estados del modelo.
    static public function ListarEstado1()
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::ListarEstado();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene la lista de estados.
    }

    // Para insertar

    // Función estática para buscar el último código de estado utilizado en el modelo.
    static public function BuscarUltimoEstado()
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::BuscarUltimoEstado();
        return $result_Listar; // Devuelve el resultado de la consulta que contiene el último código de estado.
    }

    // Función para mostrar la vista de inserción de un nuevo estado.
    function IngresarEstado()
    {
        require_once('../../views/domicilio/estado/insert_estado.php');
    }

    // Función para mostrar la vista con un formulario para insertar un nuevo estado.
    function IngresarEstado1()
    {
        require_once('../../views/domicilio/estado/insert_estado1.php');
    }

    // Función estática para insertar un nuevo estado en el modelo.
    static public function IngresarEstado2($codigo, $descripcion)
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::IngresarEstado2($codigo, $descripcion);
        return $result_Listar; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para actualizar

    // Función estática para buscar un estado por su código en el modelo.
    static public function BuscarEstadoByCodigo($codigo)
    {
        require_once('../../models/estado_model.php');
        $estado_model = new EstadoModel();
        $result_estado = $estado_model->BuscarEstadoByCodigo($codigo); // Llama al método correcto en el modelo
        return $result_estado; // Devuelve el resultado de la consulta que contiene el estado encontrado.
    }

    // Función para mostrar la vista de actualización de un estado.
    function UpdateEstado()
    {
        require_once('../../views/domicilio/estado/update_estado.php');
    }

    // Función para mostrar la vista con un formulario para actualizar un estado.
    function UpdateEstado1()
    {
        require_once('../../views/domicilio/estado/update_estado1.php');
    }

    // Función estática para actualizar un estado existente en el modelo.
    function UpdateEstado2($codigo, $descripcion)
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::UpdateEstado2($codigo, $descripcion);
        return $result_Listar; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    // Función para mostrar la vista de eliminación de un estado.
    function DeleteEstado()
    {
        require_once('../../views/domicilio/estado/delete_estado.php');
    }

    // Función estática para eliminar un estado de la tabla 'estado' en el modelo.
    static public function DeleteEstado1($codigo)
    {
        require_once('../../models/estado_model.php');

        // Verificar si existen registros relacionados en otras tablas
        $hasReferencedRecords = EstadoModel::CheckReferencedRecords($codigo);

        if ($hasReferencedRecords) {
            throw new Exception("No se puede eliminar el estado porque tiene claves foráneas referenciadas en otras tablas.");
        }

        // Si no hay referencias, procede con la eliminación
        $result_Listar = EstadoModel::DeleteEstado($codigo);
        return $result_Listar; // Devuelve el resultado de la operación de eliminación (true o false).
    }
}
