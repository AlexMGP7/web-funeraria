<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $correo = $_POST['correo'];

    // Unir el código de área seleccionado con el resto del teléfono
    $codigo_telefono = $_POST['codigo_telefono'];
    $telefono_resto = $_POST['telefono'];
    $telefono = $codigo_telefono . $telefono_resto;

    require_once('../../controllers/personaNatural_controller.php');
    $controller = new PersonaNaturalController();

    // Actualizar la persona natural y obtener el resultado
    $result_personan = $controller->UpdatePersonaN2($cedula, $correo, $telefono);

    // Verificar si la actualización fue exitosa
    if ($result_personan) {
        $_SESSION['mensaje'] = "La persona natural se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la persona natural. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de personas naturales después de intentar actualizar.
    echo '<script>window.location.href = "?controller=PersonaNatural&action=ListarPersonaN";</script>';
    exit();
}

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];
    require_once('../../controllers/personaNatural_controller.php');
    $controller = new PersonaNaturalController();
    $result_personan = $controller->BuscarPersonaNByCedula($cedula);
    $numrows = mysqli_num_rows($result_personan);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_personan)) {
            // Extract data
            if (isset($row["cedula"])) {
                $cedula = $row["cedula"];
            }
            if (isset($row["correo"])) {
                $correo = $row["correo"];
            }
            if (isset($row["telefono"])) {
                $telefono = $row["telefono"];
                // Extract the area code and the rest of the phone number
                $codigo_telefono = substr($telefono, 0, 4); // Extract the first 4 characters (area code)
                $telefono_resto = substr($telefono, 4); // Extract the rest of the characters (phone number)
            }
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=PersonaNatural&action=UpdatePersonaN" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Persona Natural</h4>
                        <div class="form-group">
                            <label for="cedula"><b>Cédula:</b></label>
                            <input class="form-control" type="text" name="cedula" value="<?php echo $cedula; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="correo"><b>Correo:</b></label>
                            <input class="form-control" type="email" name="correo" value="<?php echo $correo; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono"><b>Teléfono:</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control" name="codigo_telefono" id="codigo_telefono" required>
                                        <option value="0414" <?php if ($codigo_telefono === "0414") echo "selected"; ?>>0414</option>
                                        <option value="0424" <?php if ($codigo_telefono === "0424") echo "selected"; ?>>0424</option>
                                        <option value="0416" <?php if ($codigo_telefono === "0416") echo "selected"; ?>>0416</option>
                                        <option value="0426" <?php if ($codigo_telefono === "0426") echo "selected"; ?>>0426</option>
                                        <option value="0412" <?php if ($codigo_telefono === "0412") echo "selected"; ?>>0412</option>
                                    </select>
                                </div>
                                <input class="form-control" type="text" name="telefono" id="telefono" pattern="[0-9]{7}" maxlength="7" required placeholder="Ingrese aquí el resto del número" value="<?php echo $telefono_resto; ?>" />
                            </div>
                            <small class="form-text text-muted">Formato válido: seleccione el código de área y luego ingrese el resto del número (7 dígitos).</small>
                        </div>
                        <!-- Add other fields related to PersonaNatural table here -->

                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        // If PersonaNatural not found, redirect to the list of personas naturales
        require_once('../../views/persona_natural/list_personan.php');
    }
} else {
    // If 'cedula' parameter not provided in the URL, redirect to the list of personas naturales
    require_once('../../views/persona_natural/list_personan.php');
}
?>
