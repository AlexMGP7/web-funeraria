<?php
// Verificar si el usuario ha iniciado sesión. Si no, redirigir al índice (login) del sistema.
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

// Incluir el controlador 'PolizasController' para manejar las operaciones con las pólizas.
require_once('../../controllers/polizas_controller.php');
$controller = new PolizasController();

// Obtener la lista de pólizas utilizando el método 'ListarPolizas1' del controlador.
$result_polizas = $controller->ListarPolizas1();

// Contar el número de filas (pólizas) obtenidos de la consulta.
$numrows = mysqli_num_rows($result_polizas);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Pólizas de Seguro registradas en el Sistema</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <!-- El botón Agregar redirige a la vista de inserción de una nueva póliza. -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Polizas&action=IngresarPolizas" class="btn btn-primary custom-btn">Agregar Póliza</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='5' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Número</th>
                    <th class="th-sm">Fecha Apertura</th>
                    <th class="th-sm">Fecha Cierre</th>
                    <th class="th-sm">Cuota Anual</th>
                    <th class="th-sm">Cuota Mensual</th>
                    <th class="th-sm">Observaciones</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Si hay pólizas registradas, se muestran en la tabla.
                if ($numrows != 0) {
                    while ($row = mysqli_fetch_array($result_polizas)) {
                        $numero = $row["Numero"];
                ?>
                        <tr>
                            <td><?php echo $row["Numero"]; ?></td>
                            <td><?php echo $row["fecha_apertura"]; ?></td>
                            <td><?php echo $row["fecha_cierre"]; ?></td>
                            <td><?php echo $row["cuota_anual"]; ?></td>
                            <td><?php echo $row["cuota_mensual"]; ?></td>
                            <td><?php echo $row["observaciones"]; ?></td>
                            <td align="center">
                                <!-- El enlace para modificar una póliza redirige a la vista de actualización -->
                                <a href="?controller=Polizas&action=UpdatePolizas&numero=<?php echo $numero; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <!-- El enlace para eliminar una póliza redirige a la vista de eliminación -->
                                <a href="?controller=Polizas&action=DeletePolizas&numero=<?php echo $numero; ?>" title="Eliminar">
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
  