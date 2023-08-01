<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario.
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $monto = $_POST['monto'];

    require_once('../../controllers/serviciosP_controller.php');
    $controller = new ServiciosPController();

    // Intentar insertar el nuevo servicio prestado utilizando el método 'IngresarServicioP2' del controlador.
    $result_servicioP = $controller->IngresarServicioP2($codigo, $nombre, $tipo, $monto);

    if ($result_servicioP) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El servicio prestado se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar el servicio prestado.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de servicios prestados después de intentar insertar.
    echo '<script>window.location.href = "?controller=ServiciosP&action=ListarServiciosP";</script>';
    exit();
}
?>

<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=ServiciosP&action=IngresarServiciosP" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Servicios Prestados</h4>
            <div class="form-group">
                <label for="codigo"><b>Código del Servicio Prestado:</b></label>
                <input class="form-control" type="text" name="codigo" id="codigo" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código del Servicio Prestado" />
                <small class="form-text text-muted">Solo se permiten números.</small>
            </div>
            <div class="form-group">
                <label for="nombre"><b>Nombre:</b></label>
                <input class="form-control" type="text" name="nombre" id="nombre" required placeholder="Ingrese aquí el nombre del Servicio Prestado" />
            </div>
            <div class="form-group">
                <label for="tipo"><b>Tipo:</b></label>
                <input class="form-control" type="text" name="tipo" id="tipo" required placeholder="Ingrese aquí el tipo del Servicio Prestado" />
            </div>
            <div class="form-group">
                <label for="monto"><b>Monto:</b></label>
                <input class="form-control" type="number" name="monto" id="monto" required placeholder="Ingrese aquí el monto del Servicio Prestado" />
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>