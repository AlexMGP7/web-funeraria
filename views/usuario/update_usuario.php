<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudadCodigo = $_POST['ciudad_codigo'];

    require_once('../../controllers/persona_controller.php');
    $controller = new PersonaController();

    // Actualizar la persona y obtener el resultado
    $result_persona = $controller->UpdatePersona2($cedula, $nombre, $apellido, $ciudadCodigo);

    // Verificar si la actualización fue exitosa
    if ($result_persona) {
        $_SESSION['mensaje'] = "La persona se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la persona. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de personas después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Persona&action=ListarPersona";</script>';
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

if (isset($_GET['i'])) {
    $cedula = $_GET['i'];
    require_once('../../controllers/persona_controller.php');
    $controller = new PersonaController();
    $result_persona = $controller->BuscarPersonaByCedula($cedula);
    $numrows = mysqli_num_rows($result_persona);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_persona)) {
            // Extract data
            if (isset($row["cedula"])) {
                $cedula = $row["cedula"];
            }
            if (isset($row["nombre"])) {
                $nombre = $row["nombre"];
            }
            if (isset($row["apellido"])) {
                $apellido = $row["apellido"];
            }
            if (isset($row["Ciudad_Codigo"])) {
                $ciudad_codigo = $row["Ciudad_Codigo"];
            }
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Persona&action=UpdatePersona" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Persona</h4>
                        <div class="form-group">
                            <label for="cedula"><b>Cédula:</b></label>
                            <input class="form-control" type="text" name="cedula" value="<?php echo $cedula; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombre"><b>Nombre:</b></label>
                            <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido"><b>Apellido:</b></label>
                            <input class="form-control" type="text" name="apellido" value="<?php echo $apellido; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ciudad_codigo"><b>Ciudad Código:</b></label>
                            <select class="form-control" name="ciudad_codigo" id="ciudad_codigo" required>
                                <?php
                                $controller = new PersonaController();
                                $result_ciudad = $controller->ListarCiudades();

                                while ($row_ciudad = mysqli_fetch_array($result_ciudad)) {
                                    $codigo_ciudad = $row_ciudad['codigo'];
                                    $descripcion_ciudad = $row_ciudad['descripcion'];
                                    echo "<option value='$codigo_ciudad'>$codigo_ciudad - $descripcion_ciudad</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Add other fields related to Persona table here -->

                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        // If Persona not found, redirect to the list of personas
        require_once('../../views/persona/list_persona.php');
    }
} else {
    // If 'i' parameter not provided in the URL, redirect to the list of personas
    require_once('../../views/persona/list_persona.php');
}
?>