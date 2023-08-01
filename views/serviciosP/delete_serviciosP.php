<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'codigo' en la URL.
if (isset($_GET['codigo'])) {
    // Obtener el código del servicio prestado a eliminar desde el parámetro 'codigo' en la URL.
    $codigo = $_GET['codigo'];
    require_once('../../controllers/serviciosP_controller.php');
    $controller = new ServiciosPController();

    // Intentar eliminar el servicio prestado utilizando el método 'DeleteServicioP1' del controlador.
    $result_eliminar = $controller->DeleteServicioP1($codigo);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El servicio prestado ha sido eliminado de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar el servicio prestado.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirige a la página de listado de servicios prestados después de intentar eliminar.
    echo '<script>window.location.href = "?controller=ServiciosP&action=ListarServiciosP";</script>';
    exit();
}

// Si no se proporciona el parámetro 'codigo' en la URL, redirige a la página de listado de servicios prestados sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=ServiciosP&action=ListarServiciosP";</script>';
exit();
?>