<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="vewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="formulario">
        <h1>Inicio de sesión</h1>
        <form method="post">
            <div class="username">
                <input type="text" required>
                <label>Nombre de usuario</label>
            </div>
            <div class="contrasena">
                <input type="password" required>
                <label>Contraseña</label>
            </div>
            <div class="recordar">Olvidé mi contraseña</div>
            <input type="submit" value="Iniciar">
            <div class="registrarse">
                No tengo cuenta: <a href="#">Registrarme</a>
            </div>

        </form>
    </div>
</body>

</html>