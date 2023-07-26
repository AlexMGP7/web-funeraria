<?php

class EstadoModel
{

    function __construct()
    {
    }

    // FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

    // Función para obtener datos de la base de datos a través de una consulta SQL.
    // Recibe un parámetro $sql, que es la consulta a ejecutar.
    public static function Get_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        if (!$result = mysqli_query($conexion, $sql)) {
            die('Error in query: ' . mysqli_error($conexion)); // Imprime el mensaje de error si la consulta falla.
        }
        $conexion = conectar::desconexion($conexion);
        return $result; // Devuelve el resultado de la consulta.
    }

    // Función para actualizar datos en la base de datos a través de una consulta SQL.
    // Recibe un parámetro $sql, que es la consulta de actualización a ejecutar.
    public static function Update_Data($sql)
    {
        include_once('../../core/conectar.php');
        $conexion = conectar::conexion();
        mysqli_autocommit($conexion, FALSE); // Desactiva la autocommit para realizar una transacción manual.
        $result = mysqli_query($conexion, $sql);

        if ($result == true) // Si la consulta fue exitosa
        {
            if (mysqli_affected_rows($conexion) == 0) // Si no se hizo la actualización
            {
                mysqli_rollback($conexion); // Deshace los cambios realizados en la transacción.
                $result = false;
            } else   // Si se hizo la actualización
            {
                mysqli_commit($conexion); // Confirma la transacción.
                $result = true;
            }
        }

        $conexion = conectar::desconexion($conexion);
        return $result; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // para el resto de las operaciones

    // Función para listar todos los estados de la tabla 'estado'.
    public static function ListarEstado()
    {
        $sql_estado = "SELECT codigo, descripcion FROM estado ORDER BY codigo ASC";
        $result_estado = EstadoModel::Get_Data($sql_estado);
        return $result_estado; // Devuelve el resultado de la consulta que contiene los estados.
    }

    // Para la insersión

    // Función para buscar el último código de estado utilizado en la tabla 'estado'.
    public static function BuscarUltimoEstado()
    {
        $sql_estado = "SELECT (max(codigo)) as identific FROM estado order BY codigo asc";
        $result_estado = EstadoModel::Get_Data($sql_estado);
        return $result_estado; // Devuelve el resultado de la consulta que contiene el último código de estado.
    }

    // Función para insertar un nuevo estado en la tabla 'estado'.
    public static function IngresarEstado2($codigo, $descripcion)
    {
        $sql_estado = "INSERT INTO estado (codigo, descripcion) VALUES ($codigo, '$descripcion')";
        $result_estado = EstadoModel::Update_Data($sql_estado);
        return $result_estado; // Devuelve el resultado de la operación de inserción (true o false).
    }

    // Para la actualización

    // Función para buscar un estado por su código.
    public static function BuscarEstadoByCodigo($codigo)
    {
        $sql_estado = "SELECT codigo, descripcion FROM estado WHERE codigo = $codigo";
        $result_estado = EstadoModel::Get_Data($sql_estado);
        return $result_estado; // Devuelve el resultado de la consulta que contiene el estado encontrado.
    }

    // Función para actualizar un estado existente en la tabla 'estado'.
    public static function UpdateEstado2($codigo, $descripcion)
    {
        $sql_estado = "UPDATE estado SET codigo = '$codigo', descripcion = '$descripcion' WHERE codigo = $codigo";
        $result_estado = EstadoModel::Update_Data($sql_estado);
        return $result_estado; // Devuelve el resultado de la operación de actualización (true o false).
    }

    // Para eliminar

    // Función para eliminar un estado de la tabla 'estado'.
    public static function DeleteEstado($codigo)
    {
        $sql_estado = "DELETE FROM estado WHERE codigo = $codigo";
        $result_estado = EstadoModel::Update_Data($sql_estado);
        return $result_estado; // Devuelve el resultado de la operación de eliminación (true o false).
    }

    // Función para verificar si hay registros relacionados con el estado en otras tablas.
    public static function CheckReferencedRecords($codigo)
    {
        // Verificar si hay municipios relacionados con el estado
        $sql_check_municipio = "SELECT COUNT(*) AS num_referenced_municipios FROM Municipio WHERE Estado_codigo = $codigo";
        $result_check_municipio = EstadoModel::Get_Data($sql_check_municipio);
        $row_municipio = mysqli_fetch_assoc($result_check_municipio);
        $num_referenced_municipios = $row_municipio['num_referenced_municipios'];

        // Verificar si hay parroquias relacionadas con el estado
        $sql_check_parroquia = "SELECT COUNT(*) AS num_referenced_parroquias FROM Parroquia WHERE Municipio_codigo IN (SELECT Codigo FROM Municipio WHERE Estado_codigo = $codigo)";
        $result_check_parroquia = EstadoModel::Get_Data($sql_check_parroquia);
        $row_parroquia = mysqli_fetch_assoc($result_check_parroquia);
        $num_referenced_parroquias = $row_parroquia['num_referenced_parroquias'];

        // Verificar si hay ciudades relacionadas con el estado
        $sql_check_ciudad = "SELECT COUNT(*) AS num_referenced_ciudades FROM Ciudad WHERE Parroquia_codigo IN (SELECT Codigo FROM Parroquia WHERE Municipio_codigo IN (SELECT Codigo FROM Municipio WHERE Estado_codigo = $codigo))";
        $result_check_ciudad = EstadoModel::Get_Data($sql_check_ciudad);
        $row_ciudad = mysqli_fetch_assoc($result_check_ciudad);
        $num_referenced_ciudades = $row_ciudad['num_referenced_ciudades'];

        // Si hay algún municipio, parroquia o ciudad relacionada, entonces no se puede eliminar el estado.
        // Devuelve true si hay registros relacionados, y false si no los hay.
        if ($num_referenced_municipios > 0 || $num_referenced_parroquias > 0 || $num_referenced_ciudades > 0) {
            return true;
        }

        return false;
    }
}
