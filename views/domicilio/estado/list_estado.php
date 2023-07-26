<?php

// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'EstadoController' para manejar las operaciones con los estados.
require_once('../../controllers/estado_controller.php');
$controller = new EstadoController();

// Obtener la lista de estados utilizando el método 'ListarEstado1' del controlador.
$result_estado = $controller->ListarEstado1();

// Contar el número de filas (estados) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_estado);
?>

<div class="container">

    <br> <br>
    <h4> Listado de Estados registrados en el Sistema de Pólizas Funerarias </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de un nuevo estado. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Estado&action=IngresarEstado" class="btn btn-primary custom-btn">Agregar Estado</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Código</th>
                    <th class="th-sm">Descripción</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay estados registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_estado)) {
                        $i = $numrows["codigo"];
                ?>
                        <tr>
                            <td><?php echo $numrows["codigo"]; ?></td>
                            <td><?php echo $numrows["descripcion"]; ?></td>
                            <td align="center">
                                <!-- El enlace para modificar un estado redirige a la vista de actualización -->
                                <a href="?controller=Estado&action=UpdateEstado&i=<?php echo $i; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <!-- El enlace para eliminar un estado redirige a la vista de eliminación -->
                                <a href="?controller=Estado&action=DeleteEstado&i=<?php echo $i; ?>" title="Eliminar">
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
