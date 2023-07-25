<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

require '../config/database.php';

// ... rest of the code ...

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, login, password FROM Usuario WHERE login = :login');
    $records->bindParam(':login', $_POST['login']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    // var_dump($results); 
    // Check if $results is an array before accessing its elements
    if (is_array($results) && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: ../index.php");
        $message = 'Se inicio la sesion correctamente';
    } else {
        $message = 'Sorry, those credentials do not match';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style_login.css">
</head>

<body>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="formulario">
    <h1>Inicio de sesión</h1>
    <form action="login.php" method="POST">
        <div class="username">
            <input name="login" type="text" autocomplete="off" required>
            <label>Nombre de usuario</label>
        </div>
        <div class="contrasena">
            <input name="password" type="password" autocomplete="off" required>
        </div>
        <input type="submit" value="Iniciar">
        <div class="registrarse">
            No tengo cuenta: <a href="signup.php">Registrarme</a>
        </div>
        <i>Si olvidaste tu contraseña, <a href="contacto.php">ponte en contacto</a> con los administradores</i>
    </form>
</div>
</body>
</html>