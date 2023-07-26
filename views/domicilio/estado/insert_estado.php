<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'EstadoController' para manejar las operaciones con los estados.
require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();

// Obtener el último estado utilizando el método 'BuscarUltimoEstado' del controlador.
$result_estado = $controller->BuscarUltimoEstado();

// Contar el número de filas (estados) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_estado);
?>

<div class="container-i mt-5">
    <form action="?controller=Estado&action=IngresarEstado1" method="POST">
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
