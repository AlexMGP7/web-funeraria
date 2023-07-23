<?php

class EstadoController
{

    function __construct()
    {
    }

    function ListarEstado()
    {
        require_once('../../views/domicilio/estado/list_estado.php');
    }

    static public function ListarEstado1()
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::Listarestado();
        return $result_Listar;
    }

    // Para insertar

    static public function BuscarUltimoEstado()
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::BuscarUltimoEstado();
        return $result_Listar;
    }

    function IngresarEstado()
    {
        require_once('../../views/domicilio/estado/insert_estado.php');
    }

    function IngresarEstado1()
    {
        require_once('../../views/domicilio/estado/insert_estado1.php');
    }

    static public function IngresarEstado2($codigo, $descripcion)
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::IngresarEstado2($codigo, $descripcion);
        return $result_Listar;
    }

    // Para actualizar

    static public function BuscarEstadoByCodigo($codigo)
    {
        require_once('../../models/estado_model.php');
        $estado_model = new EstadoModel();
        $result_estado = $estado_model->BuscarEstadoByCodigo($codigo); // Llama al método correcto en el modelo
        return $result_estado;
    }



    function UpdateEstado()
    {
        require_once('../../views/domicilio/estado/update_estado.php');
    }

    function UpdateEstado1()
    {
        require_once('../../views/domicilio/estado/update_estado1.php');
    }

    function UpdateEstado2($codigo, $descripcion)
    {
        require_once('../../models/estado_model.php');
        $result_Listar = EstadoModel::UpdateEstado2($codigo, $descripcion);
        return $result_Listar;
    }

    // Para eliminar

    function DeleteEstado()
    {
        require_once('../../views/domicilio/estado/delete_estado.php');
    }

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
        return $result_Listar;
    }
}
