<?php
require_once('../../controllers/municipio_controller.php');
$controller = new MunicipioController();
$result_municipio = $controller->ListarMunicipio1();
$numrows = mysqli_num_rows($result_municipio);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Municipios registrados en el Sistema de Pólizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Municipio&action=IngresarMunicipio" class="btn btn-primary custom-btn">Agregar Municipio</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Código</th>
                    <th class="th-sm">Descripción</th>
                    <th class="th-sm">Estado</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_municipio)) {
                        $i = $numrows["codigo"];
                ?>
                        <tr>
                            <td><?php echo $numrows["codigo"]; ?></td>
                            <td><?php echo $numrows["descripcion"]; ?></td>
                            <td><?php echo $numrows["estado_descripcion"]; ?></td>
                            <td align="center">
                                <a href="?controller=Municipio&action=UpdateMunicipio&i=<?php echo $i; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=Municipio&action=DeleteMunicipio&i=<?php echo $i; ?>" title="Eliminar">
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