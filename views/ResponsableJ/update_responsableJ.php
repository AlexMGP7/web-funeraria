<?php
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rif = $_POST['rif'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $razon_s = $_POST['razon_s'];
    require_once('../../controllers/responsableJ_controller.php');
    $controller = new ResponsableJuridicoController();
    $result_responsable_juridico = $controller->UpdateResponsableJ2($rif, $correo, $telefono, $razon_s);
    if ($result_responsable_juridico) {
        $_SESSION['mensaje'] = "El responsable jurídico se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el responsable jurídico. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    echo '<script>window.location.href = "?controller=ResponsableJ&action=ListarResponsableJ";</script>';
    exit();
}
if (isset($_GET['i'])) {
    $rif = $_GET['i'];
    require_once('../../controllers/responsableJ_controller.php');
    $controller = new ResponsableJuridicoController();
    $result_responsable_juridico = $controller->BuscarResponsableJByRif($rif);
    $numrows = mysqli_num_rows($result_responsable_juridico);
    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_responsable_juridico)) {
            $rif = $row["rif"];
            $correo = $row["correo"];
            $telefono = $row["telefono"];
            $razon_s = $row["razon_s"];
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=ResponsableJ&action=UpdateResponsableJ" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Responsable Jurídico</h4>
                        <div class="form-group">
                            <label for="rif"><b>Rif:</b></label>
                            <input class="form-control" type="text" name="rif" value="<?php echo $rif; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="correo"><b>Correo:</b></label>
                            <input class="form-control" type="email" name="correo" value="<?php echo $correo; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono"><b>Teléfono:</b></label>
                            <input class="form-control" type="text" name="telefono" value="<?php echo $telefono; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="razon_s"><b>Razón Social:</b></label>
                            <input class="form-control" type="text" name="razon_s" value="<?php echo $razon_s; ?>" required>
                        </div>
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        require_once('../../views/responsableJ/list_responsableJ.php');
    }
} else {
    require_once('../../views/responsableJ/list_responsableJ.php');
}
?>