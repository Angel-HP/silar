<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tabla</title>
	<link rel="stylesheet" href="">
</head>
<body>
<?php
/*--------   BD     ----------*/
$host_BD = "localhost";
$user_BD = "dev";
$pass_BD = "desarrollo";
$name_BD = "silar";


$link = new mysqli($host_BD, $user_BD, $pass_BD, $name_BD); 

if ($link->connect_errno) { 
	echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $link->connect_error; exit(); 
}/*else{
	echo "Conexion Establecida correctamente";
}*/


$sql = "SELECT id_user, name, user_name FROM users"; 


$query = mysqli_query($link, $sql);

$filas = mysqli_num_rows($query);

//$data =mysqli_fetch_array($query);

echo "numero de filas: " . $filas;


/*for ($i=0; $i <= 2 ; $i++) { 
	
	echo "<br/>Nombre: " . $data[$i];
}*/


/*--------   BD     ----------*/
?>





<!--------Table ------------>

	<table border="1">
		<caption>table</caption>
		<thead>
<?php 
			echo "<tr>";
for ($f=1; $f <= 3 ; $f++) { 			
			echo "<th>titulo " . $f ."</th>";
}
			echo "</tr>";
?>
		</thead>
		<tbody>

<?php
for ($f=0; $f <= 2 ; $f++) { 
	echo "<tr>";
	
	$data =mysqli_fetch_array($query);
	for ($c=0; $c < $filas ; $c++) { 

		echo "	<td>" . $data[$c] . "</td>";
			
		
	}//columnas
		
	echo "	</tr>";

}//filas



?>

		</tbody>
	</table>

<!--------Table ------------>

	
</body>
</html>