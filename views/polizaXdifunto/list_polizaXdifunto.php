<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'PolizaXdifuntoController' para manejar las operaciones con los polizasXdifunto.
require_once('../../controllers/polizaXdifunto_controller.php');
$controller = new PolizaXdifuntoController();

// Obtener la lista de polizasXdifunto utilizando el método 'ListarPolizasXdifunto1' del controlador.
$result_polizasXdifunto = $controller->ListarPolizasXdifunto1();

// Contar el número de filas (polizasXdifunto) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_polizasXdifunto);
?>
<div class="container">
    <br> <br>
    <h4> Listado de Pólizas de Seguro asociadas a Difuntos registrados </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de una nueva PolizaXdifunto. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=PolizaXdifunto&action=IngresarPolizaXdifunto" class="btn btn-primary custom-btn">Agregar Póliza asociada a Difunto</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Número de Póliza</th>
                    <th class="th-sm">Cédula del Difunto</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay polizasXdifunto registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_polizasXdifunto)) {
                        $poliza_numero = $row["Polizas_De_Seguro_Numero"];
                        $difunto_cedula = $row["Difunto_cedula"];
                ?>
                        <tr>
                            <td><?php echo $poliza_numero; ?></td>
                            <td><?php echo $difunto_cedula; ?></td>
                            <td align="center">
                                <!-- El enlace para eliminar una PolizaXdifunto redirige a la vista de eliminación -->
                                <a href="?controller=PolizaXdifunto&action=DeletePolizaXdifunto&poliza_numero=<?php echo $poliza_numero; ?>&difunto_cedula=<?php echo $difunto_cedula; ?>" title="Eliminar">
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
  