<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código y la descripción actualizados del estado enviados a través del formulario de actualización.
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

    // Intentar actualizar el estado utilizando el método 'UpdateEstado2' del controlador.
    $result_estado = $controller->UpdateEstado2($codigo, $descripcion);

    if ($result_estado) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El estado ha sido modificado en la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar el estado.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de estados después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
    exit();
}

// Verificar si se ha proporcionado un parámetro 'i' en la URL.
if (isset($_GET['i'])) {
    // Obtener el código del estado a actualizar desde el parámetro 'i' en la URL.
    $codigo = $_GET['i'];

    // Obtener los datos del estado a actualizar utilizando el método 'BuscarEstadoByCodigo' del controlador.
    $result_estado = $controller->BuscarEstadoByCodigo($codigo);
    $numrows = mysqli_num_rows($result_estado);

    if ($numrows != 0) {
        // Si se encontró el estado en la base de datos, obtener los datos y mostrar el formulario de actualización.
        while ($row = mysqli_fetch_array($result_estado)) {
            if (isset($row["codigo"])) {
                $codigo_bd = $row["codigo"];
            }

            if (isset($row["descripcion"])) {
                $descripcion = $row["descripcion"];
            }
        }
?>
        <div class="container-i mt-5">
            <form action="?controller=Estado&action=UpdateEstado" method="POST">
                <div class="custom-form-background p-4">
                    <h4 class="mb-4">Actualización de Estados</h4>
                    <div class="form-group">
                        <label for="codigo"><b>Codigo del Estado:</b></label>
                        <!-- Mostrar el código del estado en un campo de solo lectura -->
                        <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="descripcion"><b>Nueva Descripción:</b></label>
                        <!-- Mostrar la descripción actual del estado en un campo de texto para ser modificada -->
                        <textarea class="form-control" name="descripcion" required placeholder="<?php echo $descripcion; ?>"></textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
<?php
    } else {
        // Si no se encuentra el estado en la base de datos, redirigir a la página de listado de estados.
        require_once('../../views/domicilio/estado/list_estado.php');
    }
} else {
    // Si no se proporciona el parámetro 'i' en la URL, redirigir a la página de listado de estados.
    require_once('../../views/domicilio/estado/list_estado.php');
}
?>