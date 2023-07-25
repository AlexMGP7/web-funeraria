<?php

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

require '../config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = '';

if (!empty($_POST['cedula']) && !empty($_POST['telefono']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
    // Check if the password and confirm_password fields match
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $message = 'Password and Confirm Password do not match.';
    } else {
        try {
            // Check if the person with the provided cédula exists
            $sql_check_person = "SELECT cedula FROM persona WHERE cedula = :cedula";
            $stmt_check_person = $conn->prepare($sql_check_person);
            $stmt_check_person->bindParam(':cedula', $_POST['cedula']);
            $stmt_check_person->execute();

            $person = $stmt_check_person->fetch(PDO::FETCH_ASSOC);

            if (!$person) {
                $message = 'The person with the provided cédula does not exist. Please register the person first.';
            } else {
                // Perform the signup process without specifying the 'id' column
                $sql = "INSERT INTO Usuario (cedula, telefono, login, password) VALUES (:cedula, :telefono, :login, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cedula', $_POST['cedula']);
                $stmt->bindParam(':telefono', $_POST['telefono']);
                $stmt->bindParam(':login', $_POST['login']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $password);

                if ($stmt->execute()) {
                    $message = 'Se ha creado al usuario correctamente, puede logearse';
                } else {
                    // Display the error message and details if an exception occurs
                    $errorInfo = $stmt->errorInfo();
                    $message = 'Lo siento, debió ocurrir un error al crear tu cuenta: ' . $errorInfo[2];
                }
            }
        } catch (PDOException $e) {
            // Display the exception message if an error occurs during database operations
            $message = 'PDOException: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrar Usuario</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_signup.css">
</head>

<body>
    <?php if (!empty($message)) : ?>
        <div class="message">
            <p><?= $message ?></p>
        </div>
    <?php endif; ?>

    <div class="formulario">
        <h1>Registrarse</h1>
        <form action="index.php" method="POST">
            <div class="input-field cedula">
                <input name="cedula" type="text" required pattern="\d+">
                <label class="input-label">Cédula de identidad (Sin puntos)</label>
            </div>

            <div class="input-field telefono">
                <input name="telefono" type="text" required pattern="^\d{4}-\d{7}$">
                <label>Teléfono (04xx-xxxxxxx)</label>
            </div>

            <div class="input-field nombre">
                <input name="login" type="text" required>
                <label>Nombre de usuario</label>
            </div>

            <div class="input-field contrasena">
                <input name="password" type="password" required>
                <label>Contraseña</label>
            </div>

            <div class="input-field contrasena">
                <input name="confirm_password" type="password" required>
                <label>Confirma tu contraseña</label>
            </div>

            <input type="submit" value="Guardar">
        </form>

        <div class="links">
            <a href="../views/layouts/layout.php?controller=Persona&action=IngresarPersona">Registrar Persona</a>
            <span>/</span>
            <a href="login.php">Iniciar Sesión</a>
        </div>
    </div>

</body>

</html>