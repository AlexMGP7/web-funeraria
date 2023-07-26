<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Obtener el código y la descripción del estado enviados a través del formulario.
$codigo = $_POST['codigo_estado'];
$descripcion = $_POST['descripcion'];

require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();

try {
    // Intentar insertar el nuevo estado utilizando el método 'IngresarEstado2' del controlador.
    $result_estado = $controller->IngresarEstado2($codigo, $descripcion);

    // Si la inserción fue exitosa, mostrar un mensaje de éxito.
    $_SESSION['mensaje'] = "El estado se ha registrado correctamente.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    // Si se produce una excepción durante la inserción, mostrar un mensaje de advertencia con el mensaje de error.
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

// Redirigir a la página de listado de estados después de intentar insertar.
echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
exit();
