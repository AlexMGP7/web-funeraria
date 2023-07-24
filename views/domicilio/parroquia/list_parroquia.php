<?php
require_once('../../controllers/parroquia_controller.php');
$controller = new ParroquiaController();
$result_parroquia = $controller->ListarParroquia1();
$numrows = mysqli_num_rows($result_parroquia);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Parroquias registradas en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Parroquia&action=IngresarParroquia" class="btn btn-primary custom-btn">Agregar Parroquia</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Código</th>
                    <th class="th-sm">Descripción</th>
                    <th class="th-sm">Municipio</th>
                    <th class="th-sm">Estado</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_parroquia)) {
                        $i = $numrows["codigo"];
                ?>
                        <tr>
                            <td><?php echo $numrows["codigo"]; ?></td>
                            <td><?php echo $numrows["descripcion"]; ?></td>
                            <td><?php echo $numrows["municipio_descripcion"]; ?></td>
                            <td><?php echo $numrows["estado_descripcion"]; ?></td>
                            <td align="center">
                                <a href="?controller=Parroquia&action=UpdateParroquia&i=<?php echo $i; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=Parroquia&action=DeleteParroquia&i=<?php echo $i; ?>" title="Eliminar">
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