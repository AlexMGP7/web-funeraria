<?php
session_start();

require 'config/database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, login, password FROM Usuario WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Polizas Funerarias</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style_index.css">
</head>

<body>

    <?php if (!empty($user)) : ?>
        <div class="container">
            <h1>Bienvenido, <?= $user['login']; ?></h1>
            <p>Tu sesión inició correctamente</p>
            <a href="php-login/logout.php">Cerrar sesión</a>
            <a href="views/layouts/layout.php?controller=Estado&action=ListarEstado">Ir a Pólizas</a>
        </div>
    <?php else : ?>
        <div class="container">
            <h1>Logeate o Registrate</h1>
            <a href="php-login/login.php">Login</a> /
            <a href="php-login/signup.php">Registrar</a>
        </div>
    <?php endif; ?>
</body>

</html>
