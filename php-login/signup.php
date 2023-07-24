<?php

require '../config/database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Successfully created new user';
    } else {
        $message = 'Sorry there must have been an issue creating your account';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrar Usuario</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php require 'partials/header.php' ?>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <span> <a href="../views/layouts/layout.php?controller=Persona&action=IngresarPersona">Registrar Persona</a></span> /<span> </span> <span><a href="login.php">Iniciar Sesión</a></span>

    <form action="signup.php" method="POST">
        <input name="id" type="text" placeholder="Ingresa la cedula existente">
        <input name="id" type="text" placeholder="Ingresa tu numero de identificacion">
        <input name="id" type="text" placeholder="Ingresa tu username">
        <input name="password" type="password" placeholder="Ingresa tu contraseña">
        <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">
        <input type="submit" value="Submit">
    </form>

</body>

</html>