<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/cementerio_controller.php');
$controller = new CementerioController();
$result_cementerio = $controller->ListarCementerios1();
$numrows = mysqli_num_rows($result_cementerio);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Cementerios registrados en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Cementerio&action=IngresarCementerio" class="btn btn-primary custom-btn">Agregar Cementerio</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">RIF</th>
                    <th class="th-sm">Código</th>
                    <th class="th-sm">Tipo</th>
                    <th class="th-sm">Ciudad</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($row_cementerio = mysqli_fetch_array($result_cementerio)) {
                        $rif = $row_cementerio["rif"];
                ?>
                        <tr>
                            <td><?php echo $row_cementerio["rif"]; ?></td>
                            <td><?php echo $row_cementerio["codigo"]; ?></td>
                            <td><?php echo $row_cementerio["tipo"]; ?></td>
                            <td><?php echo $row_cementerio["ciudad_descripcion"]; ?></td> <!-- Use ciudad_descripcion instead of Ciudad_Codigo -->
                            <td align="center">
                                <a href="?controller=Cementerio&action=UpdateCementerio&i=<?php echo $rif; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=Cementerio&action=DeleteCementerio&i=<?php echo $rif; ?>" title="Eliminar">
                                    <img width="50px" height="50px" src="../imagenes/delete_icon.png" alt="">
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
