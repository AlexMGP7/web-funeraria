<?php
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio
    header('Location: index.php');
    exit;
}

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['login'])) {
    // Obtener el nombre de usuario y la contraseña del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Incluir el archivo de conexión a la base de datos
    include('core\conectar.php');

    // Consultar si el usuario existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE login = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Verificar si se ha encontrado el usuario en la base de datos
    if (mysqli_num_rows($result) > 0) {
        // Obtener los datos del usuario desde el conjunto de resultados
        $user = mysqli_fetch_assoc($result);

        // Establecer las variables de sesión del usuario
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirigir al usuario a la página de inicio
        header('Location: index.php');
        exit;
    } else {
        // El usuario no existe o la contraseña es incorrecta
        echo '<p>Usuario o contraseña inválidos.</p>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Administración de Pólizas de Seguros Funerarios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>Sistema de Administración de Pólizas de Seguros Funerarios</h1>
        <nav>
            <a href="login.php">Iniciar sesión</a>
            <a href="register.php">Registrarse</a>
        </nav>
    </header>

    <main>
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Nombre de usuario">
            <input type="password" name="password" placeholder="Contraseña">
            <input type="submit" name="login" value="Iniciar sesión">
        </form>
    </main>

    <footer>
        <p>Derechos de autor &copy; 2023 Sistema de Administración de Pólizas de Seguros Funerarios</p>
    </footer>

</body>

</html>