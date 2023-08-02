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
        echo '<script>window.location.href = "?controller=FacturaA&action=ListarFacturaA";</script>';
        exit();
    }

    require_once('../../controllers/facturaA_controller.php');
    $controller = new FacturaAController();

    // Insertar la factura y obtener el resultado
    $result_facturaA = $controller->IngresarFacturaA2($numero, $fecha, $monto, $numero_poliza);

    // Verificar si el insert fue exitoso
    if ($result_facturaA) {
        $_SESSION['mensaje'] = "La factura se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la factura. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de facturas después de intentar insertar.
    echo '<script>window.location.href = "?controller=FacturaA&action=ListarFacturaA";</script>';
    exit();
}
require_once('../../controllers/polizas_controller.php');
$poliza_controller = new PolizasController();
$result_poliza = $poliza_controller->ListarPolizas1();
require_once('../../controllers/facturaA_controller.php');
$controller = new FacturaAController();
$result_facturaA = $controller->BuscarUltimaFacturaA();
$numrows = mysqli_num_rows($result_facturaA);
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=FacturaA&action=IngresarFacturaA" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Factura</h4>
                <div class="form-group">
                    <label for="numero"><b>Número de Factura:</b></label>
                    <input class="form-control" type="number" name="numero" id="numero" required placeholder="Ingrese aquí el número de la factura" />
                </div>
                <div class="form-group">
                    <label for="fecha"><b>Fecha de Factura:</b></label>
                    <input class="form-control" type="date" name="fecha" id="fecha" required />
                </div>
                <div class="form-group">
                    <label for="monto"><b>Monto de la Factura:</b></label>
                    <input class="form-control" type="number" name="monto" id="monto" required placeholder="Ingrese aquí el monto de la factura" />
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
