<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar procesar la eliminación si el usuario no ha iniciado sesión.
}

// Verificar si se ha proporcionado un parámetro 'Responsable_Juridico_Rif' y 'Polizas_De_Seguro_Numero' en la URL.
if (isset($_GET['responsable_rif']) && isset($_GET['poliza_numero'])) {
    // Obtener los valores de las claves primarias desde los parámetros en la URL.
    $responsable_rif = $_GET['responsable_rif'];
    $poliza_numero = $_GET['poliza_numero'];

    // Incluir el controlador 'PolizaXresponsableJController' para manejar las operaciones con la relación.
    require_once('../../controllers/polizaXresponsableJ_controller.php');
    $controller = new PolizaXresponsableJController();

    // Intentar eliminar la relación utilizando el método 'EliminarPolizaXresponsableJ' del controlador.
    $result_eliminar = $controller->DeletePolizaXresponsableJ1($responsable_rif, $poliza_numero);

    if ($result_eliminar) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La relación ha sido eliminada de la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la eliminación falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo eliminar la relación.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de PolizaXresponsableJ después de intentar eliminar.
    echo '<script>window.location.href = "?controller=PolizaXresponsableJ&action=ListarPolizasXresponsableJ";</script>';
    exit();
}

// Si no se proporcionan los parámetros necesarios en la URL, redirigir a la página de listado de PolizaXresponsableJ sin realizar ninguna acción de eliminación.
echo '<script>window.location.href = "?controller=PolizaXresponsableJ&action=ListarPolizasXresponsableJ";</script>';
exit();
