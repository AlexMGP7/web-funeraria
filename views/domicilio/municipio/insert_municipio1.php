<?php

$codigo = $_POST['codigo_municipio'];
$descripcion = $_POST['descripcion'];
$estado_codigo = $_POST['estado_codigo'];

require_once('../../controllers/municipio_controller.php');
$controller = new MunicipioController();

try {
    $result_municipio = $controller->IngresarMunicipio2($codigo, $descripcion, $estado_codigo);
    $_SESSION['mensaje'] = "El municipio se ha registrado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

echo '<script>window.location.href = "?controller=Municipio&action=ListarMunicipio";</script>';
exit();

