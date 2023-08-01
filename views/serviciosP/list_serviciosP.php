
<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'ServiciosPController' para manejar las operaciones con los servicios prestados.
require_once('../../controllers/serviciosP_controller.php');
$controller = new ServiciosPController();

// Obtener la lista de servicios prestados utilizando el método 'ListarServiciosP1' del controlador.
$result_serviciosP = $controller->ListarServiciosP1();

// Contar el número de filas (servicios prestados) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_serviciosP);
?>

<div class="container">

    <br> <br>
    <h4> Listado de Servicios Prestados registrados en el Sistema </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de un nuevo servicio prestado. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=ServiciosP&action=IngresarServiciosP" class="btn btn-primary custom-btn">Agregar Servicio Prestado</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Código</th>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Tipo</th>
                    <th class="th-sm">Monto</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay servicios prestados registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_serviciosP)) {
                        $codigo = $row["codigo"];
                ?>
                        <tr>
                            <td><?php echo $row["codigo"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["tipo"]; ?></td>
                            <td><?php echo $row["monto"]; ?></td>
                            <td align="center">
                                <!-- El enlace para modificar un servicio prestado redirige a la vista de actualización -->
                                <a href="?controller=ServiciosP&action=UpdateServiciosP&codigo=<?php echo $codigo; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <!-- El enlace para eliminar un servicio prestado redirige a la vista de eliminación -->
                                <a href="?controller=ServiciosP&action=DeleteServiciosP&codigo=<?php echo $codigo; ?>" title="Eliminar">
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
  