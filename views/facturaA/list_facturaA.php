<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/facturaA_controller.php');
$controller = new FacturaAController();
$result_facturaA = $controller->ListarFacturaA1();
$numrows = mysqli_num_rows($result_facturaA);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Facturas Anuales registradas en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=FacturaA&action=IngresarFacturaA" class="btn btn-primary custom-btn">Agregar Factura</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Número</th>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm">Monto</th>
                    <th class="th-sm">Número Póliza</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_facturaA)) {
                        $numero = $numrows["numero"];
                ?>
                        <tr>
                            <td><?php echo $numrows["numero"]; ?></td>
                            <td><?php echo $numrows["fecha"]; ?></td>
                            <td><?php echo $numrows["monto"]; ?></td>
                            <td><?php echo $numrows["numero_poliza"]; ?></td>
                            <td align="center">
                                <a href="?controller=FacturaA&action=UpdateFacturaA&numero=<?php echo $numero; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=FacturaA&action=DeleteFacturaA&numero=<?php echo $numero; ?>" title="Eliminar">
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
