<?php
if (isset($_GET['i'])) {
    $codigo = $_GET['i'];
    require_once('../../controllers/parroquia_controller.php');
    $controller = new ParroquiaController();
    $result_parroquia = $controller->BuscarParroquiaByCodigo($codigo);
    $numrows = mysqli_num_rows($result_parroquia);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_parroquia)) {
            if (isset($row["codigo"])) {
                $parroquia_codigo = $row["codigo"];
            }
            if (isset($row["parroquia_descripcion"])) {
                $descripcion = $row["parroquia_descripcion"];
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

                <h4>Actualización de Parroquia</h4>
                <form action="?controller=Parroquia&action=UpdateParroquia1" method="POST">
                    <div class="col-12">
                        <br>
                        <div class="alert alert-success">
                            <div class="row">
                                <div class="col-6">
                                    <label for="codigo"><b>Parroquia:</b></label>
                                    <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                    <br>
                                    <label for="descripcion"><b>Nueva Descripción:</b></label>
                                    <textarea class="form-control" name="descripcion" rows="4" required placeholder="<?php echo $descripcion; ?>"></textarea>
                                    <br>
                                    <label for="estado_codigo"><b>Estado:</b></label>
                                    <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                                        <?php
                                        $controller = new ParroquiaController();
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
                                </div>
                            </div>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Actualizar</button>
                        </div>
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
                // Pre-select the previous municipality value
                var prevMunicipioCodigo = '<?php echo $municipio_codigo; ?>';
                if (prevMunicipioCodigo !== '') {
                    loadOptions('municipios', '<?php echo $estado_codigo; ?>', '#municipio_codigo');
                    $('#municipio_codigo').val(prevMunicipioCodigo);
                }

            });
        </script>
<?php
    } else {
        require_once('../../views/domicilio/parroquia/list_parroquia.php');
    }
} else {
    require_once('../../views/domicilio/parroquia/list_parroquia.php');
}
?>