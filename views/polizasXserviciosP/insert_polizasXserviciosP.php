<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}
// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario.
    $poliza_numero = $_POST['poliza_numero'];
    $servicios_prestados_codigo = $_POST['servicios_prestados_codigo'];
    require_once('../../controllers/polizaXserviciosP_controller.php');
    $controller = new PolizasXservicioPController();
    // Intentar insertar el nuevo polizaXservicioP utilizando el método 'IngresarPolizaXservicioP2' del controlador.
    $result_polizasXservicioP = $controller->IngresarPolizaXservicioP2($poliza_numero, $servicios_prestados_codigo);
    if ($result_polizasXservicioP) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El poliza de seguro se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar el poliza de seguro.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de polizasXservicioP después de intentar insertar.
    echo '<script>window.location.href = "?controller=PolizaXserviciosP&action=ListarPolizaXserviciosP";</script>';
    exit();
}
require_once('../../controllers/polizas_controller.php');
$poliza_controller = new PolizasController();
$result_poliza = $poliza_controller->ListarPolizas1();
require_once('../../controllers/serviciosP_controller.php');
$servicios_prestados_controller = new ServiciosPController();
$result_servicios_prestados = $servicios_prestados_controller->ListarServiciosP1();
?>
<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=PolizaXserviciosP&action=IngresarPolizaXserviciosP" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Poliza asociada a servicio</h4>
            <div class="form-group">
                <label for="poliza_numero"><b>Número de Poliza:</b></label>
                <select class="form-control" name="poliza_numero" id="poliza_numero" required>
                    <?php
                    while ($row_poliza = mysqli_fetch_array($result_poliza)) {
                        $numero_poliza = $row_poliza['Numero'];
                        echo "<option value='$numero_poliza'>$numero_poliza</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="servicios_prestados_codigo"><b>Código de Servicios Prestados:</b></label>
                <select class="form-control" name="servicios_prestados_codigo" id="servicios_prestados_codigo" required>
                    <?php
                    while ($row_servicios_prestados = mysqli_fetch_array($result_servicios_prestados)) {
                        $codigo_servicios_prestados = $row_servicios_prestados['codigo'];
                        $nombre_servicios_prestados = $row_servicios_prestados['nombre'];
                        echo "<option value='$codigo_servicios_prestados'>$codigo_servicios_prestados - $nombre_servicios_prestados</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>