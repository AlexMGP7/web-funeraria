<?php

session_start();

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/estado_controller.php');
    $controller = new EstadoController();

    try {
        $result_estado = $controller->DeleteEstado1($codigo);
        $_SESSION['mensaje'] = "El estado ha sido eliminado de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['mensaje_tipo'] = "warning";
    }

    header("Location: ../../views/layouts/layout.php");
    exit();
} else {
    header("Location: ../../views/estado/list_estado.php");
    exit();
}
