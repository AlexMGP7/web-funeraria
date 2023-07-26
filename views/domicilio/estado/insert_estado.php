<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código y la descripción del estado enviados a través del formulario.
    $codigo = $_POST['codigo_estado'];
    $descripcion = $_POST['descripcion'];

    require_once('../../controllers/estado_controller.php');
    $controller = new EstadoController();

    // Intentar insertar el nuevo estado utilizando el método 'IngresarEstado2' del controlador.
    $result_estado = $controller->IngresarEstado2($codigo, $descripcion);

    if ($result_estado) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El estado se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";

    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar el estado.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de estados después de intentar insertar.
    echo '<script>window.location.href = "?controller=Estado&action=ListarEstado";</script>';
    exit();
}
?>

<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=Estado&action=IngresarEstado" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Estados</h4>
            <div class="form-group">
                <label for="codigo_estado"><b>Codigo del Estado:</b></label>
                <input class="form-control" type="text" name="codigo_estado" id="codigo_estado" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código del Estado" />
                <small class="form-text text-muted">Solo se permiten números.</small>
            </div>
            <div class="form-group">
                <label for="descripcion"><b>Descripción:</b></label>
                <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción del estado" id="descripcion" name="descripcion" required></textarea>
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>
