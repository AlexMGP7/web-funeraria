<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si se ha enviado el parámetro 'cedula' a través de GET, procedemos con el proceso de eliminación.
if (isset($_GET['i'])) {
    $cedula = $_GET['i'];

    require_once('../../controllers/difunto_controller.php');
    $controller = new DifuntoController();

    // Intentar eliminar el difunto utilizando el método 'DeleteDifunto' del controlador.
    if ($controller->DeleteDifunto1($cedula)) {
        // Si la eliminación fue exitosa, mostramos un mensaje de éxito.
        $_SESSION['mensaje'] = "El difunto se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostramos un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el difunto.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de difuntos después de intentar eliminar.
echo '<script>window.location.href = "?controller=Difunto&action=ListarDifunto";</script>';
exit();