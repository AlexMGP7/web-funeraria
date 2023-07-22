<?php
class MunicipioModel
{
    function __construct()
    {
    }

    // FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

    public static function ListarMunicipiosByEstado($estado_codigo)
    {
        // Modify the SQL query to filter by estado_codigo
        $sql_municipios = "SELECT * FROM municipio WHERE Estado_Codigo = $estado_codigo";
        $result_municipios = MunicipioModel::Get_Data($sql_municipios);
        return $result_municipios;
    }

    public static function Get_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        if (!$result = mysqli_query($conexion, $sql))
            die();
        $conexion = conectar::desconexion($conexion);
        return $result;
    }

    public static function Update_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        mysqli_autocommit($conexion, FALSE);
        $result = mysqli_query($conexion, $sql);

        if ($result == true) // la consulta fue exitosa
        {
            if (mysqli_affected_rows($conexion) == 0) // si no hizo la actualizacion
            {
                mysqli_rollback($conexion);
                $result = false;
            } else // si hizo la actualizacion
            {
                mysqli_commit($conexion);
                $result = true;
            }
        }

        $conexion = conectar::desconexion($conexion);

        return $result;
    }


    // para el resto de las operaciones


    public static function ListarMunicipio()
    {
        $sql_municipio = "SELECT m.codigo, m.descripcion, e.descripcion AS estado_descripcion 
                          FROM municipio AS m 
                          INNER JOIN estado AS e ON m.Estado_Codigo = e.codigo 
                          ORDER BY m.codigo ASC";
        $result_municipio = MunicipioModel::Get_Data($sql_municipio);
        return $result_municipio;
    }

    // Para la insersión

    public static function BuscarUltimoMunicipio()
    {
        $sql_municipio = "SELECT (max(codigo)) as identific FROM municipio";
        $result_municipio = MunicipioModel::Get_Data($sql_municipio);
        return $result_municipio;
    }

    public static function IngresarMunicipio2($codigo, $descripcion, $estado_codigo)
    {
        try {
            require_once('../../core/conectar.php');
            $conexion = conectar::conexion();
            $sql_municipio = "INSERT INTO municipio (codigo, descripcion, Estado_Codigo) VALUES ($codigo, '$descripcion', $estado_codigo)";
            $result_municipio = mysqli_query($conexion, $sql_municipio);

            if (!$result_municipio) {
                // Capturar el error de llave duplicada
                if (mysqli_errno($conexion) === 1062) {
                    throw new Exception("Error: El municipio con el código $codigo ya existe.");
                } else {
                    throw new Exception(mysqli_error($conexion));
                }
            }

            $conexion = conectar::desconexion($conexion);

            return true;
        } catch (Exception $e) {
            throw new Exception("Error al agregar el municipio: " . $e->getMessage());
        }
    }

    // Para la actualización

    public static function BuscarMunicipioByCodigo($codigo)
    {
        $sql_municipio = "SELECT m.codigo, m.descripcion AS municipio_descripcion,
                             e.codigo AS estado_codigo, e.descripcion AS estado_descripcion
                      FROM municipio AS m
                      INNER JOIN estado AS e ON m.Estado_codigo = e.Codigo
                      WHERE m.codigo = $codigo";

        $result_municipio = MunicipioModel::Get_Data($sql_municipio);
        return $result_municipio;
    }

    public static function ObtenerMunicipiosPorEstado($estadoCodigo)
    {
        try {
            include_once('../../core/conectar.php');
            $conexion = conectar::conexion();

            // Aquí debes escribir la lógica para obtener los municipios correspondientes al estado seleccionado
            // Puedes utilizar consultas SQL u otros métodos de acceso a datos según tu configuración y preferencias

            // Por ejemplo, supongamos que tienes una tabla "municipios" con una columna "estado_codigo"
            // Puedes realizar una consulta SQL para seleccionar los municipios que coincidan con el código de estado
            $sql = "SELECT codigo, descripcion FROM municipios WHERE estado_codigo = $estadoCodigo";

            // Ejecutar la consulta y obtener los resultados
            $result = mysqli_query($conexion, $sql);

            // Verificar si se obtuvieron resultados
            if (!$result) {
                throw new Exception(mysqli_error($conexion));
            }

            // Crear un array para almacenar los municipios
            $municipios = array();

            // Recorrer los resultados y agregar cada municipio al array
            while ($row = mysqli_fetch_assoc($result)) {
                $municipios[] = $row;
            }

            // Retornar el array de municipios
            return $municipios;
        } catch (Exception $e) {
            // Capturar cualquier excepción ocurrida durante el procesamiento
            throw new Exception("Error en el modelo: " . $e->getMessage());
        } finally {
            // Cerrar la conexión a la base de datos
            if (isset($conexion)) {
                conectar::desconexion($conexion);
            }
        }
    }


    public static function UpdateMunicipio2($codigo, $descripcion, $estado_codigo)
    {
        $sql_municipio = "UPDATE municipio SET codigo = '$codigo', descripcion = '$descripcion', Estado_Codigo = $estado_codigo WHERE codigo = $codigo";
        $result_municipio = MunicipioModel::Update_Data($sql_municipio);
        return $result_municipio;
    }

    // Para eliminar

    public static function DeleteMunicipio($codigo)
    {
        $sql_municipio = "DELETE FROM municipio WHERE codigo = $codigo";
        $result_municipio = MunicipioModel::Update_Data($sql_municipio);
        return $result_municipio;
    }

    public static function CheckReferencedRecords($codigo)
    {
        // Verificar si hay parroquias relacionadas con el municipio
        $sql_check_parroquia = "SELECT COUNT(*) AS num_referenced_parroquias FROM Parroquia WHERE Municipio_codigo = $codigo";
        $result_check_parroquia = MunicipioModel::Get_Data($sql_check_parroquia);
        $row_parroquia = mysqli_fetch_assoc($result_check_parroquia);
        $num_referenced_parroquias = $row_parroquia['num_referenced_parroquias'];

        // Verificar si hay ciudades relacionadas con el municipio
        $sql_check_ciudad = "SELECT COUNT(*) AS num_referenced_ciudades FROM Ciudad WHERE Parroquia_codigo IN (SELECT Codigo FROM Parroquia WHERE Municipio_codigo = $codigo)";
        $result_check_ciudad = MunicipioModel::Get_Data($sql_check_ciudad);
        $row_ciudad = mysqli_fetch_assoc($result_check_ciudad);
        $num_referenced_ciudades = $row_ciudad['num_referenced_ciudades'];

        // Si hay alguna parroquia o ciudad relacionada, entonces no se puede eliminar el municipio
        if ($num_referenced_parroquias > 0 || $num_referenced_ciudades > 0) {
            return true;
        }

        return false;
    }

    function ListarMunicipiosDinamicos($estado_codigo)
{
    try {
        // Modificar la consulta para filtrar por estado_codigo
        $sql = "SELECT codigo, descripcion FROM municipio WHERE Estado_Codigo = $estado_codigo";
        $result = MunicipioModel::Get_Data($sql);

        $arreglo = array();
        while ($consulta_VU = mysqli_fetch_array($result)) {
            $arreglo[] = $consulta_VU;
        }

        return $arreglo;
    } catch (Exception $e) {
        // Capturar cualquier excepción ocurrida durante el procesamiento
        throw new Exception("Error en el modelo al listar municipios dinámicos: " . $e->getMessage());
    }
}


}
