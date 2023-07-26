<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];

    require_once('../../controllers/municipio_controller.php');
    $controller = new MunicipioController();

    // Intentar eliminar el municipio utilizando el método 'DeleteMunicipio1' del controlador.
    $result_eliminar = $controller->DeleteMunicipio1($codigo);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El municipio se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el municipio.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

echo '<script>window.location.href = "?controller=Municipio&action=ListarMunicipio";</script>';
exit();
