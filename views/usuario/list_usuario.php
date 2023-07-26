<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/usuario_controller.php');
$controller = new UsuarioController();
$result_usuario = $controller->ListarUsuario1();
$numrows = mysqli_num_rows($result_usuario);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Usuarios registrados en el Sistema de Polizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Usuario&action=IngresarUsuario" class="btn btn-primary custom-btn">Agregar Usuario</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Cédula</th>
                    <th class="th-sm">Nombre de Usuario</th>
                    <th class="th-sm">Teléfono</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_usuario)) {
                        $i = $numrows["cedula"];
                ?>
                        <tr>
                            <td><?php echo $numrows["cedula"]; ?></td>
                            <td><?php echo $numrows["login"]; ?></td>
                            <td><?php echo $numrows["telefono"]; ?></td>
                            <td align="center">
                                <a href="?controller=Usuario&action=UpdateUsuario&i=<?php echo $i; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=Usuario&action=DeleteUsuario&i=<?php echo $i; ?>" title="Eliminar">
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
