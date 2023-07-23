<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$estado_codigo = $_POST['estado_codigo'];

require_once('../../controllers/municipio_controller.php');
$controller = new MunicipioController();

try {
    $result_municipio = $controller->UpdateMunicipio2($codigo, $descripcion, $estado_codigo);
    $_SESSION['mensaje'] = "El municipio se ha modificado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

header("Location: ?controller=Municipio&action=ListarMunicipio");
exit();
