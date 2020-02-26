<?php
echo "Formulario"

?>
<br/>
<form name="formulario" action="captura.php" method="POST">
<select name="select" id="">
<option value=""> Seleccione una opcion </option>
<option value="1">Hombre</option>
<option value="2">Mujer</option>

</select>

<br/>

  <button type="submit" name="save" > Enviar</button>

<?php
if(isset($_POST['save'])){

	$var = "select"
	if ($var = =1){
		echo "Usted es del genero Masculino";
	}

	if ($var = =2){
		echo "Usted es del genero Femenino";
	}
 else{
 	echo "Sed esconoce genero"
 }
}
else{
	echo "No se recibio informacion";
}


?>


</form>
          

                                                                   
                                               