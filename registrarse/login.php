<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="vewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link rel="stylesheet" href="registy.css">
</head>
<body>
    <div class="formulario">		  
        <h1>Registrarse</h1>
        <form method="post">
        <div class="identificacion">
                <input type="text" required>
                <label>Número de identificacion</label>
            </div>
            <div class="cedula">
                <input type="text" required>
                <label>Cédula de identidad</label>
            </div>
            <div class="nombre">
                <input type="text" required>
                <label>Nombre</label>
            </div>
            <div class="apellido">
                <input type="text" required>
                <label>Apellido</label>
            </div>
            <div class="direccion">
                <input type="text" required>
                <label>Dirección</label>
            </div>
            <div class="telefono">
                <input type="text" required>
                <label>Teléfono</label>
            </div>
            <div class="contrasena">
                <input type="password" required>
                <label>Contraseña</label>
            </div>

            <input type="submit" value="Guardar">
            
        </form>
    </div>    
</body>
</html>