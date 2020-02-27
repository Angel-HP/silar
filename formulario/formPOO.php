<?php


class Connect{

    public function dbConnectSimple(){        
        $dbsystem='mysql';
        $host='localhost';
        $dbname='silar';
        $username='dev';
        $passwd='desarrollo'; 
        
       
        $dsn=$dbsystem.':host='.$host.';dbname='.$dbname;               
        try {          
            $connection = new PDO($dsn, $username, $passwd);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pdoExcetion) {
            $connection = null;
            echo 'Error al establecer la conexión: '.$pdoExcetion;
            exit();
        }
        //echo 'Conectado a la base de datos: '.$dbname;
        return $connection;        
        
    
}

}

//Invocar la conexion a la BD
//Connect::dbConnectSimple();

class Combo extends Connect {

	protected static $cnx;

	private static function getConnection(){
		self::$cnx = Connect::dbConnectSimple();

	}


	//Define desconnection to DB
	private static function disconnect(){
		self::$cnx = NULL;	
		
	}


	function combo($sql, $name, $id, $value, $label){
		//Parametros del metodo select 
		/*
		 * $sql 	-> 		Consulta a ejecutar dentro del select
		 * $name 	-> 		Nombre del Select definido  <select name="select" id="">
		 * $id 		->		Identificador del elento select para sus porpiedades CSS
		 * $value 	-> 		Valor o valores de cada uno de los elementos de option en el select   "Id" - "Valor"
		 * $label 	-> 		Etiqueta que prcede al select 
		 * 
		 */
		
		//Asignar la consulta a la variable a utilizar en el metodo select
		$query = $sql;

		//Establecer la conecxion con la BD
		self::getConnection();

		//Preperara la consulta
		$result = self::$cnx->prepare($query);

		//Ejecutar la consulta
		$result->execute();

		//Devuelve numero de elementos encontrados en la ejecucacion de la consulta
		$rows = $result->rowCount();	

		//echo "Comenzando a crear select <br/>";


		echo '<div class="form-group">';
		echo '<label for="' . $id . '">' . $label .'</label>';
		/*<select name="privilegio" id="inputPrivi" class="form-control" required="required">*/
		echo '<select name="' . $name . '" id="' . $id. '" class="form-control">';


		$iniselect = 1;


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

                	echo "<option value='0'>[ Seleccione una opcion ]</option>";
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
		echo '<div>';

		echo "<br/></div>";
		//Disconect from BD
		self::disconnect();




	} //metodo select

}//Objeto combo


/*----------------------  Funcionalidad del Formulario y el combo definido ----------------------   */
?>




<form name="regContent_submit" method="POST" action="action.php?id=3" accept-charset="utf-8">


<?php
//Crea una instancia del objeto combo
//$combo = new Combo();

//Defino la consulta
$query = "SELECT id_priv, privelege FROM `priveleges`";
//$query = "SELECT id_area, desc_area FROM `area`";

//$val = "1 - Administrador";


//Invoco al objeto combo
$combo = new combo($query, "select", "", "", "Privilegio ");

//$combo = new select($query);



?>

</form>


<!-- ----------------------  Funcionalidad del Formulario y el combo definido ----------------------    -->