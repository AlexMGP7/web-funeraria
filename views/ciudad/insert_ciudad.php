<?php

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();
$result_ciudad = $controller->BuscarUltimaCiudad();
$numrows = mysqli_num_rows($result_ciudad);

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
    <div class="page-content">
        <form action="?controller=Ciudad&action=IngresarCiudad1" method="POST">
            <div class="col-12">
                <br>
                <h4>Ingreso de Ciudades</h4>
                <br>
                <div class="alert alert-success">
                    <div class="row">
                        <div class="col-6">
                            <label for="codigo_ciudad" align="right" size="40"><b>Código de la ciudad:</b></label>
                            <input class="form-control mr-sm-2" type="text" name="codigo_ciudad" id="codigo_ciudad" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese el código de la ciudad" />
                            <span class="text-black">Solo se permiten números.</span>
                            <br>
                            <label for="descripcion" align="right"><b>Descripción:</b></label>
                            <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción de la ciudad" id="descripcion" name="descripcion" rows="4" required></textarea>
                            <br>
                            <label for="estado_codigo" align="right"><b>Código del Estado:</b></label>
                            <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                                <?php
                                $controller = new CiudadController();
                                $result_estados = $controller->ListarEstados();

                                while ($row_estado = mysqli_fetch_array($result_estados)) {
                                    $codigo_estado = $row_estado['codigo'];
                                    $descripcion_estado = $row_estado['descripcion'];
                                    echo "<option value='$codigo_estado'>$codigo_estado - $descripcion_estado</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label for="municipio_codigo" align="right"><b>Código del Municipio:</b></label>
                            <select class="form-control" id="municipio_codigo" name="municipio_codigo" required>
                                <option value="">Seleccione un Municipio</option>
                            </select>
                            <br>
                            <label for="parroquia_codigo" align="right"><b>Código de la Parroquia:</b></label>
                            <select class="form-control" id="parroquia_codigo" name="parroquia_codigo" required>
                                <option value="">Seleccione una Parroquia</option>
                            </select>
                            <br>
                            <br>
                        </div>
                    </div>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
                </div>
            </div>
        </form>
    </div>
    <br>
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

        // Cargar las parroquias al seleccionar un municipio
        $('#municipio_codigo').on('change', function() {
            var municipioId = $(this).val();
            if (municipioId !== '') {
                loadOptions('parroquias', municipioId, '#parroquia_codigo');
            } else {
                $('#parroquia_codigo').html('<option value="">Seleccione una parroquia</option>');
            }
        });

    });
</script>