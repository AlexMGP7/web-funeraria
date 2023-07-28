<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si se ha enviado el parámetro 'i' (rif) a través de GET, procedemos con el proceso de eliminación.
if (isset($_GET['i'])) {
    $rif = $_GET['i'];

    require_once('../../controllers/cementerio_controller.php');
    $controller = new CementerioController();

    // Intentar eliminar el cementerio utilizando el método 'DeleteCementerio1' del controlador.
    if ($controller->DeleteCementerio1($rif)) {
        // Si la eliminación fue exitosa, mostramos un mensaje de éxito.
        $_SESSION['mensaje'] = "El cementerio se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostramos un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el cementerio.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de cementerios después de intentar eliminar.
echo '<script>window.location.href = "?controller=Cementerio&action=ListarCementerio";</script>';
exit();
?>
