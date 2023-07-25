<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

$codigo = $_POST['codigo_ciudad'];
$descripcion = $_POST['descripcion'];
$parroquia_codigo = $_POST['parroquia_codigo'];

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();

try {
    $result_ciudad = $controller->IngresarCiudad2($codigo, $descripcion, $parroquia_codigo);
    $_SESSION['mensaje'] = "La ciudad se ha registrado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

echo '<script>window.location.href = "?controller=Ciudad&action=ListarCiudad";</script>';
exit();
