<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $rif = $_POST['rif'];
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];

    require_once('../../controllers/cementerio_controller.php');
    $controller = new CementerioController();

    // Actualizar el cementerio y obtener el resultado
    $result_cementerio = $controller->UpdateCementerio2($rif, $codigo, $tipo);

    // Verificar si la actualización fue exitosa
    if ($result_cementerio) {
        $_SESSION['mensaje'] = "El cementerio se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el cementerio. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de cementerios después de intentar actualizar.
    echo '<script>window.location.href = "?controller=Cementerio&action=ListarCementerio";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $rif = $_GET['i'];
    require_once('../../controllers/cementerio_controller.php');
    $controller = new CementerioController();
    $result_cementerio = $controller->BuscarCementerioByRif($rif);
    $numrows = mysqli_num_rows($result_cementerio);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_cementerio)) {
            // Extract data
            if (isset($row["rif"])) {
                $rif = $row["rif"];
            }
            if (isset($row["codigo"])) {
                $codigo = $row["codigo"];
            }
            if (isset($row["tipo"])) {
                $tipo = $row["tipo"];
            }
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Cementerio&action=UpdateCementerio" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Cementerio</h4>
                        <div class="form-group">
                            <label for="rif"><b>RIF:</b></label>
                            <input class="form-control" type="text" name="rif" value="<?php echo $rif; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="codigo"><b>Código:</b></label>
                            <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo"><b>Tipo:</b></label>
                            <input class="form-control" type="text" name="tipo" value="<?php echo $tipo; ?>" required>
                        </div>
                        <!-- Add other fields related to Cementerio table here -->

                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        // If Cementerio not found, redirect to the list of cementerios
        require_once('../../views/cementerio/list_cementerio.php');
    }
} else {
    // If 'i' parameter not provided in the URL, redirect to the list of cementerios
    require_once('../../views/cementerio/list_cementerio.php');
}
?>
