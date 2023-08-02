<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}
// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario.
    $difunto_cedula = $_POST['difunto_cedula'];
    $polizas_de_seguro_numero = $_POST['polizas_de_seguro_numero'];
    require_once('../../controllers/polizaXdifunto_controller.php');
    $controller = new PolizaXdifuntoController();
    // Intentar insertar el nuevo polizaXdifunto utilizando el método 'IngresarPolizaXdifunto2' del controlador.
    $result_polizaXdifunto = $controller->IngresarPolizaXdifunto2($difunto_cedula, $polizas_de_seguro_numero);
    if ($result_polizaXdifunto) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La póliza de seguro se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar la póliza de seguro.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de polizaXdifunto después de intentar insertar.
    echo '<script>window.location.href = "?controller=PolizaXdifunto&action=ListarPolizaXdifunto";</script>';
    exit();
}
require_once('../../controllers/difunto_controller.php');
$difunto_controller = new DifuntoController();
$result_difunto = $difunto_controller->ListarDifuntos1();
require_once('../../controllers/polizas_controller.php');
$poliza_controller = new PolizasController();
$result_poliza = $poliza_controller->ListarPolizas1();
?>
<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=PolizaXdifunto&action=IngresarPolizaXdifunto" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Póliza asociada a Difunto</h4>
            <div class="form-group">
                <label for="difunto_cedula"><b>Cédula del Difunto:</b></label>
                <select class="form-control" name="difunto_cedula" id="difunto_cedula" required>
                    <?php
                    while ($row_difunto = mysqli_fetch_array($result_difunto)) {
                        $cedula_difunto = $row_difunto['cedula'];
                        echo "<option value='$cedula_difunto'>$cedula_difunto</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="polizas_de_seguro_numero"><b>Número de Póliza:</b></label>
                <select class="form-control" name="polizas_de_seguro_numero" id="polizas_de_seguro_numero" required>
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