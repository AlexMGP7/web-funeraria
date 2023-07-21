<?php
session_start();

$codigo = $_POST['codigo_parroquia'];
$descripcion = $_POST['descripcion'];
$municipio_codigo = $_POST['municipio_codigo'];

require_once('../../controllers/parroquia_controller.php');
$controller = new ParroquiaController();

try {
    $result_parroquia = $controller->IngresarParroquia2($codigo, $descripcion, $municipio_codigo);
    $_SESSION['mensaje'] = "La parroquia se ha registrado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

header("Location: ../../views/layouts/layout.php");
exit();
