<?php

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

    require_once('../../controllers/estado_controller.php');
    $controller = new EstadoController();

    try {
        $result_estado = $controller->UpdateEstado2($codigo, $descripcion);
        $_SESSION['mensaje'] = "El estado ha sido modificado en la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['mensaje_tipo'] = "warning";
    }

    header("Location: ../../views/layouts/layout.php");
    exit();
}

?>
