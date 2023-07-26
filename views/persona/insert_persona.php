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

    // Insertar la persona y obtener el resultado
    $result_persona = $controller->IngresarPersona2($cedula, $nombre, $apellido, $ciudadCodigo);

    // Verificar si el insert fue exitoso
    if ($result_persona) {
        $_SESSION['mensaje'] = "La persona se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la persona. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de personas después de intentar insertar.
    echo '<script>window.location.href = "?controller=Persona&action=ListarPersona";</script>';
    exit();
}

require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();
$result_persona = $controller->BuscarUltimaPersona();
$numrows = mysqli_num_rows($result_persona);
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Persona&action=IngresarPersona" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Personas</h4>
                <div class="form-group">
                    <label for="cedula"><b>Cédula:</b></label>
                    <input class="form-control" type="text" name="cedula" id="cedula" pattern="[0-9]+" maxlength="10" required placeholder="Ingrese aquí la cédula de la Persona" />
                    <small class="form-text text-muted">Solo se permiten números.</small>
                </div>
                <div class="form-group">
                    <label for="nombre"><b>Nombre:</b></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" maxlength="50" required placeholder="Ingrese aquí el nombre de la Persona" />
                </div>
                <div class="form-group">
                    <label for="apellido"><b>Apellido:</b></label>
                    <input class="form-control" type="text" name="apellido" id="apellido" maxlength="50" required placeholder="Ingrese aquí el apellido de la Persona" />
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
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>