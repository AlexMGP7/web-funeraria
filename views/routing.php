<?php
$controllers = array(
	'Estado' => ['ListarEstado', 'IngresarEstado', 'IngresarEstado1', 'UpdateEstado', 'UpdateEstado1', 'DeleteEstado'],
	'Municipio' => ['ListarMunicipio', 'IngresarMunicipio', 'IngresarMunicipio1', 'UpdateMunicipio', 'UpdateMunicipio1', 'DeleteMunicipio']
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
	// call('Estado', 'ListarEstado');
	call('Municipio', 'ListarMunicipio');
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
			// Agregar más casos según los controladores que se necesiten
		default:
			call('Estado', 'ListarEstado');
			break;
	}
}
