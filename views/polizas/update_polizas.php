<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

require_once('../../controllers/polizas_controller.php');
$controller = new PolizasController();

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la fecha actual
    $fechaActual = date('Y-m-d');
    // Obtener los datos actualizados del formulario.
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

    // Intentar actualizar la póliza utilizando el método 'UpdatePoliza2' del controlador.
    $result_poliza = $controller->UpdatePoliza2($numero, $fecha_apertura, $fecha_cierre, $cuota_anual, $cuota_mensual, $observaciones);

    if ($result_poliza) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La póliza ha sido modificada en la base de datos de forma satisfactoria.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar la póliza.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de pólizas después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Polizas&action=ListarPolizas";</script>';
    exit();
}

// Verificar si se ha proporcionado un parámetro 'numero' en la URL.
if (isset($_GET['numero'])) {
    // Obtener el número de la póliza a actualizar desde el parámetro 'numero' en la URL.
    $numero = $_GET['numero'];

    // Obtener los datos de la póliza a actualizar utilizando el método 'BuscarPolizaByNumero' del controlador.
    $result_poliza = $controller->BuscarPolizaPorNumero($numero);
    $numrows = mysqli_num_rows($result_poliza);

    if ($numrows != 0) {
        // Si se encontró la póliza en la base de datos, obtener los datos y mostrar el formulario de actualización.
        while ($row = mysqli_fetch_array($result_poliza)) {
            if (isset($row["numero"])) {
                $numero_bd = $row["numero"];
            }

            if (isset($row["fecha_apertura"])) {
                $fecha_apertura = $row["fecha_apertura"];
            }

            if (isset($row["fecha_cierre"])) {
                $fecha_cierre = $row["fecha_cierre"];
            }

            if (isset($row["cuota_anual"])) {
                $cuota_anual = $row["cuota_anual"];
            }

            if (isset($row["cuota_mensual"])) {
                $cuota_mensual = $row["cuota_mensual"];
            }

            if (isset($row["observaciones"])) {
                $observaciones = $row["observaciones"];
            }
        }
?>
        <div class="container-i mt-5">
            <form action="?controller=Polizas&action=UpdatePolizas" method="POST">
                <div class="custom-form-background p-4">
                    <h4 class="mb-4">Actualización de Póliza de Seguro</h4>
                    <div class="form-group">
                        <label for="numero"><b>Número de Póliza: <?php echo $numero ?></b></label>
                        <!-- Mostrar el número de la póliza en un campo de solo lectura -->
                        <input class="form-control" type="text" name="numero" value="<?php echo $numero; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fecha_apertura"><b>Fecha de Apertura:</b></label>
                        <!-- Mostrar la fecha de apertura actual de la póliza en un campo de texto para ser modificado -->
                        <input class="form-control" type="date" name="fecha_apertura" value="<?php echo $fecha_apertura; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fecha_cierre"><b>Fecha de Cierre:</b></label>
                        <!-- Mostrar la fecha de cierre actual de la póliza en un campo de texto para ser modificado -->
                        <input class="form-control" type="date" name="fecha_cierre" value="<?php echo $fecha_cierre; ?>">
                    </div>
                    <div class="form-group">
                        <label for="cuota_anual"><b>Cuota Anual:</b></label>
                        <!-- Mostrar la cuota anual actual de la póliza en un campo de texto para ser modificado -->
                        <input class="form-control" type="number" name="cuota_anual" value="<?php echo $cuota_anual; ?>">
                    </div>
                    <div class="form-group">
                        <label for="cuota_mensual"><b>Cuota Mensual:</b></label>
                        <!-- Mostrar la cuota mensual actual de la póliza en un campo de texto para ser modificado -->
                        <input class="form-control" type="number" name="cuota_mensual" value="<?php echo $cuota_mensual; ?>">
                    </div>
                    <div class="form-group">
                        <label for="observaciones"><b>Observaciones:</b></label>
                        <!-- Mostrar las observaciones actuales de la póliza en un campo de texto para ser modificado -->
                        <textarea class="form-control" name="observaciones" rows="3"><?php echo $observaciones; ?></textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
<?php
    } else {
        // Si no se encuentra la póliza en la base de datos, redirigir a la página de listado de pólizas.
        require_once('../../views/polizas/list_polizas.php');
    }
} else {
    // Si no se proporciona el parámetro 'numero' en la URL, redirigir a la página de listado de pólizas.
    require_once('../../views/polizas/list_polizas.php');
}
?>
  