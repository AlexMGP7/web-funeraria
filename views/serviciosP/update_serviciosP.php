<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

require_once('../../controllers/serviciosP_controller.php');
$controller = new ServiciosPController();

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos actualizados del formulario.
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $monto = $_POST['monto'];

    // Intentar actualizar el servicio prestado utilizando el método 'UpdateServicioP2' del controlador.
    $result_servicioP = $controller->UpdateServicioP2($codigo, $nombre, $tipo, $monto);

    if ($result_servicioP) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El servicio prestado ha sido modificado en la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar el servicio prestado.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de servicios prestados después de intentar actualizar.
    echo '<script>window.location.href = "?controller=ServiciosP&action=ListarServiciosP";</script>';
    exit();
}

// Verificar si se ha proporcionado un parámetro 'codigo' en la URL.
if (isset($_GET['codigo'])) {
    // Obtener el código del servicio prestado a actualizar desde el parámetro 'codigo' en la URL.
    $codigo = $_GET['codigo'];

    // Obtener los datos del servicio prestado a actualizar utilizando el método 'BuscarServicioPByCodigo' del controlador.
    $result_servicioP = $controller->BuscarServicioPByCodigo($codigo);
    $numrows = mysqli_num_rows($result_servicioP);

    if ($numrows != 0) {
        // Si se encontró el servicio prestado en la base de datos, obtener los datos y mostrar el formulario de actualización.
        while ($row = mysqli_fetch_array($result_servicioP)) {
            if (isset($row["codigo"])) {
                $codigo_bd = $row["codigo"];
            }

            if (isset($row["nombre"])) {
                $nombre = $row["nombre"];
            }

            if (isset($row["tipo"])) {
                $tipo = $row["tipo"];
            }

            if (isset($row["monto"])) {
                $monto = $row["monto"];
            }
        }
?>
        <div class="container-i mt-5">
            <form action="?controller=ServiciosP&action=UpdateServiciosP" method="POST">
                <div class="custom-form-background p-4">
                    <h4 class="mb-4">Actualización de Servicios Prestados</h4>
                    <div class="form-group">
                        <label for="codigo"><b>Código del Servicio Prestado: <?php echo $codigo ?></b></label>
                        <!-- Mostrar el código del servicio prestado en un campo de solo lectura -->
                        <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre"><b>Nombre:</b></label>
                        <!-- Mostrar el nombre actual del servicio prestado en un campo de texto para ser modificado -->
                        <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tipo"><b>Tipo:</b></label>
                        <!-- Mostrar el tipo actual del servicio prestado en un campo de texto para ser modificado -->
                        <input class="form-control" type="text" name="tipo" value="<?php echo $tipo; ?>">
                    </div>
                    <div class="form-group">
                        <label for="monto"><b>Monto:</b></label>
                        <!-- Mostrar el monto actual del servicio prestado en un campo de texto para ser modificado -->
                        <input class="form-control" type="number" name="monto" value="<?php echo $monto; ?>">
                    </div>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
<?php
    } else {
        // Si no se encuentra el servicio prestado en la base de datos, redirigir a la página de listado de servicios prestados.
        require_once('../../views/serviciosP/list_serviciosP.php');
    }
} else {
    // Si no se proporciona el parámetro 'codigo' en la URL, redirigir a la página de listado de servicios prestados.
    require_once('../../views/serviciosP/list_serviciosP.php');
}
?>
  