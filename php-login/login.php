<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require 'partials/header.php' ?>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
        <input name="login" type="text" placeholder="Enter your username">
        <input name="password" type="password" placeholder="Enter your Password">
        <input type="submit" value="Submit">
    </form>
</body>

</html>