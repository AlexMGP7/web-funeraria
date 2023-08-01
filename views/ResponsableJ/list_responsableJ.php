<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/responsableJ_controller.php');
$controller = new ResponsableJuridicoController();
$result_responsable_juridico = $controller->ListarResponsableJ1();
$numrows = mysqli_num_rows($result_responsable_juridico);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Responsables Jurídicos registrados en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=ResponsableJ&action=IngresarResponsableJ" class="btn btn-primary custom-btn">Agregar Responsable Jurídico</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">RIF</th>
                    <th class="th-sm">Correo</th>
                    <th class="th-sm">Telefono</th>
                    <th class="th-sm">Razon S</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_responsable_juridico)) {
                        $i = $numrows["rif"];
                ?>
                        <tr>
                            <td><?php echo $numrows["rif"]; ?></td>
                            <td><?php echo $numrows["correo"]; ?></td>
                            <td><?php echo $numrows["telefono"]; ?></td>
                            <td><?php echo $numrows["razon_s"]; ?></td>
                            <td align="center">
                                <a href="?controller=ResponsableJuridico&action=UpdateResponsableJ&i=<?php echo $i; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=ResponsableJuridico&action=DeleteResponsableJ&i=<?php echo $i; ?>" title="Eliminar">
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
  