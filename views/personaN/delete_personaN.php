<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si se ha enviado el parámetro 'cedula' a través de GET, procedemos con el proceso de eliminación.
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    require_once('../../controllers/personaNatural_controller.php');
    $controller = new PersonaNaturalController();

    // Intentar eliminar la persona natural utilizando el método 'DeletePersonaN1' del controlador.
    if ($controller->DeletePersonaN1($cedula)) {
        // Si la eliminación fue exitosa, mostramos un mensaje de éxito.
        $_SESSION['mensaje'] = "La persona natural se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostramos un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la persona natural.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de personas naturales después de intentar eliminar.
echo '<script>window.location.href = "?controller=PersonaNatural&action=ListarPersonaN";</script>';
exit();
?>
