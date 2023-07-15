<?php
session_start();

if (isset($_SESSION['mensaje']) && isset($_SESSION['mensaje_tipo'])) {
    $mensaje = $_SESSION['mensaje'];
    $mensaje_tipo = $_SESSION['mensaje_tipo'];
    unset($_SESSION['mensaje']);
    unset($_SESSION['mensaje_tipo']);
?>

    <div class="alert alert-<?php echo $mensaje_tipo; ?>">
        <?php echo $mensaje; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polizas de Seguros Funerarios</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos CSS personalizados -->
    <link rel="stylesheet" href="../../public/css/style.css">
    <!-- Incluye las bibliotecas de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

</head>

<body>
    <header>
        <?php require('../../views/layouts/header.php'); ?>
    </header>

    <section>
        <div class="container">
            <?php require_once('../../views/submenu.php'); ?>
            <?php
            // carga el archivo routing.php para direccionar a la página .php que se incrustará entre la header y el footer
            require_once('../../views/routing.php');
            ?>
        </div>
    </section>

    <footer>
        <?php require('../../views/layouts/footer.php'); ?>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable({
                "lengthMenu": [10, 15, 20],
                "language": {
                    "sEmptyTable": "No se encontraron resultados",
                    "sInfo": "Mostrando _START_ - _END_ de _TOTAL_ resultados",
                    "sInfoEmpty": "Mostrando 0 resultados",
                    "sInfoFiltered": "(filtrado de _MAX_ total de resultados)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "Mostrar _MENU_ resultados",
                    "sLoadingRecords": "Cargando...",
                    "sProcessing": "Procesando...",
                    "sSearch": "Buscar:",
                    "sZeroRecords": "No se encontraron resultados",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>

</body>

</html>