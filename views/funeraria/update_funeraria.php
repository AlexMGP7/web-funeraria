<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rif = $_POST['rif'];
    $tipo = $_POST['tipo'];
    require_once('../../controllers/funeraria_controller.php');
    $controller = new FunerariaController();
    $result_funeraria = $controller->UpdateFuneraria2($rif, $tipo);
    if ($result_funeraria) {
        $_SESSION['mensaje'] = "La funeraria se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la funeraria. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    echo '<script>window.location.href = "?controller=Funeraria&action=ListarFuneraria";</script>';
    exit();
}
if (isset($_GET['i'])) {
    $rif = $_GET['i'];
    require_once('../../controllers/funeraria_controller.php');
    $controller = new FunerariaController();
    $result_funeraria = $controller->BuscarFunerariaPorRif($rif);
    $numrows = mysqli_num_rows($result_funeraria);
    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_funeraria)) {
            $rif = $row["rif"];
            $tipo = $row["tipo"];
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=Funeraria&action=UpdateFuneraria" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Funeraria</h4>
                        <div class="form-group">
                            <label for="rif"><b>Rif:</b></label>
                            <input class="form-control" type="text" name="rif" value="<?php echo $rif; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tipo"><b>Tipo:</b></label>
                            <input class="form-control" type="text" name="tipo" value="<?php echo $tipo; ?>" required>
                        </div>
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        require_once('../../views/funeraria/list_funeraria.php');
    }
} else {
    require_once('../../views/funeraria/list_funeraria.php');
}
?>