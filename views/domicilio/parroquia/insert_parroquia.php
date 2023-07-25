<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/parroquia_controller.php');
$controller = new ParroquiaController();
$result_parroquia = $controller->BuscarUltimaParroquia();
$numrows = mysqli_num_rows($result_parroquia);

?>
<div class="container">
    <form action="?controller=Parroquia&action=IngresarParroquia1" method="POST">
        <br>
        <h4>Ingreso de Parroquias</h4>
        <br>
        <div class="alert alert-success">
            <label for="codigo_parroquia" align="right" size="40"><b>Parroquia:</b></label>
            <input class="form-control mr-sm-2" type="text" name="codigo_parroquia" id="codigo_parroquia" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aqui el código de la parroquia" />
            <span class="text-black">Solo se permiten números.</span>
            <br>
            <label for="descripcion" align="right"><b>Descripción:</b></label>
            <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción de la parroquia" id="descripcion" name="descripcion" required></textarea>
            <br>

            <label for="estado_codigo" align="right"><b>Estado:</b></label>
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
            <br>
            <label for="municipio_codigo" align="right"><b>Municipio:</b></label>
            <select class="form-control" id="municipio_codigo" name="municipio_codigo">
                <option value="">Seleccione un Municipio</option>
            </select>
            <br>
            <br>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
        </div>
    </form>
</div>
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