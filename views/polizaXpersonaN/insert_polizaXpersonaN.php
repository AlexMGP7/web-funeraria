<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}
// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario.
    $persona_natural_cedula = $_POST['persona_natural_cedula'];
    $polizas_de_seguro_numero = $_POST['polizas_de_seguro_numero'];
    require_once('../../controllers/polizaXpersonaN_controller.php');
    $controller = new PolizaXpersonaNController();
    // Intentar insertar la nueva PolizaXpersonaN utilizando el método 'IngresarPolizaXpersonaN2' del controlador.
    $result_polizaXpersonaN = $controller->IngresarPolizaXpersonaN2($persona_natural_cedula, $polizas_de_seguro_numero);
    if ($result_polizaXpersonaN) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La póliza de seguro se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar la póliza de seguro.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de PolizaXpersonaN después de intentar insertar.
    echo '<script>window.location.href = "?controller=PolizaXpersonaN&action=ListarPolizaXpersonaN";</script>';
    exit();
}
require_once('../../controllers/personaNatural_controller.php');
$personaN_controller = new PersonaNaturalController();
$result_persona_natural = $personaN_controller->ListarPersonas();
require_once('../../controllers/polizas_controller.php');
$poliza_controller = new PolizasController();
$result_poliza = $poliza_controller->ListarPolizas1();
?>
<!-- Aquí empieza el formulario -->
<div class="container-i mt-5">
    <form action="?controller=PolizaXpersonaN&action=IngresarPolizaXpersonaN" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Póliza asociada a Persona Natural</h4>
            <div class="form-group">
                <label for="persona_natural_cedula"><b>Cédula de la Persona Natural:</b></label>
                <select class="form-control" name="persona_natural_cedula" id="persona_natural_cedula" required>
                    <?php
                    while ($row_persona_natural = mysqli_fetch_array($result_persona_natural)) {
                        $cedula_persona_natural = $row_persona_natural['cedula'];
                        echo "<option value='$cedula_persona_natural'>$cedula_persona_natural</option>";
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