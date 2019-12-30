<?php

include '../controller/UserController.php';
include '../controller/HistoryController.php';

include '../help/helper.php';
include '../help/getRealIP.php';

$result = array();
if(isset($_POST["user"]) && isset($_POST["pass"])){
	//Validamos que no contenga codigo JS

	$inputUser = validate_field($_POST["user"]);
	$inputPass = validate_field($_POST["pass"]);

	//Obtener ip del equipo desde donde se ingresan las credenciales
	$ip = getenv("REMOTE_ADDR");
		if ($ip = '::1'){
			$ip = '127.0.0.1';
		}
	//$ip = getRealIP();
	//Fecha
	$timezone  = -7; //(UTC/GMT -7:00) Zona Horaria Estandar (México) - Tiempo del Pacífico: UTC–7 
	$date = date("Y-m-d");
	//hora
	$time_in = date('H:i:s');
	$time_out = '00:00:00';

	if(UserController::login($inputUser,$pinputPass)){
		//Registro en el historial el acceso
		HistoryController::regHistory($ip, $date, $time_in, $time_out);

		/*Despues de verificar user, pass; regisrrar nuestro acceso, regresar elementos de ingreso al sistema
			para crear nuestras variables de sesion
		*/
		$user  = UserController::getUser($inputUser, $inputPass);

		//Obtengo el id del ultimo acceso de la tabla History_access
		$idUser = $user->getId_user();
		//Actualizar en la tabla Usuarios el identificador del historial del ultimo acceso
		$history = HistoryController::updateHistory($idUser);

	}

}

