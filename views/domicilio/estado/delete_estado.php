<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'i' en la URL.
if (isset($_GET['i'])) {
    // Obtener el código del estado a eliminar desde el parámetro 'i' en la URL.
    $codigo = $_GET['i'];
    require_once('../../controllers/estado_controller.php');
    $controller = new EstadoController();

    // Intentar eliminar el estado utilizando el método 'DeleteEstado1' del controlador.
    $result_eliminar = $controller->DeleteEstado1($codigo);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El estado ha sido eliminado de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el estado.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirige a la página de listado de estados después de intentar eliminar.
    echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
    exit();
}

// Si no se proporciona el parámetro 'i' en la URL, redirige a la página de listado de estados sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
exit();
