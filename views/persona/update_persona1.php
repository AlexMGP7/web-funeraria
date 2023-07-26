<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$ciudad_codigo = $_POST['ciudad_codigo'];

require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();

try {
    $result_persona = $controller->UpdatePersona2($cedula, $nombre, $apellido, $ciudad_codigo);

    // Check if the update was successful
    if ($result_persona) {
        $_SESSION['mensaje'] = "La persona se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la persona. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

echo '<script>window.location.href = "?controller=Persona&action=ListarPersona";</script>';
exit();
