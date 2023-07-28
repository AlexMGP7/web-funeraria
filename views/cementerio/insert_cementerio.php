<?php

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $rif = $_POST['rif'];
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];

    require_once('../../controllers/cementerio_controller.php');
    $controller = new CementerioController();

    // Insertar el cementerio y obtener el resultado
    $result_cementerio = $controller->IngresarCementerio2($rif, $codigo, $tipo);

    // Verificar si el insert fue exitoso
    if ($result_cementerio) {
        $_SESSION['mensaje'] = "El cementerio se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar el cementerio. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de cementerios después de intentar insertar.
    echo '<script>window.location.href = "?controller=Cementerio&action=ListarCementerio";</script>';
    exit();
}

require_once('../../controllers/personaJuridica_controller.php');
$persona_juridica_controller = new PersonaJuridicaController();
$result_persona_juridica = $persona_juridica_controller->ListarPersonaJ1();

?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Cementerio&action=IngresarCementerio" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Cementerios</h4>
                <div class="form-group">
                    <label for="rif"><b>RIF:</b></label>
                    <select class="form-control" name="rif" id="rif" required>
                        <?php
                        while ($row_persona_juridica = mysqli_fetch_array($result_persona_juridica)) {
                            $rif_persona_juridica = $row_persona_juridica['rif'];
                            $nombre_persona_juridica = $row_persona_juridica['nombre'];
                            echo "<option value='$rif_persona_juridica'>$rif_persona_juridica - $nombre_persona_juridica</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="codigo"><b>Código:</b></label>
                    <input class="form-control" type="text" name="codigo" id="codigo" maxlength="10" required placeholder="Ingrese aquí el código del cementerio" />
                </div>
                <div class="form-group">
                    <label for="tipo"><b>Tipo:</b></label>
                    <input class="form-control" type="text" name="tipo" id="tipo" maxlength="50" required placeholder="Ingrese aquí el tipo del cementerio" />
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>
