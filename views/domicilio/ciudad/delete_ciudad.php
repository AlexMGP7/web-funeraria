<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se ha proporcionado un parámetro 'i' en la URL.
if (isset($_GET['i'])) {
    $codigo = $_GET['i'];

    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();

    // Intentar eliminar la ciudad utilizando el método 'DeleteCiudad1' del controlador.
    $result = $controller->DeleteCiudad1($codigo);

    if ($result) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La ciudad se ha eliminado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la ciudad.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

// Redirigir a la página de listado de ciudades después de intentar eliminar.
echo '<script>window.location.href = "?controller=Ciudad&action=ListarCiudad";</script>';
exit();
?>
