<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código, descripción y parroquia_codigo de la ciudad enviados a través del formulario.
    $codigo = $_POST['codigo_ciudad'];
    $descripcion = $_POST['descripcion'];
    $parroquia_codigo = $_POST['parroquia_codigo'];

    require_once('../../controllers/ciudad_controller.php');
    $controller = new CiudadController();

    // Intentar insertar la nueva ciudad utilizando el método 'IngresarCiudad2' del controlador.
    $result_ciudad = $controller->IngresarCiudad2($codigo, $descripcion, $parroquia_codigo);

    if ($result_ciudad) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La ciudad se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";

        // Redirigir a la página de listado de ciudades después de intentar insertar.
        echo '<script>window.location.href = "?controller=Ciudad&action=ListarCiudad";</script>';
        exit();
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar la ciudad.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir al formulario de ingreso de ciudades si no se ha enviado el formulario o si la inserción falló.
    echo '<script>window.location.href = "?controller=Ciudad&action=IngresarCiudad1";</script>';
    exit();
}

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();
$result_ciudad = $controller->BuscarUltimaCiudad();
$numrows = mysqli_num_rows($result_ciudad);

?>
<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Ciudad&action=IngresarCiudad" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Ciudades</h4>
                <div class="form-group">
                    <label for="codigo_ciudad"><b>Codigo de la Ciudad:</b></label>
                    <input class="form-control" type="text" name="codigo_ciudad" id="codigo_ciudad" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código de la ciudad" />
                    <span class="text-black">Solo se permiten números.</span>
                </div>
                <div class="form-group">
                    <label for="descripcion"><b>Descripción:</b></label>
                    <textarea class="form-control" name="descripcion" maxlength="200" placeholder="Ingrese aquí la descripción de la ciudad" id="descripcion" rows="4" required></textarea>
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
                            echo "<option value='$codigo_estado'>$codigo_estado - $descripcion_estado</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="municipio_codigo"><b>Municipio:</b></label>
                    <select class="form-control" id="municipio_codigo" name="municipio_codigo" required>
                        <option value="">Seleccione un Municipio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="parroquia_codigo"><b>Parroquia:</b></label>
                    <select class="form-control" id="parroquia_codigo" name="parroquia_codigo" required>
                        <option value="">Seleccione una Parroquia</option>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
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