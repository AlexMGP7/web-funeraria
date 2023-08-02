<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si se ha enviado el parámetro 'numero' de factura a través de GET, procedemos con el proceso de eliminación.
if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];

    require_once('../../controllers/facturaA_controller.php');
    $controller = new FacturaAController();

    // Intentar eliminar la factura utilizando el método 'DeleteFacturaA1' del controlador.
    if ($controller->DeleteFacturaA1($numero)) {
        // Si la eliminación fue exitosa, mostramos un mensaje de éxito.
        $_SESSION['mensaje'] = "La factura se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostramos un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la factura.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de facturas después de intentar eliminar.
echo '<script>window.location.href = "?controller=FacturaA&action=ListarFacturaA";</script>';
exit();
?>
