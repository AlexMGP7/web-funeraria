<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

$codigo = $_POST['codigo_estado'];
$descripcion = $_POST['descripcion'];

require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();

try {
    $result_estado = $controller->IngresarEstado2($codigo, $descripcion);
    $_SESSION['mensaje'] = "El estado se ha registrado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
exit();
