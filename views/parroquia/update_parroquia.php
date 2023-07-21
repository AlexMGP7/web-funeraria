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
                $codigo_bd = $row["codigo"];
            } else {
                $codigo_bd = "";
            }
            if (isset($row["descripcion"])) {
                $descripcion = $row["descripcion"];
            } else {
                $descripcion = "";
            }
            if (isset($row["Municipio_Codigo"])) {
                $municipio_codigo = $row["Municipio_Codigo"];
            } else {
                $municipio_codigo = "";
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
                                    <textarea class="form-control" name="descripcion" rows="4" required><?php echo $descripcion; ?></textarea>
                                    <br>
                                    <label for="municipio_codigo"><b>Código del Municipio:</b></label>
                                    <input class="form-control" type="text" name="municipio_codigo" value="<?php echo $municipio_codigo; ?>" readonly>
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
        require_once('../../views/parroquia/list_parroquia.php');
    }
} else {
    require_once('../../views/parroquia/list_parroquia.php');
}
?>