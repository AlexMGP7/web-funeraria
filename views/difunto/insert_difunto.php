<?php

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la fecha actual
    $fechaActual = date('Y-m-d');
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $fechaN = $_POST['fechaN'];
    $fechaD = $_POST['fechaD'];
    $partidaN = $_POST['partidaN'];
    $causaM = $_POST['causaM'];
    $rif = $_POST['rif'];
    // Verificar que la fecha de nacimiento sea anterior a la fecha actual
    if ($fechaN > $fechaActual) {
        $_SESSION['mensaje'] = "La fecha de nacimiento no puede ser posterior a la fecha actual.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=Difunto&action=IngresarDifunto";</script>';
        exit();
    }
    // Verificar que la fecha de defunción sea anterior o igual a la fecha actual
    if ($fechaD > $fechaActual) {
        $_SESSION['mensaje'] = "La fecha de defunción no puede ser posterior a la fecha actual.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=Difunto&action=IngresarDifunto";</script>';
        exit();
    }
    // Verificar que la fecha de defunción sea posterior a la fecha de nacimiento
    if ($fechaD <= $fechaN) {
        $_SESSION['mensaje'] = "La fecha de defunción debe ser posterior a la fecha de nacimiento.";
        $_SESSION['mensaje_tipo'] = "warning";
        echo '<script>window.location.href = "?controller=Difunto&action=IngresarDifunto";</script>';
        exit();
    }

    require_once('../../controllers/difunto_controller.php');
    $controller = new DifuntoController();

    // Insertar el difunto y obtener el resultado
    $result_difunto = $controller->IngresarDifunto2($cedula, $fechaN, $fechaD, $partidaN, $causaM, $rif);

    // Verificar si el insert fue exitoso
    if ($result_difunto) {
        $_SESSION['mensaje'] = "El difunto se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar el difunto. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de difuntos después de intentar insertar.
    echo '<script>window.location.href = "?controller=Difunto&action=ListarDifunto";</script>';
    exit();
}

require_once('../../controllers/cementerio_controller.php');
$cementerio_controller = new CementerioController();
$result_cementerios = $cementerio_controller->ListarCementerios1();

?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Difunto&action=IngresarDifunto" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Difuntos</h4>
                <div class="form-group">
                    <label for="cedula"><b>Cédula:</b></label>
                    <select class="form-control" name="cedula" id="cedula" required>
                        <?php
                        $controller = new DifuntoController();
                        $result_persona = $controller->ListarPersonas();

                        while ($row_persona = mysqli_fetch_array($result_persona)) {
                            $cedula = $row_persona['cedula'];
                            $nombre = $row_persona['nombre'];
                            echo "<option value='$cedula'>$cedula - $nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fechaN"><b>Fecha de Nacimiento:</b></label>
                    <input class="form-control" type="date" name="fechaN" id="fechaN" required />
                </div>
                <div class="form-group">
                    <label for="fechaD"><b>Fecha de Defunción:</b></label>
                    <input class="form-control" type="date" name="fechaD" id="fechaD" required />
                </div>
                <div class="form-group">
                    <label for="partidaN"><b>Partida de Nacimiento (Opcional):</b></label>
                    <input class="form-control" type="text" name="partidaN" id="partidaN" maxlength="50" placeholder="Ingrese aquí la partida de nacimiento" />
                </div>
                <div class="form-group">
                    <label for="causaM"><b>Causa de Muerte:</b></label>
                    <input class="form-control" type="text" name="causaM" id="causaM" maxlength="100" required placeholder="Ingrese aquí la causa de muerte" />
                </div>
                <div class="form-group">
                    <label for="rif"><b>Cementerio:</b></label>
                    <select class="form-control" name="rif" id="rif" required>
                        <?php
                        while ($row_cementerio = mysqli_fetch_array($result_cementerios)) {
                            $rif_cementerio = $row_cementerio['rif'];
                            $codigo_cementerio = $row_cementerio['Codigo'];
                            $tipo_cementerio = $row_cementerio['Tipo'];
                            echo "<option value='$rif_cementerio'>$rif_cementerio - Cod: {$row_cementerio['codigo']} - Tipo: {$row_cementerio['tipo']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>