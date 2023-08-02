<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

require_once('../../controllers/pagoM_controller.php');
$controller = new PagoMController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];
    $numero_poliza = $_POST['poliza_numero'];

    $result_pagoM = $controller->UpdatePagoM2($numero, $fecha, $monto, $numero_poliza);

    if ($result_pagoM) {
        $_SESSION['mensaje'] = "El pago mensual se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el pago mensual. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    echo '<script>window.location.href = "?controller=PagoM&action=ListarPagoM";</script>';
    exit();
}

if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];

    require_once('../../controllers/pagoM_controller.php');
    $controller = new PagoMController();
    $result_pagoM = $controller->BuscarPagoMPorNumero($numero);
    $numrows = mysqli_num_rows($result_pagoM);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_pagoM)) {
            $numero = $row["numero"];
            $fecha = $row["fecha"];
            $monto = $row["monto"];
            $numero_poliza = $row["numero_poliza"];
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=PagoM&action=UpdatePagoM" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Pago Mensual</h4>
                        <div class="form-group">
                            <label for="numero"><b>Número de Pago Mensual:</b></label>
                            <input class="form-control" type="number" name="numero" value="<?php echo $numero; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fecha"><b>Fecha del Pago Mensual:</b></label>
                            <input class="form-control" type="date" name="fecha" value="<?php echo $fecha; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="monto"><b>Monto del Pago Mensual:</b></label>
                            <input class="form-control" type="number" name="monto" value="<?php echo $monto; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="poliza_numero"><b>Número de Póliza:</b></label>
                            <select class="form-control" name="poliza_numero" id="poliza_numero" required>
                                <?php
                                require_once('../../controllers/polizas_controller.php');
                                $poliza_controller = new PolizasController();
                                $result_poliza = $poliza_controller->ListarPolizas1();

                                while ($row_poliza = mysqli_fetch_array($result_poliza)) {
                                    $numero_poliza = $row_poliza['Numero'];
                                    echo "<option value='$numero_poliza' " . ($numero_poliza === $numero_poliza ? 'selected' : '') . ">$numero_poliza</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        require_once('../../views/pagoM/list_pagoM.php');
    }
} else {
    require_once('../../views/pagoM/list_pagoM.php');
}
?>
