<?php
/*---------------   Conexion -----------------------------*/
getConection();
/*$host_BD = "localhost";
$user_BD = "dev";
$pass_BD = "desarrollo";
$name_BD = "silar";


$link = new mysqli($host_BD, $user_BD, $pass_BD, $name_BD); 

if ($link->connect_errno) { 
	echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $link->connect_error; exit(); 
}else{
	//echo "Conexion Establecida correctamente";
}
//Connect::conn();*/
/*---------------   Conexion -----------------------------*/


if(isset($_POST['save'])){

	echo "<br/>Se recibio esta información";

   $var = $_POST['select'];

   echo "<br/>";

   //echo "Valor del select: " . $var;

	/*if ($var == 1){
		echo "<br/>Usted es del genero Masculino";
	}elseif($var == 2){
		echo "<br/>Usted es del genero Femenino";
	}else{
 	echo "<br/>Se desconoce genero o no se selecciono corectamente la opción";
	}*/

	switch ($var) {
		case '1':
			echo "<br/>Usted es Administrador";
			break;

		case '2':		
			echo "<br/>Usted es Desarrollador";
			break;

		case '3':		
			echo "<br/>Usted es Usuario";
			break;

		case '4':		
			echo "<br/>Se desconoce";
			break;

		case '':		
			echo "<br/>No se selecciono opcion del select";
			break;

		default:
			echo "<br/>Se desconoce opcion";
			break;
	}

	
}else{
	echo "<br/>Formulario<br/>";

/*------------------------------ Consulta a la BD --------------------------------*/
//Consulta 
$query = "SELECT id_priv, privelege FROM `priveleges`";
//echo $query;

//Ejecución de la consulta
//$data = mysqli_query($link, $query);


/*if (!$data) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}*/



//Contamos rsultados

//$filas = mysqli_num_rows($data);

/*echo "Numero de filas resultantes: " . $filas;
echo "<br/>";*/

/*for ($i=0; $i < $filas; $i++) { 

	//Devuelvo los valores a traves de un array
	$info = mysqli_fetch_array($data);

	echo $info['id_priv'] . " - " . $info['privelege'];

	echo "<br/>";
}
*/
?>

	<br/>
	<form name="formulario" action="" method="POST">
	<select name="select" id="">

		<option value=""> Seleccione una opcion </option>
		
<?php
		//for ($i=0; $i < $filas; $i++) { 

	
			//$info = mysqli_fetch_array($data);

			echo '<option value="' . $info['id_priv'] . '">' . $info['privelege']  . '</option>';
		}
?>

		<!-- <option value="1">Hombre</option>
		<option value="2">Mujer</option>
		<option value="3">No especificado</option> -->

	</select>

	<br/>

  <button type="submit" name="save" > Enviar</button>



</form>
          

                                                                   
                                               