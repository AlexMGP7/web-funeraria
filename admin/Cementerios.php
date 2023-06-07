<?php
// Incluir el archivo de conexión a la base de datos
include('../conectar.php');

// Función para mostrar los cementerios existentes
// ...

// Función para mostrar los cementerios existentes
function mostrarCementerios()
{
    global $conn;
    $query = "SELECT * FROM cementerios";
    $result = mysqli_query($conn, $query);

    echo "<h2>Listado de Cementerios</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Código</th><th>Nombre</th><th>Ubicación</th><th>Tipo</th><th>Acciones</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['codigo']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['ubicacion']."</td>";
        echo "<td>".$row['tipo']."</td>";
        echo "<td><a href='cementerios.php?action=editar&id=".$row['id']."'>Editar</a> |
                <a href='cementerios.php?action=eliminar&id=".$row['id']."'>Eliminar</a></td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Función para mostrar el formulario de creación o edición de un cementerio
function mostrarFormulario($id = null)
{
    global $conn;
    $codigo = '';
    $nombre = '';
    $ubicacion = '';
    $tipo = '';

    // Verificar si se ha proporcionado un ID para la edición
    if ($id) {
        $query = "SELECT * FROM cementerios WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Asignar los valores de la base de datos a las variables
        $codigo = $row['codigo'];
        $nombre = $row['nombre'];
        $ubicacion = $row['ubicacion'];
        $tipo = $row['tipo'];
    }

    echo "<h2>".($id ? "Editar" : "Crear")." Cementerio</h2>";
    echo "<form action='cementerios.php".($id ? "?action=actualizar&id=$id" : "?action=guardar")."' method='post'>";

    echo "<label>Código:</label>";
    echo "<input type='text' name='codigo' value='$codigo' required>";

    echo "<label>Nombre:</label>";
    echo "<input type='text' name='nombre' value='$nombre' required>";

    echo "<label>Ubicación:</label>";
    echo "<input type='text' name='ubicacion' value='$ubicacion' required>";

    echo "<label>Tipo:</label>";
    echo "<input type='text' name='tipo' value='$tipo' required>";

    echo "<input type='submit' value='".($id ? "Actualizar" : "Guardar")."'>";
    echo "</form>";
}

// Verificar si se ha proporcionado una acción
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Crear un nuevo cementerio
    if ($action == 'guardar' && isset($_POST['codigo'], $_POST['nombre'], $_POST['ubicacion'], $_POST['tipo'])) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $ubicacion = $_POST['ubicacion'];
        $tipo = $_POST['tipo'];

        $query = "INSERT INTO cementerios (codigo, nombre, ubicacion, tipo) VALUES ('$codigo', '$nombre', '$ubicacion', '$tipo')";
        mysqli_query($conn, $query);

        // Redirigir a la página de listado de cementerios
        header('Location: cementerios.php');
        exit;
    }

    // Actualizar un cementerio existente
    if ($action == 'actualizar' && isset($_GET['id'], $_POST['codigo'], $_POST['nombre'], $_POST['ubicacion'], $_POST['tipo'])) {
        $id = $_GET['id'];
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $ubicacion = $_POST['ubicacion'];
        $tipo = $_POST['tipo'];

        $query = "UPDATE cementerios SET codigo = '$codigo', nombre = '$nombre', ubicacion = '$ubicacion', tipo = '$tipo' WHERE id = $id";
        mysqli_query($conn, $query);

        // Redirigir a la página de listado de cementerios
        header('Location: cementerios.php');
        exit;
    }

    // Eliminar un cementerio
    if ($action == 'eliminar' && isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM cementerios WHERE id = $id";
        mysqli_query($conn, $query);

        // Redirigir a la página de listado de cementerios
        header('Location: cementerios.php');
        exit;
    }

    // Editar un cementerio existente
    if ($action == 'editar' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Mostrar el formulario de edición
        mostrarFormulario($id);
        exit;
    }
}

// Mostrar el listado de cementerios
mostrarCementerios();

// Mostrar el formulario de creación o edición
mostrarFormulario();

?>
