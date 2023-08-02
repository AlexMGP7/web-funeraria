<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'persona_natural_cedula' y 'poliza_numero' en la URL.
if (isset($_GET['persona_natural_cedula']) && isset($_GET['poliza_numero'])) {
    // Obtener los valores de las claves primarias desde los parámetros en la URL.
    $persona_natural_cedula = $_GET['persona_natural_cedula'];
    $poliza_numero = $_GET['poliza_numero'];

    // Incluir el controlador 'PolizaXpersonaNController' para manejar las operaciones con la relación.
    require_once('../../controllers/polizaXpersonaN_controller.php');
    $controller = new PolizaXpersonaNController();

    // Intentar eliminar la relación utilizando el método 'DeletePolizaXpersonaN1' del controlador.
    $result_eliminar = $controller->DeletePolizaXpersonaN1($persona_natural_cedula, $poliza_numero);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La relación ha sido eliminada de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la relación.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de PolizaXpersonaN después de intentar eliminar.
    echo '<script>window.location.href = "?controller=PolizaXpersonaN&action=ListarPolizaXpersonaN";</script>';
    exit();
}

// Si no se proporcionan los parámetros necesarios en la URL, redirigir a la página de listado de PolizaXpersonaN sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=PolizaXpersonaN&action=ListarPolizasXpersonaN";</script>';
exit();