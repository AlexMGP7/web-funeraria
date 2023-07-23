<?php

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];

    require_once('../../controllers/municipio_controller.php');
    $controller = new MunicipioController();

    try {
        $result_municipio = $controller->DeleteMunicipio1($codigo);
        $_SESSION['mensaje'] = "El municipio se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

echo '<script>window.location.href = "?controller=Municipio&action=ListarMunicipio";</script>';
exit();
