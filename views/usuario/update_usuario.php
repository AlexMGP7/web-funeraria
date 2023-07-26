<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $login = $_POST['login']; // Anteriormente 'login', pero lo renombramos como 'login'
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];

    require_once('../../controllers/usuario_controller.php');
    $controller = new UsuarioController();

    // Encriptar la contraseña antes de guardarla en la base de datos
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Actualizar el usuario y obtener el resultado
    $result_usuario = $controller->UpdateUsuario2($cedula, $login, $password_hashed, $telefono);

    // Verificar si la actualización fue exitosa
    if ($result_usuario) {
        $_SESSION['mensaje'] = "El usuario se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el usuario. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de usuarios después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Usuario&action=ListarUsuario";</script>';
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

if (isset($_GET['i'])) {
    $cedula = $_GET['i'];
    require_once('../../controllers/usuario_controller.php');
    $controller = new UsuarioController();
    $result_usuario = $controller->BuscarUsuarioByCedula($cedula);
    $numrows = mysqli_num_rows($result_usuario);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_usuario)) {
            // Extract data
            if (isset($row["cedula"])) {
                $cedula = $row["cedula"];
            }
            if (isset($row["login"])) {
                $login = $row["login"];
            }
            if (isset($row["password"])) {
                $password = $row["password"];
            }
            if (isset($row["telefono"])) {
                $telefono = $row["telefono"];
            }
        }
        ?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Usuario&action=UpdateUsuario" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Usuario</h4>
                        <div class="form-group">
                            <label for="cedula"><b>Cédula:</b></label>
                            <input class="form-control" type="text" name="cedula" value="<?php echo $cedula; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="login"><b>Usuario:</b></label>
                            <input class="form-control" type="text" name="login" value="<?php echo $login; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><b>Contraseña:</b></label>
                            <input class="form-control" type="password" name="password" value="<?php echo $password; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono"><b>Teléfono:</b></label>
                            <input class="form-control" type="text" name="telefono" value="<?php echo $telefono; ?>" required>
                        </div>
                        <!-- Add other fields related to Usuario table here -->

                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        // If Usuario not found, redirect to the list of usuarios
        require_once('../../views/usuario/list_usuario.php');
    }
} else {
    // If 'i' parameter not provided in the URL, redirect to the list of personas
    require_once('../../views/persona/list_persona.php');
}
?>