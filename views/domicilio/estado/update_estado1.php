<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Obtener el código y la descripción actualizados del estado enviados a través del formulario de actualización.
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];

require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();

try {
    // Intentar actualizar el estado utilizando el método 'UpdateEstado2' del controlador.
    $result_estado = $controller->UpdateEstado2($codigo, $descripcion);

    // Si la actualización fue exitosa, mostrar un mensaje de éxito.
    $_SESSION['mensaje'] = "El estado ha sido modificado en la base de datos de forma satisfactoria.";
    $_SESSION['mensaje_tipo'] = "success";
} catch (Exception $e) {
    // Si se produce una excepción durante la actualización, mostrar un mensaje de advertencia con el mensaje de error.
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['mensaje_tipo'] = "warning";
}

// Redirigir a la página de listado de estados después de intentar actualizar.
echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
exit();
