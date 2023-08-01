<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la fecha actual
    $fechaActual = date('Y-m-d');
    // Obtener los datos del formulario.
    $numero = $_POST['numero'];
    $fecha_apertura = $_POST['fecha_apertura'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $cuota_anual = $_POST['cuota_anual'];
    $cuota_mensual = $_POST['cuota_mensual'];
    $observaciones = $_POST['observaciones'];
    // Verificar que la fecha de apertura sea anterior a la fecha actual
    if ($fecha_apertura > $fechaActual) {
        $_SESSION['mensaje'] = "La fecha de apertura no puede ser posterior a la fecha actual.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=Polizas&action=IngresarPolizas";</script>';
        exit();
    }
    if ($fecha_cierre > $fechaActual) {
        $_SESSION['mensaje'] = "La fecha de cierre no puede ser posterior a la fecha actual.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=Polizas&action=IngresarPolizas";</script>';
        exit();
    }
    // Verificar que la fecha de cierre sea posterior a la fecha de apertura
    if ($fecha_cierre <= $fecha_apertura) {
        $_SESSION['mensaje'] = "La fecha de cierre debe ser posterior a la fecha de apertura.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=Polizas&action=IngresarPolizas";</script>';
        exit();
    }

    require_once('../../controllers/polizas_controller.php');
    $controller = new PolizasController();

    // Intentar insertar la nueva póliza utilizando el método 'IngresarPoliza2' del controlador.
    $result_poliza = $controller->IngresarPoliza2($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones);

    if ($result_poliza) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La póliza se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar la póliza.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de pólizas después de intentar insertar.
    echo '<script>window.location.href = "?controller=Polizas&action=ListarPolizas";</script>';
    exit();
}
?>

<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=Polizas&action=IngresarPolizas" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Póliza de Seguro</h4>
            <div class="form-group">
                <label for="numero"><b>Número de Póliza:</b></label>
                <input class="form-control" type="text" name="numero" id="numero" required placeholder="Ingrese aquí el número de la póliza" />
            </div>
            <div class="form-group">
                <label for="fecha_apertura"><b>Fecha de Apertura:</b></label>
                <input class="form-control" type="date" name="fecha_apertura" id="fecha_apertura" required placeholder="Ingrese aquí la fecha de apertura de la póliza" />
            </div>
            <div class="form-group">
                <label for="fecha_cierre"><b>Fecha de Cierre:</b></label>
                <input class="form-control" type="date" name="fecha_cierre" id="fecha_cierre" required placeholder="Ingrese aquí la fecha de cierre de la póliza" />
            </div>
            <div class="form-group">
                <label for="cuota_anual"><b>Cuota Anual:</b></label>
                <input class="form-control" type="number" name="cuota_anual" id="cuota_anual" required placeholder="Ingrese aquí la cuota anual de la póliza" />
            </div>
            <div class="form-group">
                <label for="cuota_mensual"><b>Cuota Mensual:</b></label>
                <input class="form-control" type="number" name="cuota_mensual" id="cuota_mensual" required placeholder="Ingrese aquí la cuota mensual de la póliza" />
            </div>
            <div class="form-group">
                <label for="observaciones"><b>Observaciones:</b></label>
                <textarea class="form-control" name="observaciones" id="observaciones" rows="3" placeholder="Ingrese aquí las observaciones de la póliza"></textarea>
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>