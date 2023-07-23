<?php
//No funciona con conectar.php, no borrar ni juzgar
// Configura la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "polizas_funerarias";
// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprueba si hay errores en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtén los datos según el tipo solicitado (municipio, parroquia o ciudad)
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    switch ($type) {
        case 'municipios':
            $query = "SELECT codigo, descripcion FROM municipio WHERE estado_codigo = $id";
            break;
        case 'parroquias':
            $query = "SELECT codigo, descripcion FROM parroquia WHERE municipio_codigo = $id";
            break;
        // case 'ciudades':
        //     $query = "SELECT codigo, descripcion FROM ciudad WHERE parroquia_codigo = $id";
        //     break;
        default:
            $query = "";
            break;
    }

    $result = $conn->query($query);

    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
}

// Cierra la conexión a la base de datos
$conn->close();
