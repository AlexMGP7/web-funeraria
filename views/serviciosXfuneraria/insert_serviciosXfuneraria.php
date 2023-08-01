<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario.
    $funeraria_rif = $_POST['funeraria_rif'];
    $servicios_prestados_codigo = $_POST['servicios_prestados_codigo'];

    require_once('../../controllers/serviciosXfuneraria_controller.php');
    $controller = new ServiciosXFunerariaController();

    // Intentar insertar el nuevo servicioXfuneraria utilizando el método 'IngresarServiciosXFuneraria' del controlador.
    $result_serviciosXfuneraria = $controller->IngresarServicioXFuneraria2($funeraria_rif, $servicios_prestados_codigo);

    if ($result_serviciosXfuneraria) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El servicio de funeraria se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar el servicio de funeraria.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de serviciosXfuneraria después de intentar insertar.
    echo '<script>window.location.href = "?controller=ServiciosXfuneraria&action=ListarServiciosXfuneraria";</script>';
    exit();
}

require_once('../../controllers/ServiciosP_controller.php');
$servicioP_controller = new ServiciosPController();
$result_servicioP = $servicioP_controller->ListarServiciosP1();

require_once('../../controllers/Funeraria_controller.php');
$funeraria_controller = new FunerariaController();
$result_funeraria = $funeraria_controller->ListarFuneraria1();
?>

<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=ServiciosXfuneraria&action=IngresarServiciosXfuneraria" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Servicios de Funeraria</h4>
            <div class="form-group">
                <label for="rif"><b>RIF de la Funeraria:</b></label>
                <select class="form-control" name="funeraria_rif" id="funeraria_rif" required>
                    <?php
                    while ($row_funeraria = mysqli_fetch_array($result_funeraria)) {
                        $rif_funeraria = $row_funeraria['rif'];
                        $tipo_funeraria = $row_funeraria['tipo'];
                        echo "<option value='$rif_funeraria'>$rif_funeraria / $tipo_funeraria</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="servicios_prestados_codigo"><b>Codigo de Servicios Prestado:</b></label>
                <select class="form-control" name="servicios_prestados_codigo" id="servicios_prestados_codigo" required>
                    <?php
                    while ($row_servicioP = mysqli_fetch_array($result_servicioP)) {
                        $codigo_servicioP = $row_servicioP['codigo'];
                        $nombre_servicioP = $row_servicioP['nombre'];
                        echo "<option value='$codigo_servicioP'>$codigo_servicioP - $nombre_servicioP</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>