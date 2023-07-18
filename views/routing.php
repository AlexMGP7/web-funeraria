<?php
$controllers = array(
    'Estado' => ['ListarEstado', 'IngresarEstado', 'IngresarEstado1', 'UpdateEstado', 'UpdateEstado1', 'DeleteEstado'],
    'Municipio' => ['ListarMunicipio', 'IngresarMunicipio', 'IngresarMunicipio1', 'UpdateMunicipio', 'UpdateMunicipio1', 'DeleteMunicipio', 'ObtenerMunicipiosPorEstado'],
    'Parroquia' => ['ListarParroquia', 'IngresarParroquia', 'IngresarParroquia1', 'UpdateParroquia', 'UpdateParroquia1', 'DeleteParroquia'],
    'Ciudad' => ['ListarCiudad', 'IngresarCiudad', 'IngresarCiudad1', 'UpdateCiudad', 'UpdateCiudad1', 'DeleteCiudad']
    // Agrega más controladores y acciones según sea necesario
);

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];

    if (array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Estado', 'ListarEstado');
    }
} else {
    call('Estado', 'ListarEstado');
    // call('Municipio', 'ListarMunicipio');
    // call('Parroquia', 'ListarParroquia');
    // call('Ciudad', 'ListarCiudad');
}

function call($controller, $action)
{
    require_once('../../controllers/' . $controller . '_controller.php');

    switch ($controller) {
        case 'Estado':
            $estadoController = new EstadoController();

            switch ($action) {
                case 'ListarEstado':
                    $estadoController->ListarEstado();
                    break;
                case 'IngresarEstado':
                    $estadoController->IngresarEstado();
                    break;
                case 'IngresarEstado1':
                    $estadoController->IngresarEstado1();
                    break;
                case 'UpdateEstado':
                    $estadoController->UpdateEstado();
                    break;
                case 'UpdateEstado1':
                    $estadoController->UpdateEstado1();
                    break;
                case 'DeleteEstado':
                    $estadoController->DeleteEstado();
                    break;
                default:
                    $estadoController->ListarEstado();
                    break;
            }
            break;
        case 'Municipio':
            $municipioController = new MunicipioController();

            switch ($action) {
                case 'ListarMunicipio':
                    $municipioController->ListarMunicipio();
                    break;
                case 'IngresarMunicipio':
                    $municipioController->IngresarMunicipio();
                    break;
                case 'IngresarMunicipio1':
                    $municipioController->IngresarMunicipio1();
                    break;
                case 'UpdateMunicipio':
                    $municipioController->UpdateMunicipio();
                    break;
                case 'UpdateMunicipio1':
                    $municipioController->UpdateMunicipio1();
                    break;
                case 'DeleteMunicipio':
                    $municipioController->DeleteMunicipio();
                    break;

                default:
                    $municipioController->ListarMunicipio();
                    break;
            }
            break;
        case 'Parroquia':
            $parroquiaController = new ParroquiaController();

            switch ($action) {
                case 'ListarParroquia':
                    $parroquiaController->ListarParroquia();
                    break;
                case 'IngresarParroquia':
                    $parroquiaController->IngresarParroquia();
                    break;
                case 'IngresarParroquia1':
                    $parroquiaController->IngresarParroquia1();
                    break;
                case 'UpdateParroquia':
                    $parroquiaController->UpdateParroquia();
                    break;
                case 'UpdateParroquia1':
                    $parroquiaController->UpdateParroquia1();
                    break;
                case 'DeleteParroquia':
                    $parroquiaController->DeleteParroquia();
                    break;
                case 'ObtenerMunicipiosPorEstado':
                    $municipioController->ObtenerMunicipiosPorEstado();
                    break;
                default:
                    $parroquiaController->ListarParroquia();
                    break;
            }
            break;
        case 'Ciudad':
            $ciudadController = new CiudadController();

            switch ($action) {
                case 'ListarCiudad':
                    $ciudadController->ListarCiudad();
                    break;
                case 'IngresarCiudad':
                    $ciudadController->IngresarCiudad();
                    break;
                case 'IngresarCiudad1':
                    $ciudadController->IngresarCiudad1();
                    break;
                case 'UpdateCiudad':
                    $ciudadController->UpdateCiudad();
                    break;
                case 'UpdateCiudad1':
                    $ciudadController->UpdateCiudad1();
                    break;
                case 'DeleteCiudad':
                    $ciudadController->DeleteCiudad();
                    break;
                default:
                    $ciudadController->ListarCiudad();
                    break;
            }
            break;
            // Agregar más casos según los controladores que se necesiten
        default:
            call('Estado', 'ListarEstado');
            break;
    }
}
