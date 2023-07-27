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

    // Insertar la persona natural y obtener el resultado
    $result_personan = $controller->IngresarPersonaN2($cedula, $correo, $telefono);

    // Verificar si el insert fue exitoso
    if ($result_personan) {
        $_SESSION['mensaje'] = "La persona natural se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la persona natural. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de personas naturales después de intentar insertar.
    echo '<script>window.location.href = "?controller=PersonaNatural&action=ListarPersonaN";</script>';
    exit();
}

require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();
$result_persona = $controller->BuscarUltimaPersona();
$numrows = mysqli_num_rows($result_persona);
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=PersonaNatural&action=IngresarPersonaN" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Personas Naturales</h4>
                <div class="form-group">
                    <label for="cedula"><b>Cédula:</b></label>
                    <select class="form-control" name="cedula" id="cedula" required>
                        <?php
                        $controller = new PersonaNaturalController();
                        $result_persona = $controller->ListarPersonas();

                        while ($row_persona = mysqli_fetch_array($result_persona)) {
                            $cedula = $row_persona['cedula'];
                            $nombre = $row_persona['nombre'];
                            echo "<option value='$cedula'>$cedula - $nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="correo"><b>Correo:</b></label>
                    <input class="form-control" type="email" name="correo" id="correo" maxlength="50" required placeholder="Ingrese aquí el correo electrónico" />
                </div>
                <div class="form-group">
                    <label for="telefono"><b>Teléfono:</b></label>
                    <input class="form-control" type="text" name="telefono" id="telefono" pattern="[0-9]+" maxlength="15" required placeholder="Ingrese aquí el teléfono" />
                    <small class="form-text text-muted">Solo se permiten números.</small>
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>
