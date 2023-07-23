<?php
class MunicipioController
{
    function __construct()
    {
    }

    function ListarMunicipio()
    {
        require_once('../../views/municipio/list_municipio.php');
    }

    static public function ListarMunicipio1()
    {
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::ListarMunicipio();
        return $result_Listar;
    }

    // Para insertar

    static public function ListarEstados()
    {
        require_once('../../models/estado_model.php');
        $result_estados = EstadoModel::ListarEstado();
        return $result_estados;
    }

    static public function BuscarUltimoMunicipio()
    {
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::BuscarUltimoMunicipio();
        return $result_Listar;
    }

    function IngresarMunicipio()
    {
        require_once('../../views/municipio/insert_municipio.php');
    }

    function IngresarMunicipio1()
    {
        require_once('../../views/municipio/insert_municipio1.php');
    }

    static public function IngresarMunicipio2($codigo, $descripcion, $codigoEstado)
    {
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::IngresarMunicipio2($codigo, $descripcion, $codigoEstado);
        return $result_Listar;
    }

    // Para actualizar

    static public function BuscarMunicipioByCodigo($codigo)
    {
        require_once('../../models/municipio_model.php');
        $municipio_model = new MunicipioModel();
        $result_municipio = $municipio_model->BuscarMunicipioByCodigo($codigo);
        return $result_municipio;
    }

    function UpdateMunicipio()
    {
        require_once('../../views/municipio/update_municipio.php');
    }

    function UpdateMunicipio1()
    {
        require_once('../../views/municipio/update_municipio1.php');
    }

    function UpdateMunicipio2($codigo, $descripcion, $codigoEstado)
    {
        require_once('../../models/municipio_model.php');
        $result_Listar = MunicipioModel::UpdateMunicipio2($codigo, $descripcion, $codigoEstado);
        return $result_Listar;
    }

    // Para eliminar

    function DeleteMunicipio()
    {
        require_once('../../views/municipio/delete_municipio.php');
    }

    static public function DeleteMunicipio1($codigo)
    {
        require_once('../../models/municipio_model.php');

        // Verificar si existen registros relacionados en otras tablas
        $hasReferencedRecords = MunicipioModel::CheckReferencedRecords($codigo);

        if ($hasReferencedRecords) {
            throw new Exception("No se puede eliminar el municipio porque tiene claves foráneas referenciadas en otras tablas.");
        }

        // Si no hay referencias, procede con la eliminación
        $result_Listar = MunicipioModel::DeleteMunicipio($codigo);
        return $result_Listar;
    }

    function ListarMunicipiosPorEstado()
    {
        // $debug_message = "Se ha accedido a la función ListarMunicipiosPorEstado en el controlador.";

        // // Imprimir el mensaje en el log de errores del servidor
        // error_log($debug_message);

        // Obtener el código del estado seleccionado desde la solicitud AJAX
        $estadoCodigo = $_POST['estadoCodigo'];

        // Llamar a la función del modelo para obtener los municipios por estado
        require_once('../../models/municipio_model.php');
        $result_municipios = MunicipioModel::ListarMunicipiosPorEstado($estadoCodigo);

        // Convertir el resultado a un arreglo asociativo para ser devuelto como JSON
        $municipios = array();
        while ($row = mysqli_fetch_assoc($result_municipios)) {
            $municipios[] = $row;
        }

        // Convertir la matriz a un objeto
        $municipios_objeto = json_decode(json_encode($municipios));

        // Devolver la lista de municipios en formato JSON
        //echo json_encode($municipios_objeto);
        return json_encode($municipios_objeto);
    }

}
