<?php
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
        <div class="container">
            <div class="page-content">

                <hr>
                <h4>Actualización de Parroquia</h4>
                <form action="?controller=Parroquia&action=UpdateParroquia1" method="POST">
                    <div class="col-12">
                        <br>
                        <div class="alert alert-success">
                            <div class="row">
                                <div class="col-6">
                                    <label for="codigo"><b>Código de la Parroquia:</b></label>
                                    <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                    <br>
                                    <label for="descripcion"><b>Nueva Descripción:</b></label>
                                    <textarea class="form-control" name="descripcion" rows="4" required placeholder="<?php echo $descripcion; ?>"></textarea>
                                    <br>
                                    <label for="municipio_codigo"><b>Código del Municipio:</b></label>
                                    <input class="form-control" type="text" name="municipio_codigo" value="<?php echo $municipio_codigo; ?>" readonly>
                                    <br>
                                    <label for="estado_codigo"><b>Código del Estado:</b></label>
                                    <input class="form-control" type="text" name="estado_codigo" value="<?php echo $estado_codigo; ?>" readonly>
                                    <br>
                                </div>
                            </div>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        require_once('../../views/domicilio/parroquia/list_parroquia.php');
    }
} else {
    require_once('../../views/domicilio/parroquia/list_parroquia.php');
}
?>