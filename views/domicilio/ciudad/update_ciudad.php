<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código, descripción y parroquia_codigo de la ciudad enviados a través del formulario.
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $parroquia_codigo = $_POST['parroquia_codigo'];

    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();

    // Intentar actualizar la ciudad utilizando el método 'UpdateCiudad2' del controlador.
    $result_ciudad = $controller->UpdateCiudad2($codigo, $descripcion, $parroquia_codigo);

    if ($result_ciudad) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La ciudad se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";

    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar la ciudad.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de ciudades después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Ciudad&action=ListarCiudad";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();
    $result_ciudad = $controller->BuscarCiudadByCodigo($codigo);
    $numrows = mysqli_num_rows($result_ciudad);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_ciudad)) {
            // Extract data
            if (isset($row["codigo"])) {
                $ciudad_codigo = $row["codigo"];
            }
            if (isset($row["ciudad_descripcion"])) {
                $descripcion = $row["ciudad_descripcion"];
            }
            if (isset($row["parroquia_codigo"])) {
                $parroquia_codigo = $row["parroquia_codigo"];
            }
            if (isset($row["parroquia_descripcion"])) {
                $parroquia_descripcion = $row["parroquia_descripcion"];
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
            <div class="page-content">
                <form action="?controller=Ciudad&action=UpdateCiudad" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Ciudad</h4>
                        <div class="form-group">
                            <label for="codigo"><b>Codigo de la Ciudad: <?php echo $descripcion ?></b></label>
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
                                $controller = new CiudadController();
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
                                $controller = new CiudadController();
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
                        <div class="form-group">
                            <label for="parroquia_codigo"><b>Parroquia:</b></label>
                            <select class="form-control" id="parroquia_codigo" name="parroquia_codigo" required>
                                <?php
                                $controller = new CiudadController();
                                $result_parroquias = $controller->ListarParroquias();

                                while ($row_parroquia = mysqli_fetch_array($result_parroquias)) {
                                    $codigo_parroquia = $row_parroquia['codigo'];
                                    $descripcion_parroquia = $row_parroquia['descripcion'];
                                    $selected = ($codigo_parroquia == $parroquia_codigo) ? 'selected' : '';
                                    echo "<option value='$codigo_parroquia' $selected>$codigo_parroquia - $descripcion_parroquia</option>";
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
        require_once('../../views/domicilio/ciudad/list_ciudad.php');
    }
} else {
    require_once('../../views/domicilio/ciudad/list_ciudad.php');
}
?>
