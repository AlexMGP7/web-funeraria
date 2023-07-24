<?php

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$ciudadCodigo = $_POST['ciudad_codigo'];

require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();

try {
    $result_persona = $controller->IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo);
    $_SESSION['mensaje'] = "La persona se ha registrado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

// echo '<script>window.location.href = "?controller=Persona&action=ListarPersona";</script>';
// exit();
