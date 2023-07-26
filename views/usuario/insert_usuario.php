<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $username = $_POST['username']; // Anteriormente 'login', pero lo renombramos como 'username'
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];

    require_once('../../controllers/usuario_controller.php');
    $controller = new UsuarioController();

    // Insertar el usuario y obtener el resultado
    $result_usuario = $controller->IngresarUsuario2($cedula, $username, $password, $telefono);

    // Verificar si el insert fue exitoso
    if ($result_usuario) {
        $_SESSION['mensaje'] = "El usuario se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar el usuario. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de usuarios después de intentar insertar.
    echo '<script>window.location.href = "?controller=Usuario&action=ListarUsuario";</script>';
    exit();
}

require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();
$result_persona = $controller->BuscarUltimaPersona();
$numrows = mysqli_num_rows($result_persona);
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Usuario&action=IngresarUsuario" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Usuarios</h4>
                <div class="form-group">
                    <label for="cedula"><b>Cédula:</b></label>
                    <input class="form-control" type="text" name="cedula" id="cedula" pattern="[0-9]+" maxlength="10" required placeholder="Ingrese aquí la cédula del Usuario" />
                    <small class="form-text text-muted">Solo se permiten números.</small>
                </div>
                <div class="form-group">
                    <label for="username"><b>Usuario:</b></label>
                    <input class="form-control" type="text" name="username" id="username" maxlength="50" required placeholder="Ingrese aquí el nombre de usuario" />
                </div>
                <div class="form-group">
                    <label for="password"><b>Contraseña:</b></label>
                    <input class="form-control" type="password" name="password" id="password" maxlength="50" required placeholder="Ingrese aquí la contraseña" />
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
