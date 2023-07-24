<?php
require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();
$result_estado = $controller->BuscarUltimoEstado();
$numrows = mysqli_num_rows($result_estado);

?>

<div class="contaniner">

    <div class="page-content">
        <form action="?controller=Estado&action=IngresarEstado1" method="POST">
            <br>
            <h4> Ingreso de Estados</h4>
            <br>
            <div class="alert alert-success">
                <label for="codigo_estado" align="right" size="40"><b>Estado:</b></label>
                <input class="form-control mr-sm-2" type="text" name="codigo_estado" id="codigo_estado" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aqui el codigo del Estado" />
                <span class="text-black">Solo se permiten números.</span>
                <br>
                <label for="descripcion" align="right" size="40"><b>Descripción:</b></label>
                <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción del estado" id="descripcion" name="descripcion" required></textarea>
                <br>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
            </div>
        </form>
    </div>

</div>