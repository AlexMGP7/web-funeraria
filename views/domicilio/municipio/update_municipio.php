<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.

    // Obtener el código, descripción y estado actualizados del municipio enviados a través del formulario de actualización.
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $estado_codigo = $_POST['estado_codigo'];

    require_once('../../controllers/municipio_controller.php');
    $controller = new MunicipioController();

    // Intentar actualizar el municipio utilizando el método 'UpdateMunicipio2' del controlador.
    $result_municipio = $controller->UpdateMunicipio2($codigo, $descripcion, $estado_codigo);

    if ($result_municipio) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El municipio se ha modificado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";

    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar el municipio.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de municipios después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Municipio&action=ListarMunicipio";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/municipio_controller.php');
    $controller = new MunicipioController();
    $result_municipio = $controller->BuscarMunicipioByCodigo($codigo);
    $numrows = mysqli_num_rows($result_municipio);

    $result_municipio = $controller->BuscarMunicipioByCodigo($codigo);
    $numrows = mysqli_num_rows($result_municipio);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_municipio)) {
            if (isset($row["codigo"])) {
                $codigo_bd = $row["codigo"];
            }
            if (isset($row["municipio_descripcion"])) {
                $descripcion = $row["municipio_descripcion"];
            }
            if (isset($row["estado_codigo"])) { // Use the correct column alias for the estado codigo
                $estado_codigo = $row["estado_codigo"];
            }
            if (isset($row["estado_descripcion"])) {
                $estado_descripcion = $row["estado_descripcion"];
            }
        }
?>

        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Municipio&action=UpdateMunicipio" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Municipio</h4>
                        <div class="form-group">
                            <label for="codigo"><b>Codigo de Municipio: <?php echo $descripcion ?></b></label>
                            <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="descripcion"><b>Nueva Descripción:</b></label>
                            <textarea class="form-control" name="descripcion" required><?php echo $descripcion; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="estado_codigo"><b>Estado:</b></label>
                            <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                                <?php
                                $controller = new MunicipioController();
                                $result_estados = $controller->ListarEstados();

                                while ($row_estado = mysqli_fetch_array($result_estados)) {
                                    $codigo_estado = $row_estado['codigo'];
                                    $descripcion_estado = $row_estado['descripcion'];
                                    echo "<option value='$codigo_estado'>$codigo_estado - $descripcion_estado</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Pre-select the previous estado_codigo value
                var prevEstadoCodigo = '<?php echo $estado_codigo; ?>';
                if (prevEstadoCodigo !== '') {
                    $('#estado_codigo').val(prevEstadoCodigo);
                }
            });
        </script>

<?php
    } else {
        require_once('../../views/domicilio/municipio/list_municipio.php');
    }
} else {
    require_once('../../views/domicilio/municipio/list_municipio.php');
}
?>
