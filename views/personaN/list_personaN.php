<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/personaNatural_controller.php');
$controller = new PersonaNaturalController();
$result_personan = $controller->ListarPersonaN1();
$numrows = mysqli_num_rows($result_personan);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Personas Naturales registradas</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=PersonaNatural&action=IngresarPersonaN" class="btn btn-primary custom-btn">Agregar Persona Natural</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Cédula</th>
                    <th class="th-sm">Correo</th>
                    <th class="th-sm">Teléfono</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_personan)) {
                        $cedula = $row["cedula"];
                ?>
                        <tr>
                            <td><?php echo $cedula; ?></td>
                            <td><?php echo $row["correo"]; ?></td>
                            <td><?php echo $row["telefono"]; ?></td>
                            <td align="center">
                                <a href="?controller=PersonaNatural&action=UpdatePersonaN&cedula=<?php echo $cedula; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=PersonaNatural&action=DeletePersonaN&cedula=<?php echo $cedula; ?>" title="Eliminar">
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
