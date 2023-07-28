<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $fechaN = $_POST['fechaN'];
    $fechaD = $_POST['fechaD'];
    $partidaN = $_POST['partidaN'];
    $causaM = $_POST['causaM'];
    $rif = $_POST['rif'];

    require_once('../../controllers/difunto_controller.php');
    $controller = new DifuntoController();

    // Actualizar el difunto y obtener el resultado
    $result_difunto = $controller->UpdateDifunto2($cedula, $fechaN, $fechaD, $partidaN, $causaM, $rif);

    // Verificar si la actualización fue exitosa
    if ($result_difunto) {
        $_SESSION['mensaje'] = "El difunto se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el difunto. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de difuntos después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Difunto&action=ListarDifunto";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $cedula = $_GET['i'];
    require_once('../../controllers/difunto_controller.php');
    $controller = new DifuntoController();
    $result_difunto = $controller->BuscarDifuntoByCedula($cedula);
    $numrows = mysqli_num_rows($result_difunto);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_difunto)) {
            // Extract data
            if (isset($row["cedula"])) {
                $cedula = $row["cedula"];
            }
            if (isset($row["Fecha de N."])) {
                $fechaN = $row["Fecha de N."];
            }
            if (isset($row["Fecha de D."])) {
                $fechaD = $row["Fecha de D."];
            }
            if (isset($row["Partida de N."])) {
                $partidaN = $row["Partida de N."];
            }
            if (isset($row["Causa de M."])) {
                $causaM = $row["Causa de M."];
            }
            if (isset($row["Cementerio_Rif"])) {
                $rif = $row["Cementerio_Rif"];
            }
        }
        require_once('../../controllers/cementerio_controller.php');
        $cementerio_controller = new CementerioController();
        $result_cementerios = $cementerio_controller->ListarCementerios1();
?>

        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Difunto&action=UpdateDifunto" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Difunto</h4>
                        <div class="form-group">
                            <label for="cedula"><b>Cédula:</b></label>
                            <input class="form-control" type="text" name="cedula" value="<?php echo $cedula; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fechaN"><b>Fecha de Nacimiento:</b></label>
                            <input class="form-control" type="date" name="fechaN" value="<?php echo $fechaN; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="fechaD"><b>Fecha de Defunción:</b></label>
                            <input class="form-control" type="date" name="fechaD" value="<?php echo $fechaD; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="partidaN"><b>Partida de Nacimiento (Opcional):</b></label>
                            <input class="form-control" type="text" name="partidaN" value="<?php echo $partidaN; ?>" maxlength="50" placeholder="Ingrese aquí la partida de nacimiento" />
                        </div>
                        <div class="form-group">
                            <label for="causaM"><b>Causa de Muerte:</b></label>
                            <input class="form-control" type="text" name="causaM" value="<?php echo $causaM; ?>" maxlength="100" required placeholder="Ingrese aquí la causa de muerte" />
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
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>


<?php
    } else {
        // If Difunto not found, redirect to the list of difuntos
        require_once('../../views/difunto/list_difunto.php');
    }
} else {
    // If 'i' parameter not provided in the URL, redirect to the list of difuntos
    require_once('../../views/difunto/list_difunto.php');
}
?>