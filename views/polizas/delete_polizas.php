<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'numero' en la URL.
if (isset($_GET['numero'])) {
    // Obtener el número de la póliza a eliminar desde el parámetro 'numero' en la URL.
    $numero = $_GET['numero'];
    require_once('../../controllers/polizas_controller.php');
    $controller = new PolizasController();

    // Intentar eliminar la póliza utilizando el método 'DeletePoliza1' del controlador.
    $result_eliminar = $controller->DeletePoliza1($numero);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La póliza ha sido eliminada de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la póliza.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirige a la página de listado de pólizas después de intentar eliminar.
    echo '<script>window.location.href = "?controller=Polizas&action=ListarPolizas";</script>';
    exit();
}

// Si no se proporciona el parámetro 'numero' en la URL, redirige a la página de listado de pólizas sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=Polizas&action=ListarPolizas";</script>';
exit();
?>