<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polizas de Seguros Funerarios</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Incluye las bibliotecas de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- Estilos CSS personalizados -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style_header.css">
    <link rel="stylesheet" href="style_cuadro.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>

    <?php require_once('../../views/layouts/header.php'); ?>

    <?php

    if (isset($_SESSION['mensaje']) && isset($_SESSION['mensaje_tipo'])) {
        $mensaje = $_SESSION['mensaje'];
        $mensaje_tipo = $_SESSION['mensaje_tipo'];
        unset($_SESSION['mensaje']);
        unset($_SESSION['mensaje_tipo']);
    ?>

        <div class="fixed-alert">
            <div class="alert alert-<?php echo $mensaje_tipo; ?>">
                <?php echo $mensaje; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

    <?php
    }
    ?>

    <main class="main">

        <section>
            <div class="container">
                <?php
                // carga el archivo routing.php para direccionar a la página .php que se incrustará entre la header y el footer
                require_once('../../views/routing.php');
                ?>
            </div>
        </section>

    </main>

    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="script_header.js"></script>
    <script src="script_cuadro.js"></script>
</body>

</body>

</html>