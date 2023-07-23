$(document).ready(function() {
    $('#dtBasicExample').DataTable({
        "lengthMenu": [5, 10, 15, 30],
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