<?php
echo "Formulario"

?>
<br/>
<form action="result.php" method="POST">
<select name="select">
<option value=""> Seleccione una opcion </option>
<option value="1">Hombre</option>
<option value="2">Mujer</option>

</select>

<br/>

  <button type="submit" name="save" > Enviar</button>

<?php
if(isset($_POST['save'])){
 
}


?>


</form>
          

                                                                   
                                               