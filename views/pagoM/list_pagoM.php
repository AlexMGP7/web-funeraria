<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/pagoM_controller.php');
$controller = new PagoMController();
$result_pagoM = $controller->ListarPagoM1();
$numrows = mysqli_num_rows($result_pagoM);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Pagos Mensuales registrados en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=PagoM&action=IngresarPagoM" class="btn btn-primary custom-btn">Agregar Pago</a>

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
                    while ($numrows = mysqli_fetch_array($result_pagoM)) {
                        $numero = $numrows["numero"];
                ?>
                        <tr>
                            <td><?php echo $numrows["numero"]; ?></td>
                            <td><?php echo $numrows["fecha"]; ?></td>
                            <td><?php echo $numrows["monto"]; ?></td>
                            <td><?php echo $numrows["numero_poliza"]; ?></td>
                            <td align="center">
                                <a href="?controller=PagoM&action=UpdatePagoM&numero=<?php echo $numero; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=PagoM&action=DeletePagoM&numero=<?php echo $numero; ?>" title="Eliminar">
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
