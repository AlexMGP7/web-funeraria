<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/parroquia_controller.php');
    $controller = new ParroquiaController();

    try {
        $controller->DeleteParroquia1($codigo);
        $_SESSION['mensaje'] = "La parroquia se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

echo '<script>window.location.href = "?controller=Parroquia&action=ListarParroquia";</script>';
exit();
