<?php
include '../controller/UserController.php';
include '../controller/HistoryController.php';

include '../help/helper.php';
session_start();
//include '../help/getRealIP.php';

header('Content-type: application/json');

$result = array();



if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["user"]) && isset($_POST["pass"])){
	//Validamos que no contenga codigo JS


	$code = $_POST["code"];
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


	if(UserController::login($inputUser,$inputPass)){
		
		//Registro en el historial el acceso
		HistoryController::regHistory($ip, $date, $time_in, $time_out);
			

		/*Despues de verificar user, pass; regisrrar nuestro acceso, regresar elementos de ingreso al sistema
			para crear nuestras variables de sesion
		*/
		$user  = UserController::getUser($inputUser, $inputPass);
		

		//Obtengo el id del ultimo acceso de la tabla History_access
		$idUser = $user->getId_user();

		//echo $idUser;
		$idUserOnline = $user->getId_user();
		
		//Actualizar en la tabla Usuarios el identificador del historial del ultimo acceso
		$history = HistoryController::updateHistory($idUser);

		//Despues de haber ingresado al sistema, el estatus del usuario cambie a 1 
		//en el campo 'online' de la bd en la tabla users
		$online = UserController::changeIn($idUserOnline);
		//UserController::changeIn($idUser);
 
		//Crear nuestras variables de session
				
		$_SESSION["user"] = array (
				"id_user"		=> $user->getId_user(),
				"name"			=> $user->getName(),
				"user"			=> $user->getUser_name(),
				"email"			=> $user->getUser_email(),
				"code"			=> $code,
				"id_priv"		=> $user->getId_Priv(),
				"op"      		=> "false"
							);//$_SESSION

		$result = array(
			"status" => "true"
			);

		
		UserController::logout();

		return print(json_encode($result));
		
		
	}

}

}//if $_SERVER
$result = array("status" => "false");

return print(json_encode($result));
echo '<script>location.href = "../index.php"</script>'; 
header("location:index.html");											

