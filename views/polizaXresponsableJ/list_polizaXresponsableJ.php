<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'PolizaXresponsableJController' para manejar las operaciones con los polizasXresponsableJ.
require_once('../../controllers/polizaXresponsableJ_controller.php');
$controller = new PolizaXresponsableJController();

// Obtener la lista de polizasXresponsableJ utilizando el método 'ListarPolizasXresponsableJ' del controlador.
$result_polizasXresponsableJ = $controller->ListarPolizasXResponsableJ1();

// Contar el número de filas (polizasXresponsableJ) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_polizasXresponsableJ);
?>
<div class="container">
    <br> <br>
    <h4> Listado de Pólizas de Seguro asociadas a Responsables Jurídicos registrados </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de una nueva PolizaXresponsableJ. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=PolizaXresponsableJ&action=IngresarPolizaXresponsableJ" class="btn btn-primary custom-btn">Agregar Póliza asociada a Responsable Jurídico</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Número de Póliza</th>
                    <th class="th-sm">RIF del Responsable Jurídico</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay polizasXresponsableJ registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_polizasXresponsableJ)) {
                        $poliza_numero = $row["Polizas_De_Seguro_Numero"];
                        $responsable_rif = $row["Responsable_Juridico_Rif"];
                ?>
                        <tr>
                            <td><?php echo $poliza_numero; ?></td>
                            <td><?php echo $responsable_rif; ?></td>
                            <td align="center">
                                <!-- El enlace para eliminar una PolizaXresponsableJ redirige a la vista de eliminación -->
                                <a href="?controller=PolizaXresponsableJ&action=DeletePolizaXresponsableJ&poliza_numero=<?php echo $poliza_numero; ?>&responsable_rif=<?php echo $responsable_rif; ?>" title="Eliminar">
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
