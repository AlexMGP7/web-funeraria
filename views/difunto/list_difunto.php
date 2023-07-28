<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/difunto_controller.php');
$controller = new DifuntoController();
$result_difunto = $controller->ListarDifuntos1();
$numrows = mysqli_num_rows($result_difunto);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Difuntos registrados en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Difunto&action=IngresarDifunto" class="btn btn-primary custom-btn">Agregar Difunto</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Cédula</th>
                    <th class="th-sm">Fecha de N</th>
                    <th class="th-sm">Fecha de D</th>
                    <th class="th-sm">P de Nacimiento</th>
                    <th class="th-sm">Causa de Muerte</th>
                    <th class="th-sm">RIF Cementerio</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($row_difunto = mysqli_fetch_array($result_difunto)) {
                        $cedula = $row_difunto["cedula"];
                ?>
                        <tr>
                            <td><?php echo $row_difunto["cedula"]; ?></td>
                            <td><?php echo $row_difunto["Fecha de N."]; ?></td>
                            <td><?php echo $row_difunto["Fecha de D."]; ?></td>
                            <td><?php echo $row_difunto["Partida de N."]; ?></td>
                            <td><?php echo $row_difunto["Causa de M."]; ?></td>
                            <td><?php echo $row_difunto["Cementerio_Rif"]; ?></td>
                            <td align="center">
                                <a href="?controller=Difunto&action=UpdateDifunto&i=<?php echo $cedula; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=Difunto&action=DeleteDifunto&i=<?php echo $cedula; ?>" title="Eliminar">
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
