<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$codigo = $_GET['i'];

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();

try {
    $result_ciudad = $controller->DeleteCiudad1($codigo);
    $_SESSION['mensaje'] = "La ciudad se ha eliminado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

header("Location: ?controller=Ciudad&action=ListarCiudad");
exit();