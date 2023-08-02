<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'PolizaXpersonaNController' para manejar las operaciones con los polizasXpersonaN.
require_once('../../controllers/polizaXpersonaN_controller.php');
$controller = new PolizaXpersonaNController();

// Obtener la lista de polizasXpersonaN utilizando el método 'ListarPolizasXpersonaN1' del controlador.
$result_polizasXpersonaN = $controller->ListarPolizasXpersonaN1();

// Contar el número de filas (polizasXpersonaN) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_polizasXpersonaN);
?>
<div class="container">
    <br> <br>
    <h4> Listado de Pólizas de Seguro asociadas a Personas Naturales registradas </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de una nueva PolizaXpersonaN. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=PolizaXpersonaN&action=IngresarPolizaXpersonaN" class="btn btn-primary custom-btn">Agregar Póliza asociada a Persona Natural</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Número de Póliza</th>
                    <th class="th-sm">Cédula de la Persona Natural</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay polizasXpersonaN registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_polizasXpersonaN)) {
                        $poliza_numero = $row["Polizas_De_Seguro_Numero"];
                        $persona_natural_cedula = $row["Persona_Natural_cedula"];
                ?>
                        <tr>
                            <td><?php echo $poliza_numero; ?></td>
                            <td><?php echo $persona_natural_cedula; ?></td>
                            <td align="center">
                                <!-- El enlace para eliminar una PolizaXpersonaN redirige a la vista de eliminación -->
                                <a href="?controller=PolizaXpersonaN&action=DeletePolizaXpersonaN&poliza_numero=<?php echo $poliza_numero; ?>&persona_natural_cedula=<?php echo $persona_natural_cedula; ?>" title="Eliminar">
                                    <img width="50px" height="50px" src="../../imagenes/delete_icon.png" alt="">
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
  