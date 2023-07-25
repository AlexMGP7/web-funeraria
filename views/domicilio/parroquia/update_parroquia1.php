<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$municipio_codigo = $_POST['municipio_codigo'];

require_once('../../controllers/parroquia_controller.php');
$controller = new ParroquiaController();

try {
    $result_parroquia = $controller->UpdateParroquia2($codigo, $descripcion, $municipio_codigo);
    $_SESSION['mensaje'] = "La parroquia se ha actualizado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

echo '<script>window.location.href = "?controller=Parroquia&action=ListarParroquia";</script>';
exit();
