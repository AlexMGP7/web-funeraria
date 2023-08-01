<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'ServiciosXFunerariaController' para manejar las operaciones con los serviciosXfuneraria.
require_once('../../controllers/serviciosXfuneraria_controller.php');
$controller = new ServiciosXFunerariaController();

// Obtener la lista de serviciosXfuneraria utilizando el método 'ListarServiciosXFuneraria1' del controlador.
$result_serviciosXfuneraria = $controller->ListarServiciosXFuneraria1();

// Contar el número de filas (serviciosXfuneraria) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_serviciosXfuneraria);
?>

<div class="container">

    <br> <br>
    <h4> Listado de Servicios de Funerarias registrados en el Sistema </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de un nuevo servicioXfuneraria. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=ServiciosXfuneraria&action=IngresarServiciosXfuneraria" class="btn btn-primary custom-btn">Agregar Servicio de Funeraria</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Funeraria Rif</th>
                    <th class="th-sm">Servicios Prestados Codigo</th>
                    <!-- <th class="th-sm">Modificar</th> -->
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay serviciosXfuneraria registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_serviciosXfuneraria)) {
                        $funeraria_rif = $row["Funeraria_Rif"];
                        $servicios_prestados_codigo = $row["Servicios_Prestados_Codigo"];
                ?>
                        <tr>
                            <td><?php echo $funeraria_rif; ?></td>
                            <td><?php echo $servicios_prestados_codigo; ?></td>
                            <!-- <td align="center">
                                <a href="?controller=ServiciosXFuneraria&action=UpdateServiciosXfuneraria&funeraria_rif=<?php echo $funeraria_rif; ?>&servicios_prestados_codigo=<?php echo $servicios_prestados_codigo; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td> -->
                            <td align="center">
                                <!-- El enlace para eliminar un servicioXfuneraria redirige a la vista de eliminación -->
                                <a href="?controller=ServiciosXfuneraria&action=DeleteServiciosXfuneraria&funeraria_rif=<?php echo $funeraria_rif; ?>&servicios_prestados_codigo=<?php echo $servicios_prestados_codigo; ?>" title="Eliminar">
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
  