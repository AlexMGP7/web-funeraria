<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();
$result_persona = $controller->ListarPersona1();
$numrows = mysqli_num_rows($result_persona);
?>

<div class="container">

    <br> <br>
    <h4>Listado de Personas registradas en el Sistema de Polizas Funerarias</h4>
    <br> <br>

    <!-- Botón Agregar -->
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?controller=Persona&action=IngresarPersona" class="btn btn-primary custom-btn">Agregar Persona</a>

    <div class="table-responsive">
        <table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Cédula</th>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Apellido</th>
                    <th class="th-sm">Ciudad</th>
                    <th class="th-sm">Modificar</th>
                    <th class="th-sm">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows != 0) {
                    while ($numrows = mysqli_fetch_array($result_persona)) {
                        $i = $numrows["cedula"];
                ?>
                        <tr>
                            <td><?php echo $numrows["cedula"]; ?></td>
                            <td><?php echo $numrows["nombre"]; ?></td>
                            <td><?php echo $numrows["apellido"]; ?></td>
                            <td><?php echo $numrows["ciudad_descripcion"]; ?></td> <!-- Use ciudad_descripcion instead of Ciudad_Codigo -->
                            <td align="center">
                                <a href="?controller=Persona&action=UpdatePersona&i=<?php echo $i; ?>" title="Modificar">
                                    <img width="50px" height="50px" src="../../imagenes/update_icon.png" alt="">
                                </a>
                            </td>
                            <td align="center">
                                <a href="?controller=Persona&action=DeletePersona&i=<?php echo $i; ?>" title="Eliminar">
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