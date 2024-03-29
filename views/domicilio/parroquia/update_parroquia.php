<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código, la descripción y el código de municipio enviados a través del formulario.
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $municipio_codigo = $_POST['municipio_codigo'];

    require_once('../../controllers/parroquia_controller.php');
    $controller = new ParroquiaController();

    // Intentar actualizar la parroquia utilizando el método 'UpdateParroquia2' del controlador.
    $result_parroquia = $controller->UpdateParroquia2($codigo, $descripcion, $municipio_codigo);

    if ($result_parroquia) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La parroquia se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar la parroquia.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de parroquias después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Parroquia&action=ListarParroquia";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/parroquia_controller.php');
    $controller = new ParroquiaController();
    $result_parroquia = $controller->BuscarParroquiaByCodigo($codigo);
    $numrows = mysqli_num_rows($result_parroquia);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_parroquia)) {
            if (isset($row["codigo"])) {
                $parroquia_codigo = $row["codigo"];
            }
            if (isset($row["parroquia_descripcion"])) {
                $descripcion = $row["parroquia_descripcion"];
            }
            if (isset($row["municipio_codigo"])) {
                $municipio_codigo = $row["municipio_codigo"];
            }
            if (isset($row["municipio_descripcion"])) {
                $municipio_descripcion = $row["municipio_descripcion"];
            }
            if (isset($row["estado_codigo"])) {
                $estado_codigo = $row["estado_codigo"];
            }
            if (isset($row["estado_descripcion"])) {
                $estado_descripcion = $row["estado_descripcion"];
            }
        }
?>
        <div class="container-i mt-5">
            <form action="?controller=Parroquia&action=UpdateParroquia" method="POST">
                <div class="custom-form-background p-4">
                    <h4 class="mb-4">Actualización de Parroquia</h4>
                    <div class="form-group">
                        <label for="codigo"><b>Codigo de la Parroquia: <?php echo $descripcion ?></b></label>
                        <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="descripcion"><b>Nueva Descripción:</b></label>
                        <input class="form-control" type="text" name="descripcion" value="<?php echo $descripcion; ?>">
                    </div>
                    <div class="form-group">
                            <label for="estado_codigo"><b>Estado:</b></label>
                            <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                                <?php
                                $controller = new ParroquiaController();
                                $result_estados = $controller->ListarEstados();

                                while ($row_estado = mysqli_fetch_array($result_estados)) {
                                    $codigo_estado = $row_estado['codigo'];
                                    $descripcion_estado = $row_estado['descripcion'];
                                    $selected = ($codigo_estado == $estado_codigo) ? 'selected' : '';
                                    echo "<option value='$codigo_estado' $selected>$codigo_estado - $descripcion_estado</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="municipio_codigo"><b>Municipio:</b></label>
                            <select class="form-control" id="municipio_codigo" name="municipio_codigo" required>
                                <?php
                                $controller = new ParroquiaController();
                                $result_municipios = $controller->ListarMunicipios();

                                while ($row_municipio = mysqli_fetch_array($result_municipios)) {
                                    $codigo_municipio = $row_municipio['codigo'];
                                    $descripcion_municipio = $row_municipio['descripcion'];
                                    $selected = ($codigo_municipio == $municipio_codigo) ? 'selected' : '';
                                    echo "<option value='$codigo_municipio' $selected>$codigo_municipio - $descripcion_municipio</option>";
                                }
                                ?>
                            </select>
                        </div>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
<?php
    } else {
        require_once('../../views/domicilio/parroquia/list_parroquia.php');
    }
} else {
    require_once('../../views/domicilio/parroquia/list_parroquia.php');
}
?>