<?php
require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();
$result_estado = $controller->ListarEstado1();
$numrows = mysqli_num_rows($result_estado);
?>

<div class="contaniner">

    <br> <br>
    <h4> Listado de Estados registrados en el Sistema de Polizas Funerarias </h4>
    <br> <br>


    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th class="th-sm">Codigo</th>
                    <th class="th-sm">Descripcion</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>

            </thead>

            <tbody>
                <?php

                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_estado)) { ?>
                        <tr>
                            <?php
                            $i = $numrows["codigo"];
                            ?>
                            <th scope="row"><?php echo $numrows["codigo"]; ?></th>

                            <td>
                                <a title="Ver estado" href="<?php echo $numrows["url_estado"]; ?>" target="_blank"> <?php echo $numrows["descripcion"]; ?> </a>
                            </td>

                            <td align="center">
                                <?php echo "<a href='?controller=estado&action=Updateestado&i=$i' title= 'Modificar'>"; ?>
                                <img width="50px" height="50px" src="imagenes/update_icon.jpg" alt=""> </a>
                            </td>
                            <td align="center">
                                <?php echo "<a href='?controller=estado&action=Deleteestado&i=$i' title= 'Eliminar'>"; ?>
                                <img width="50px" height="50px" src="imagenes/delete_icon.jpg" alt=""> </a>
                            </td>

                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>