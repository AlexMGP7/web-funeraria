<?php

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
                    $message = 'Successfully created new user';
                } else {
                    // Display the error message and details if an exception occurs
                    $errorInfo = $stmt->errorInfo();
                    $message = 'Sorry, there must have been an issue creating your account: ' . $errorInfo[2];
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
        <input name="cedula" type="text" placeholder="Ingresa la cédula de una persona registrada">
        <!-- <input name="id" type="text" placeholder="Ingresa tu numero de identificacion"> -->
        <input name="telefono" type="text" placeholder="Ingresa tu teléfono">
        <input name="login" type="text" placeholder="Ingresa tu username">
        <input name="password" type="password" placeholder="Ingresa tu contraseña">
        <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">
        <input type="submit" value="Submit">
    </form>

</body>

</html>