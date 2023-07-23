<?php
if (isset($_GET['i'])) {
    $descripcion = 'err000';
    $codigo = $_GET['i'];
    require_once('../../controllers/estado_controller.php');
    $controller = new EstadoController();
    $result_estado = $controller->BuscarEstadoByCodigo($codigo);
    $numrows = mysqli_num_rows($result_estado);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_estado)) {
            if (isset($row["codigo"])) {
                $codigo_bd = $row["codigo"];
            }

            if (isset($row["descripcion"])) {
                $descripcion = $row["descripcion"];
            }
        }
?>
        <div class="container">
            <div class="page-content">
                <h4>Actualización de Estados</h4>
                <form action="?controller=Estado&action=UpdateEstado1" method="POST">
                    <div class="col-12">
                        <br>
                        <div class="alert alert-success">
                            <label for="codigo"><b>Estado:</b></label>
                            <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                            <br>
                            <label for="descripcion"><b>Nueva Descripción:</b></label>
                            <textarea class="form-control" name="descripcion" rows="4" required placeholder="<?php echo $descripcion; ?>"></textarea>
                            <br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        require_once('../../views/domicilio/estado/list_estado.php');
    }
} else {
    require_once('../../views/domicilio/estado/list_estado.php');
}
?>