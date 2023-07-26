<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si se ha enviado el parámetro 'i' (cedula) a través de GET, procedemos con el proceso de eliminación.
if (isset($_GET['i'])) {
    $cedula = $_GET['i'];

    require_once('../../controllers/persona_controller.php');
    $controller = new PersonaController();

    // Intentar eliminar la persona utilizando el método 'DeletePersona1' del controlador.
    if ($controller->DeletePersona1($cedula)) {
        // Si la eliminación fue exitosa, mostramos un mensaje de éxito.
        $_SESSION['mensaje'] = "La persona se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostramos un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la persona.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de personas después de intentar eliminar.
echo '<script>window.location.href = "?controller=Persona&action=ListarPersona";</script>';
exit();
?>
