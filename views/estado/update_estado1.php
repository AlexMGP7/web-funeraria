<?php

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

    require_once('../../controllers/estado_controller.php');
    $controller = new EstadoController();
    $result_estado = $controller->UpdateEstado2($codigo, $descripcion);

    if ($result_estado == false) {
?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <label for="busqueda" align="right"> <strong>Mensaje de Advertencia</strong><br>
                <p>Ocurrió un error mientras se intentaba actualizar el estado en la base de datos. Revise los datos e intente nuevamente. Asegúrese de hacer alguna actualización de datos y de que no está intentando modificar un estado inexistente.</p>
            </label> <br>

        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <label for="busqueda" align="right"> <strong>Mensaje de Éxito</strong> <br>
                <p>El estado ha sido modificado en la base de datos de forma satisfactoria.</p>
            </label> <br>
        </div>
<?php
    }
    require_once('../../views/estado/list_estado.php');
} else {
    require_once('../../views/estado/list_estado.php');
}

?>