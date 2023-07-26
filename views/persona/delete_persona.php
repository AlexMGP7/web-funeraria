<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

if (isset($_GET['i'])) {
    $cedula = $_GET['i'];

    require_once('../../controllers/persona_controller.php');
    $controller = new PersonaController();

    try {
        if ($controller->DeletePersona1($cedula)) {
            $_SESSION['mensaje'] = "La persona se ha eliminado correctamente.";
            $_SESSION['mensaje_tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error: No se pudo eliminar la persona.";
            $_SESSION['mensaje_tipo'] = "warning";
        }
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

echo '<script>window.location.href = "?controller=Persona&action=ListarPersona";</script>';
exit();
