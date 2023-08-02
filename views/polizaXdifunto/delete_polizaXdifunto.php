<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'difunto_cedula' y 'poliza_numero' en la URL.
if (isset($_GET['difunto_cedula']) && isset($_GET['poliza_numero'])) {
    // Obtener los valores de las claves primarias desde los parámetros en la URL.
    $difunto_cedula = $_GET['difunto_cedula'];
    $poliza_numero = $_GET['poliza_numero'];

    // Incluir el controlador 'PolizaXdifuntoController' para manejar las operaciones con la relación.
    require_once('../../controllers/polizaXdifunto_controller.php');
    $controller = new PolizaXdifuntoController();

    // Intentar eliminar la relación utilizando el método 'DeletePolizaXdifunto1' del controlador.
    $result_eliminar = $controller->DeletePolizaXdifunto1($difunto_cedula, $poliza_numero);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La relación ha sido eliminada de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la relación.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de PolizaXdifunto después de intentar eliminar.
    echo '<script>window.location.href = "?controller=PolizaXdifunto&action=ListarPolizaXdifunto";</script>';
    exit();
}

// Si no se proporcionan los parámetros necesarios en la URL, redirigir a la página de listado de PolizaXdifunto sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=PolizaXdifunto&action=ListarPolizaXdifunto";</script>';
exit();