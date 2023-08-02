<?php
// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la fecha actual
    $fechaActual = date('Y-m-d');
    // Obtener los datos del formulario
    $numero = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];
    $numero_poliza = $_POST['poliza_numero'];
    // Verificar que la fecha sea anterior o igual a la fecha actual
    if ($fecha > $fechaActual) {
        $_SESSION['mensaje'] = "La fecha no puede ser posterior a la fecha actual.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=PagoM&action=ListarPagoM";</script>';
        exit();
    }

    require_once('../../controllers/pagoM_controller.php');
    $controller = new PagoMController();

    // Insertar el pago mensual y obtener el resultado
    $result_pagoM = $controller->IngresarPagoM2($numero, $fecha, $monto, $numero_poliza);

    // Verificar si el insert fue exitoso
    if ($result_pagoM) {
        $_SESSION['mensaje'] = "El pago mensual se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar el pago mensual. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    
    // Redirigir a la página de listado de pagos mensuales después de intentar insertar.
    echo '<script>window.location.href = "?controller=PagoM&action=ListarPagoM";</script>';
    exit();
}

require_once('../../controllers/pagoM_controller.php');
$controller = new PagoMController();
$result_pagoM = $controller->BuscarUltimoPagoM();
$numrows = mysqli_num_rows($result_pagoM);

require_once('../../controllers/polizas_controller.php');
$poliza_controller = new PolizasController();
$result_poliza = $poliza_controller->ListarPolizas1();
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=PagoM&action=IngresarPagoM" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Pago Mensual</h4>
                <div class="form-group">
                    <label for="numero"><b>Número de Pago Mensual:</b></label>
                    <input class="form-control" type="number" name="numero" id="numero" required placeholder="Ingrese aquí el número del pago mensual" />
                </div>
                <div class="form-group">
                    <label for="fecha"><b>Fecha del Pago Mensual:</b></label>
                    <input class="form-control" type="date" name="fecha" id="fecha" required />
                </div>
                <div class="form-group">
                    <label for="monto"><b>Monto del Pago Mensual:</b></label>
                    <input class="form-control" type="number" name="monto" id="monto" required placeholder="Ingrese aquí el monto del pago mensual" />
                </div>
                <div class="form-group">
                <label for="poliza_numero"><b>Número de Póliza:</b></label>
                <select class="form-control" name="poliza_numero" id="poliza_numero" required>
                    <?php
                    while ($row_poliza = mysqli_fetch_array($result_poliza)) {
                        $numero_poliza = $row_poliza['Numero'];
                        echo "<option value='$numero_poliza'>$numero_poliza</option>";
                    }
                    ?>
                </select>
            </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>
