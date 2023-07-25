<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
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
        <div class="container">
            <div class="page-content">

                <h4>Actualización de Ciudad</h4>
                <form action="?controller=Ciudad&action=UpdateCiudad1" method="POST">
                    <br>
                    <div class="alert alert-success">
                        <label for="codigo"><b>Ciudad:</b></label>
                        <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                        <br>
                        <label for="descripcion"><b>Nueva Descripción:</b></label>
                        <textarea class="form-control" name="descripcion" rows="4" required placeholder="<?php echo $descripcion; ?>"></textarea>
                        <br>
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
                        <br>
                        <label for="municipio_codigo"><b>Municipio:</b></label>
                        <select class="form-control" id="municipio_codigo" name="municipio_codigo">
                        </select>
                        <br>
                        <label for="parroquia_codigo"><b>Parroquia:</b></label>
                        <select class="form-control" id="parroquia_codigo" name="parroquia_codigo">
                        </select>
                        <br>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Actualizar</button>
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