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
    $rif = $_POST['rif'];
    require_once('../../controllers/polizaXresponsableJ_controller.php');
    $controller = new PolizaXresponsableJController();
    // Intentar insertar la nueva PolizaXresponsableJ utilizando el método 'IngresarPolizaXresponsableJ' del controlador.
    $result_polizaXresponsableJ = $controller->IngresarPolizaXResponsableJ2($rif, $poliza_numero);
    if ($result_polizaXresponsableJ) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La póliza de seguro se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar la póliza de seguro.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de PolizaXresponsableJ después de intentar insertar.
    echo '<script>window.location.href = "?controller=PolizaXresponsableJ&action=ListarPolizaXresponsableJ";</script>';
    exit();
}
require_once('../../controllers/polizas_controller.php');
$poliza_controller = new PolizasController();
$result_poliza = $poliza_controller->ListarPolizas1();
require_once('../../controllers/responsableJ_controller.php');
$responsable_juridico_controller = new ResponsableJuridicoController();
$result_responsable_juridico = $responsable_juridico_controller->ListarResponsableJ1();
?>
<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=PolizaXresponsableJ&action=IngresarPolizaXresponsableJ" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Póliza asociada a Responsable Jurídico</h4>
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
            <div class="form-group">
                <label for="rif"><b>Rif del Responsable Jurídico:</b></label>
                <select class="form-control" name="rif" id="rif" required>
                    <?php
                    while ($row_responsable_juridico = mysqli_fetch_array($result_responsable_juridico)) {
                        $rif_responsable_juridico = $row_responsable_juridico['rif'];
                        // $nombre_responsable_juridico = $row_responsable_juridico['nombre'];
                        echo "<option value='$rif_responsable_juridico'>$rif_responsable_juridico</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>
