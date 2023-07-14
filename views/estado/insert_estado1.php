<?php

// if ((isset($_SESSION['User']) == 1) and (isset($_POST['id']) == 1))
// {
$codigo = $_POST['codigo_estado'];
$descripcion = $_POST['descripcion'];

require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();
$result_estado = $controller->IngresarEstado2($codigo, $descripcion);

if ($result_estado == false) // la consulta no fue exitosa
{   ?>
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <label for="busqueda" align="right"> <strong>Mensaje de Advertencia</strong><br>
            <p> Ocurrió un error mientras se intentaba ingresar el estado en la base de datos. Revise los datos e intente nuevamente. Asegúrese de que no esté intentando ingresar un estado repetido. </p>
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
            <p> El estado de ha registrado correctamente. </p>
        </label> <br>

    </div>
<?php
}

//     require_once('../ejercicio/views/noticias/insertnot.php');
// }else
// {
// 	require_once('../ejercicio/views/noticias/insertnot.php');
// }

?>