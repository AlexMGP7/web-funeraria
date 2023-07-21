<?php
if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();
    $result_ciudad = $controller->BuscarCiudadByCodigo($codigo);
    $numrows = mysqli_num_rows($result_ciudad);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_ciudad)) {
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
            if (isset($row["Parroquia_Codigo"])) {
                $parroquia_codigo = $row["Parroquia_Codigo"];
            } else {
                $parroquia_codigo = "";
            }
            // Add the estado and municipio data to the loop
            if (isset($row["municipio_codigo"])) {
                $municipio_codigo = $row["municipio_codigo"];
            } else {
                $municipio_codigo = "";
            }
            if (isset($row["codigo_estado"])) {
                $codigo_estado = $row["codigo_estado"];
            } else {
                $codigo_estado = "";
            }
        }
?>
        <div class="container">
            <div class="page-content">

                <hr>
                <h4>Actualización de Ciudad</h4>
                <form action="?controller=Ciudad&action=UpdateCiudad1" method="POST">
                    <div class="col-12">
                        <br>
                        <div class="alert alert-success">
                            <div class="row">
                                <div class="col-6">
                                    <label for="codigo"><b>Código de la Ciudad:</b></label>
                                    <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                    <br>
                                    <label for="descripcion"><b>Nueva Descripción:</b></label>
                                    <textarea class="form-control" name="descripcion" rows="4" required><?php echo $descripcion; ?></textarea>
                                    <br>
                                    <label for="parroquia_codigo"><b>Código de la Parroquia:</b></label>
                                    <input class="form-control" type="text" name="parroquia_codigo" value="<?php echo $parroquia_codigo; ?>" readonly>
                                    <br>
                                    <label for="municipio_codigo"><b>Código del Municipio:</b></label>
                                    <input class="form-control" type="text" name="municipio_codigo" value="<?php echo $municipio_codigo; ?>" readonly>
                                    <br>
                                    <label for="codigo_estado"><b>Código del Estado:</b></label>
                                    <input class="form-control" type="text" name="codigo_estado" value="<?php echo $codigo_estado; ?>" readonly>
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