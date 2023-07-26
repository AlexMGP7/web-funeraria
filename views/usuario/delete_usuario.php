<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se ha enviado el parámetro 'cedula' a través de GET
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    require_once('../../controllers/usuario_controller.php');
    $controller = new UsuarioController();

    // Intentar eliminar el usuario utilizando el método 'DeleteUsuario1' del controlador.
    if ($controller->DeleteUsuario1($cedula)) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El usuario se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el usuario.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de usuarios después de intentar eliminar.
echo '<script>window.location.href = "?controller=Usuario&action=ListarUsuario";</script>';
exit();

?>
