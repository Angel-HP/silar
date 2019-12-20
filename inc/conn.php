<?php
$host_BD = "localhost";
$user_BD = "dev";
$pass_BD = "desarrollo";
$name_BD = "silar";

$conn = new mysqli($host_BD, $user_BD, $pass_BD, $name_BD);
if($conn){
	echo "Conexion Exitosa";
}else{
	echo "No se pudo conectar  a la BD";
}
?>