<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

$codigo = $_GET['i'];

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();

try {
    $controller->DeleteCiudad1($codigo);
    $_SESSION['mensaje'] = "La ciudad se ha eliminado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

echo '<script>window.location.href = "?controller=Ciudad&action=ListarCiudad";</script>';
exit();
