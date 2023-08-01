<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'PolizasXservicioPController' para manejar las operaciones con los polizasXservicioP.
require_once('../../controllers/polizaXserviciosP_controller.php');
$controller = new PolizasXservicioPController();

// Obtener la lista de polizasXservicioP utilizando el método 'ListarPolizasXservicioP1' del controlador.
$result_polizasXservicioP = $controller->ListarPolizasXservicioP1();

// Contar el número de filas (polizasXservicioP) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_polizasXservicioP);
?>

<div class="container">

    <br> <br>
    <h4> Listado de Polizas de Seguro asociados a Servicios Prestados registrados </h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de un nuevo polizaXservicioP. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=PolizaXserviciosP&action=IngresarPolizaXserviciosP" class="btn btn-primary custom-btn">Agregar Poliza asociada a Servicio Prestado</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Número de Póliza</th>
                    <th class="th-sm">Código de Servicio Prestado</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay polizasXservicioP registrados, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_polizasXservicioP)) {
                        $poliza_numero = $row["Polizas_De_Seguro_Numero"];
                        $servicios_prestados_codigo = $row["Servicios_Prestados_Codigo"];
                ?>
                        <tr>
                            <td><?php echo $poliza_numero; ?></td>
                            <td><?php echo $servicios_prestados_codigo; ?></td>
                            <td align="center">
                                <!-- El enlace para eliminar un polizaXservicioP redirige a la vista de eliminación -->
                                <a href="?controller=PolizaXserviciosP&action=DeletePolizaXserviciosP&poliza_numero=<?php echo $poliza_numero; ?>&servicios_prestados_codigo=<?php echo $servicios_prestados_codigo; ?>" title="Eliminar">
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
  