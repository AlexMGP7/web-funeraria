<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de actualización.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código, descripción y parroquia_codigo de la ciudad enviados a través del formulario.
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $parroquia_codigo = $_POST['parroquia_codigo'];

    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();

    // Intentar actualizar la ciudad utilizando el método 'UpdateCiudad2' del controlador.
    $result_ciudad = $controller->UpdateCiudad2($codigo, $descripcion, $parroquia_codigo);

    if ($result_ciudad) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La ciudad se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";

        // Redirigir a la página de listado de ciudades después de intentar actualizar.
        echo '<script>window.location.href = "?controller=Ciudad&action=ListarCiudad";</script>';
        exit();
    } else {
        // Si la actualización falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo actualizar la ciudad.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir al formulario de actualización de ciudades si no se ha enviado el formulario o si la actualización falló.
    echo '<script>window.location.href = "?controller=Ciudad&action=UpdateCiudad1&i=' . $codigo . '";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();
    $result_ciudad = $controller->BuscarCiudadByCodigo($codigo);
    $numrows = mysqli_num_rows($result_ciudad);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_ciudad)) {
            // Extract data
            if (isset($row["codigo"])) {
                $ciudad_codigo = $row["codigo"];
            }
            if (isset($row["ciudad_descripcion"])) {
                $descripcion = $row["ciudad_descripcion"];
            }
            if (isset($row["parroquia_codigo"])) {
                $parroquia_codigo = $row["parroquia_codigo"];
            }
            if (isset($row["parroquia_descripcion"])) {
                $parroquia_descripcion = $row["parroquia_descripcion"];
            }
            if (isset($row["municipio_codigo"])) {
                $municipio_codigo = $row["municipio_codigo"];
            }
            if (isset($row["municipio_descripcion"])) {
                $municipio_descripcion = $row["municipio_descripcion"];
            }
            if (isset($row["estado_codigo"])) {
                $estado_codigo = $row["estado_codigo"];
            }
            if (isset($row["estado_descripcion"])) {
                $estado_descripcion = $row["estado_descripcion"];
            }
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Ciudad&action=UpdateCiudad" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Ciudad</h4>
                        <div class="form-group">
                            <label for="codigo"><b>Ciudad:</b></label>
                            <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="descripcion"><b>Nueva Descripción:</b></label>
                            <textarea class="form-control" name="descripcion" rows="4" required placeholder="<?php echo $descripcion; ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="estado_codigo"><b>Estado:</b></label>
                            <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                                <?php
                                $controller = new CiudadController();
                                $result_estados = $controller->ListarEstados();

                                while ($row_estado = mysqli_fetch_array($result_estados)) {
                                    $codigo_estado = $row_estado['codigo'];
                                    $descripcion_estado = $row_estado['descripcion'];
                                    $selected = ($codigo_estado == $estado_codigo) ? 'selected' : '';
                                    echo "<option value='$codigo_estado' $selected>$codigo_estado - $descripcion_estado</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="municipio_codigo"><b>Municipio:</b></label>
                            <select class="form-control" id="municipio_codigo" name="municipio_codigo">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parroquia_codigo"><b>Parroquia:</b></label>
                            <select class="form-control" id="parroquia_codigo" name="parroquia_codigo">
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Function to load data into the select element
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

                // Load municipalities based on the selected state
                $('#estado_codigo').on('change', function() {
                    var estadoId = $(this).val();
                    if (estadoId !== '') {
                        loadOptions('municipios', estadoId, '#municipio_codigo');
                    } else {
                        $('#municipio_codigo').html('<option value="">Seleccione un municipio</option>');
                    }
                });

                // Pre-select the previous municipality value
                var prevMunicipioCodigo = '<?php echo $municipio_codigo; ?>';
                if (prevMunicipioCodigo !== '') {
                    loadOptions('municipios', '<?php echo $estado_codigo; ?>', '#municipio_codigo');
                    $('#municipio_codigo').val(prevMunicipioCodigo);
                }

                // Load parroquias based on the selected municipality
                $('#municipio_codigo').on('change', function() {
                    var municipioId = $(this).val();
                    if (municipioId !== '') {
                        loadOptions('parroquias', municipioId, '#parroquia_codigo');
                    } else {
                        $('#parroquia_codigo').html('<option value="">Seleccione una parroquia</option>');
                    }
                });

                // Pre-select the previous parroquia value
                var prevParroquiaCodigo = '<?php echo $parroquia_codigo; ?>';
                if (prevParroquiaCodigo !== '') {
                    loadOptions('parroquias', '<?php echo $municipio_codigo; ?>', '#parroquia_codigo');
                    $('#parroquia_codigo').val(prevParroquiaCodigo);
                }


            });
        </script>
<?php
    } else {
        require_once('../../views/domicilio/ciudad/list_ciudad.php');
    }
} else {
    require_once('../../views/domicilio/ciudad/list_ciudad.php');
}
?>