<?php session_start(); ?>
 <!DOCTYPE html>
<html lang="es">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polizas de Seguros Funerarios</title>
     <!-- Enlaces a hojas de estilo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../../css/style_header.css">
    <link rel="stylesheet" href="../../css/style_cuadro.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
     <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
 <body>
    <?php 
    require_once('../../views/layouts/header.php'); 
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
            <?php
            // carga el archivo routing.php para direccionar a la página .php que se incrustará entre la header y el footer
            require_once('../../views/routing.php');
            ?>
        </section>
    </main>
     <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="../../script_header.js"></script>
    <script src="../../js/script_cuadro.js"></script>
    <script src="../../js/script_select.js"></script>
    <script src="../../js/script_select_dinamico.js"></script>
</body>
 </html>