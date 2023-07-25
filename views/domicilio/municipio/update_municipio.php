<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
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
        <div class="container">
            <div class="page-content">
                <h4>Actualización de Municipio</h4>
                <form action="?controller=Municipio&action=UpdateMunicipio1" method="POST">
                    <br>
                    <div class="alert alert-success">
                        <label for="codigo"><b>Municipio:</b></label>
                        <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                        <br>
                        <label for="descripcion"><b>Nueva Descripción:</b></label>
                        <textarea class="form-control" name="descripcion" required placeholder="<?php echo $descripcion; ?>"></textarea>
                        <br>
                        <label for="estado_codigo" align="right"><b>Estado:</b></label>
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
                        <br>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Actualizar</button>
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