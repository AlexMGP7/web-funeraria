<?php

// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: login.php');
}

// Include the database connection file
include('core\conectar.php');

// Get the user data from the database
$user_data = mysqli_query($db, "SELECT * FROM usuarios WHERE id = $_SESSION[user_id]");

// Check if the user data is returned
if (mysqli_num_rows($user_data) > 0) {
    // Get the user data from the result set
    $user = mysqli_fetch_assoc($user_data);
} else {
    // Redirect the user to the home page
    header('Location: index.php');
}

// Get the policies data from the database
$policies_data = mysqli_query($db, "SELECT * FROM policies");

// Check if the policies data is returned
if (mysqli_num_rows($policies_data) > 0) {
    // Get the policies data from the result set
    $policies = mysqli_fetch_all($policies_data, MYSQLI_ASSOC);
} else {
    // There are no policies
}

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
        <a href="policies.php">Policies</h3>
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
                    Opened on <?php echo $policy['opening_date']; ?>
                    Closing on <?php echo $policy['closing_date']; ?>
                    <strong>Annual Fee:</strong> $<?php echo $policy['annual_fee']; ?>
                    <strong>Monthly Fee:</strong> $<?php echo $policy['monthly_fee']; ?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<footer>
    <p>Copyright &copy; 2023 Funeral Insurance Policy Administration</p>
</footer>

</body>
</html>
