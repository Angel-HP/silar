<?php


include '../inc/Reconnect.php';



class Combo extends Connect {

	//Definimos la variable de conexion
	protected static $cnx;

	//Definir la conexion a la BD
	private static function getConnection(){
		self::$cnx = Connect::conn();

	}

	//Definir la desconexion a la BD
	private static function disconnect(){
		self::$cnx = NULL;	
		
	}



	function combo($sql, $name, $id, $value, $label, $req, $enable, $onchange, $iniselect){
       

		$query = $sql;

		self::getConnection();

		$result = self::$cnx->prepare($query);

		$result->execute();

		$rows = $result->rowCount();
		$cols = $result->columnCount();

		//echo "Filas: " . $rows;
		echo '<div class="form-group">';
		echo '<label for="' . $id . '"><b>' . $label .'</b></label>';
		/*<select name="privilegio" id="inputPrivi" class="form-control" required="required">*/
		echo '<select name="' . $name . '" id="' . $id. '" class="form-control" required="' . $req . '" '. $enable . " " . $onchange . '>';

		if($rows > 0){

			if ($iniselect==1){
				//If some value is received from an unpdate form
				if($value != ""){

					$divide_values = explode("-",$value);
					$id = $divide_values[0];
					$desc = $divide_values[1];

					echo "<option value='" . $id . "'>". $desc . "</option>";
       			}
                else{

                	echo "<option value=''>[ Seleccione una opcion ]</option>";
                }
                
                while(list($id, $descrip) = $result->fetch()){
	               if ($id == $value)
	                   echo '<option selected value="' . $id . '">' . $descrip. '</option>';
	               else
	                   echo '<option value="' . $id . '">' . $descrip. '</option>';
	            }

            }

		}else{
			echo "<option value='0'>'No hay opciones !!'</option>";
		}

		echo '</select>';
		echo '</div>';
		/*echo '<div>';

		echo "<br/></div>";*/
		//Disconect from BD
		self::disconnect();
   }//function combo

} //cñass Combo
