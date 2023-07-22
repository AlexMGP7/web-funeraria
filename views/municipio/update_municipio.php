<?php
if (isset($_GET['i'])) {
    $estado_codigo = "err000";
    $estado_descripcion = "err000";
    $descripcion = 'err000';
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

                <hr>
                <h4>Actualización de Municipio</h4>
                <form action="?controller=Municipio&action=UpdateMunicipio1" method="POST">
                    <div class="col-12">
                        <br>
                        <div class="alert alert-success">
                            <div class="row">
                                <div class="col-6">
                                    <label for="codigo"><b>Código del Municipio:</b></label>
                                    <input class="form-control" type="text" name="codigo" value="<?php echo $codigo . ' - ' . $descripcion; ?>" readonly>
                                    <br>
                                    <label for="descripcion"><b>Nueva Descripción:</b></label>
                                    <textarea class="form-control" name="descripcion" rows="4" required placeholder="<?php echo $descripcion; ?>"></textarea>
                                    <br>
                                    <label for="estado_codigo"><b>Código del Estado:</b></label>
                                    <input class="form-control" type="text" name="estado_codigo" value="<?php echo $estado_codigo . ' - ' . $estado_descripcion; ?>" readonly>
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
        require_once('../../views/municipio/list_municipio.php');
    }
} else {
    require_once('../../views/municipio/list_municipio.php');
}
?>