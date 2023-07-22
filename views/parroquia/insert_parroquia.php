<?php

require_once('../../controllers/parroquia_controller.php');
$controller = new ParroquiaController();
$result_parroquia = $controller->BuscarUltimaParroquia();
$numrows = mysqli_num_rows($result_parroquia);

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
    <div class="page-content">
        <form action="?controller=Parroquia&action=IngresarParroquia1" method="POST">
            <div class="col-12">
                <br>
                <h4>Ingreso de Parroquias</h4>
                <br>
                <div class="alert alert-success">
                    <div class="row">
                        <div class="col-6">
                            <label for="codigo_parroquia" align="right" size="40"><b>Codigo de la parroquia:</b></label>
                            <input class="form-control mr-sm-2" type="text" name="codigo_parroquia" id="codigo_parroquia" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese el código de la parroquia" />
                            <span class="text-black">Solo se permiten números.</span>
                            <br>
                            <label for="descripcion" align="right"><b>Descripción:</b></label>
                            <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción de la parroquia" id="descripcion" name="descripcion" rows="4" required></textarea>
                            <br>

                            <label for="estado_codigo" align="right"><b>Código del Estado:</b></label>
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
                            <label for="municipio_codigo" align="right"><b>Código del Municipio:</b></label>
                            <select class="form-control" name="municipio_codigo" id="municipio_codigo" required>
                            </select>
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
        // Evento que se activa cada vez que se cambia la selección del estado
        $("#estado_codigo").change(function() {
            var estadoCodigo = $(this).val(); // Obtener el código del estado seleccionado

            console.log("Estado seleccionado: " + estadoCodigo);
            // Realizar la solicitud AJAX al controlador para obtener los municipios del estado seleccionado
            $.ajax({
                url: '../../controllers/municipio_controller.php',
                type: 'POST',
                data: {
                    action: 'ListarMunicipiosPorEstado',
                    estado_codigo: estadoCodigo
                },
                dataType: 'json',
                success: function(data) {
                    var options = ""; // Variable para almacenar las opciones del select de municipios

                    if (data.length > 0) {
                        // Construir las opciones del select con los municipios obtenidos
                        for (var i = 0; i < data.length; i++) {
                            options += "<option value='" + data[i].codigo + "'>" + data[i].descripcion + "</option>";
                        }
                    } else {
                        // Si no se encontraron municipios, mostrar una opción de "No se encontraron registros"
                        options = "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
                    }

                    // Actualizar el select de municipios con las opciones generadas
                    $("#municipio_codigo").html(options);
                    alert(JSON.stringify(data));
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX: " + error);
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>