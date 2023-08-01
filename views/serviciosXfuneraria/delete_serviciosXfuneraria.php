<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'Funeraria_Rif' y 'Servicios_Prestados_Codigo' en la URL.
if (isset($_GET['funeraria_rif']) && isset($_GET['servicios_prestados_codigo'])) {
    // Obtener los valores de las claves primarias desde los parámetros en la URL.
    $funeraria_rif = $_GET['funeraria_rif'];
    $servicios_prestados_codigo = $_GET['servicios_prestados_codigo'];

    // Incluir el controlador 'ServiciosXFunerariaController' para manejar las operaciones con la relación.
    require_once('../../controllers/serviciosXfuneraria_controller.php');
    $controller = new ServiciosXFunerariaController();

    // Intentar eliminar la relación utilizando el método 'EliminarServicioXFuneraria' del controlador.
    $result_eliminar = $controller->DeleteServicioXFuneraria1($funeraria_rif, $servicios_prestados_codigo);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La relación ha sido eliminada de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la relación.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de servicios prestados después de intentar eliminar.
    echo '<script>window.location.href = "?controller=ServiciosXfuneraria&action=ListarServiciosXfuneraria";</script>';
    exit();
}

// Si no se proporcionan los parámetros necesarios en la URL, redirigir a la página de listado de servicios prestados sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=ServiciosXfuneraria&action=ListarServiciosXfuneraria";</script>';
exit();
