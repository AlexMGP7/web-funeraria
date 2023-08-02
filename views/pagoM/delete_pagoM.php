<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si se ha enviado el parámetro 'numero' de pago mensual a través de GET, procedemos con el proceso de eliminación.
if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];

    require_once('../../controllers/pagoM_controller.php');
    $controller = new PagoMController();

    // Intentar eliminar el pago mensual utilizando el método 'DeletePagoM1' del controlador.
    if ($controller->DeletePagoM1($numero)) {
        // Si la eliminación fue exitosa, mostramos un mensaje de éxito.
        $_SESSION['mensaje'] = "El pago mensual se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostramos un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el pago mensual.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de pagos mensuales después de intentar eliminar.
echo '<script>window.location.href = "?controller=PagoM&action=ListarPagoM";</script>';
exit();
?>
