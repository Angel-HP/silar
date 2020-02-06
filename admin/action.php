<?php
session_start();

//$_SESSION["user"]["code"] = "true";

$id = $_GET['id'];
/**
 * Dentro de cada opcion debera cargarse las variables de session para quedar dentro del sistema,
 * este valor sera integrado despues de cargar el menu
  */
if(isset($id)){
	switch($id){
		case 1:
			//Listar usuarios
			require_once("view/listUser.php");
			break;
		case 2:
			//Registrar Usuarios
			require_once("view/regUser.php");
			break;
		case 3:
			//Modificar Usuarios
			require_once("view/editUser.php");
			break;
		case 4:
			//Eliminar Usuiarios
			require_once("view/deleteUser.php");
			break;
		case 5:
			//Cambiar Pass
			require_once("view/changePass.php");
			break;
		
		default:
			echo"No hay mas Opciones";
			echo "<br/>";
			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=../index.php'<head/>";
			break;

	}
}

?>