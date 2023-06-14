<?php
// Aquí irían las configuraciones de conexión a la base de datos y otras inicializaciones

// Incluir archivos necesarios
require_once 'core/conectar.php';
require_once 'core/funciones.php';

// Verificar si el usuario está autenticado
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Obtener los datos del usuario autenticado
$user_id = $_SESSION['user_id'];
$user = getUserById($user_id);

// Obtener las pólizas del usuario
$policies = getPoliciesByUserId($user_id);

// Aquí irían otras consultas o funciones necesarias para obtener los datos requeridos

?>

<!DOCTYPE html>
<html>
<head>
    <title>Funeral Insurance Policy Administration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Funeral Insurance Policy Administration</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="policies.php">Policies</a>
        <!-- Otros enlaces de navegación -->
    </nav>
</header>

<main>
    <h2>Welcome, <?php echo $user['name']; ?>!</h2>
    <p>Here are your policies:</p>
    <ul>
        <?php foreach ($policies as $policy) : ?>
            <li>
                <strong><?php echo $policy['policy_number']; ?></strong>
                <p>
                    Opened on <?php echo $policy['opening_date']; ?><br>
                    Closing on <?php echo $policy['closing_date']; ?><br>
                    <strong>Annual Fee:</strong> $<?php echo $policy['annual_fee']; ?><br>
                    <strong>Monthly Fee:</strong> $<?php echo $policy['monthly_fee']; ?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Otro contenido de la página -->
</main>

<footer>
    <p>Copyright &copy; <?php echo date('Y'); ?> Funeral Insurance Policy Administration</p>
</footer>

</body>
</html>
