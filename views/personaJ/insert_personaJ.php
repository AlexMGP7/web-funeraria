<?php

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $rif_letra = $_POST['rif_letra'];
    $rif_numeros = $_POST['rif_numeros'];
    $rif_verificador = $_POST['rif_verificador'];

    // Combinar las partes del RIF en una sola variable
    $rif = $rif_letra . '-' . $rif_numeros . '-' . $rif_verificador;

    $nombre = $_POST['nombre'];
    $ciudadCodigo = $_POST['ciudad_codigo'];

    require_once('../../controllers/personaJuridica_controller.php');
    $controller = new PersonaJuridicaController();

    // Insertar la persona jurídica y obtener el resultado
    $result_persona_juridica = $controller->IngresarPersonaJ2($rif, $nombre, $ciudadCodigo);

    // Verificar si el insert fue exitoso
    if ($result_persona_juridica) {
        $_SESSION['mensaje'] = "La persona jurídica se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la persona jurídica. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de personas jurídicas después de intentar insertar.
    echo '<script>window.location.href = "?controller=PersonaJuridica&action=ListarPersonaJ";</script>';
    exit();
}

require_once('../../controllers/personaJuridica_controller.php');
$controller = new PersonaJuridicaController();
$result_ciudad = $controller->ListarCiudades();
$numrows = mysqli_num_rows($result_ciudad);
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=PersonaJuridica&action=IngresarPersonaJ" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Personas Jurídicas</h4>
                <div class="form-group">
                    <label for="rif"><b>RIF:</b></label>
                    <!-- Dividir el campo RIF en tres partes -->
                    <div class="row">
                        <div class="col-md-2">
                            <select class="form-control" name="rif_letra" id="rif_letra" required>
                                <option value="J">J</option>
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="G">G</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="rif_numeros" id="rif_numeros" maxlength="8" required pattern="[0-9]{8}" placeholder="Ingrese aquí los 8 números del RIF" />
                        </div>
                        <div class="col-md-2">
                            <input class="form-control" type="text" name="rif_verificador" id="rif_verificador" maxlength="1" required pattern="[0-9]" placeholder="Dígito" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre"><b>Nombre:</b></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" required placeholder="Ingrese aquí el nombre de la Persona Jurídica" />
                </div>
                <div class="form-group">
                    <label for="ciudad_codigo"><b>Ciudad Código:</b></label>
                    <select class="form-control" name="ciudad_codigo" id="ciudad_codigo" required>
                        <?php
                        if ($numrows != 0) {
                            while ($row_ciudad = mysqli_fetch_array($result_ciudad)) {
                                $codigo_ciudad = $row_ciudad['codigo'];
                                $descripcion_ciudad = $row_ciudad['descripcion'];
                                echo "<option value='$codigo_ciudad'>$codigo_ciudad - $descripcion_ciudad</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>
