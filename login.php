<?php
// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "polizas_funerarias";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Comprobar si se ha enviado el formulario de inicio de sesión
if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Consultar la tabla de usuarios para verificar las credenciales
    $query = "SELECT * FROM usuario WHERE Login = '$login' AND Password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso";
        header('Location: index.php');
        // Realiza aquí las acciones adicionales que deseas realizar después del inicio de sesión exitoso
    } else {
        // Credenciales incorrectas
        echo "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form method="POST" action="login.php">
        <label for="login">Usuario:</label>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
