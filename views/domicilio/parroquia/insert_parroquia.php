<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/parroquia_controller.php');
$controller = new ParroquiaController();
$result_parroquia = $controller->BuscarUltimaParroquia();
$numrows = mysqli_num_rows($result_parroquia);

?>
<div class="container-i mt-5">
    <form action="?controller=Parroquia&action=IngresarParroquia1" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Parroquias</h4>
            <div class="form-group">
                <label for="codigo_parroquia"><b>Parroquia:</b></label>
                <input class="form-control" type="text" name="codigo_parroquia" id="codigo_parroquia" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código de la parroquia" />
                <small class="form-text text-muted">Solo se permiten números.</small>
            </div>
            <div class="form-group">
                <label for="descripcion"><b>Descripción:</b></label>
                <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción de la parroquia" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="estado_codigo"><b>Estado:</b></label>
                <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                    <?php
                    $controller = new ParroquiaController();
                    $result_estados = $controller->ListarEstados();

                    while ($row_estado = mysqli_fetch_array($result_estados)) {
                        $codigo_estado = $row_estado['codigo'];
                        $descripcion_estado = $row_estado['descripcion'];
                        echo "<option value='$codigo_estado'>$codigo_estado - $descripcion_estado</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="municipio_codigo"><b>Municipio:</b></label>
                <select class="form-control" id="municipio_codigo" name="municipio_codigo">
                    <option value="">Seleccione un Municipio</option>
                </select>
            </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Función para cargar datos en los selectores según el tipo
        function loadOptions(type, id, targetSelector) {
            $.ajax({
                url: '../../models/obtener_domicilio.php',
                type: 'GET',
                data: {
                    type: type,
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var options = '<option value="">Seleccione una opción</option>';
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i]['codigo'] + '">' + data[i]['descripcion'] + '</option>';
                    }
                    $(targetSelector).html(options);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Cargar los municipios al seleccionar un estado
        $('#estado_codigo').on('change', function() {
            var estadoId = $(this).val();
            if (estadoId !== '') {
                loadOptions('municipios', estadoId, '#municipio_codigo');
            } else {
                $('#municipio_codigo').html('<option value="">Seleccione un municipio</option>');
            }
        });

    });
</script>