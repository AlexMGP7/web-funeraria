<?php
//if (isset($_SESSION['User']) == 1)
//{
require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();
$result_estado = $controller->BuscarUltimoEstado();
$numrows = mysqli_num_rows($result_estado);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que el campo Codigo del Estado sea un número
    if (!empty($_POST['codigo_estado']) && !is_numeric($_POST['codigo_estado'])) {
        echo '<div class="alert alert-danger">El Código del Estado debe ser un número.</div>';
    } else {
        // Resto del procesamiento cuando el Código del Estado es válido
        // ...

        // Por ejemplo:
        // $codigo_estado = $_POST['codigo_estado'];
        // $descripcion = $_POST['descripcion'];
        // Procesar los valores ingresados
    }
}
?>

<div class="contaniner"> <!-- 1 -->

    <div class="page-content"><!-- 3 -->
        <form action="?controller=Estado&action=IngresarEstado1" method="POST"> <!-- 3 -->
            <div class="col-12"> <!-- 5 -->
                <br>
                <h4> Ingreso de Estados Publicadas o por Publicar</h4>
                <br>
                <div class="alert alert-success">
                    <div class="row">
                        <div class="col-6">
                            <label for="codigo_estado" align="right" size="40"><b>Codigo del Estado:</b></label>
                            <input class="form-control mr-sm-2" type="text" name="codigo_estado" id="codigo_estado" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese el código del estado" />
                            <span class="text-black">Solo se permiten números.</span>
                            <br>
                            <label for="descripcion" align="right" size="40"><b>Descripción:</b></label>
                            <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción del estado" id="descripcion" name="descripcion" rows="4" required></textarea>
                            <br>
                        </div>
                    </div>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
                </div>
            </div>
        </form> <!-- 3 -->
    </div> <!-- 4 -->

    <p> <br> </p>

</div> <!-- 1 -->

<?php
//}
// else {
//    require_once('../revista-cientifica-catedra-digital/views/Estados/insertnot.php');
// }
?>