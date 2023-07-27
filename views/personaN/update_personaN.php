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
    $telefono = $_POST['telefono'];

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
                            <input class="form-control" type="text" name="telefono" value="<?php echo $telefono; ?>" required>
                            <small class="form-text text-muted">Solo se permiten números.</small>
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
