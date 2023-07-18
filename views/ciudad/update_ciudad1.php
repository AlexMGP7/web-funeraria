<?php
session_start();

$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$parroquia_codigo = $_POST['parroquia_codigo'];

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();

try {
    $result_ciudad = $controller->UpdateCiudad2($codigo, $descripcion, $parroquia_codigo);
    $_SESSION['mensaje'] = "La ciudad se ha actualizado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

header("Location: ../../views/layouts/layout.php");
exit();
?>
