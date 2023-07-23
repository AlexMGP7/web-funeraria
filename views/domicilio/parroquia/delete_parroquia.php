<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/parroquia_controller.php');
    $controller = new ParroquiaController();

    try {
        $result_parroquia = $controller->DeleteParroquia1($codigo);
        $_SESSION['mensaje'] = "La parroquia se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

echo '<script>window.location.href = "?controller=Parroquia&action=ListarParroquia";</script>';
exit();
