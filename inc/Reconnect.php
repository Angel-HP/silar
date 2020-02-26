<?php
 class Reconnect {


	public static function conn(){
		try {

			
			$cn = new PDO(
			  "mysql:host=localhost;dbname=silar", 
			  "dev", 
			  "desarrollo", 
			  array(
			    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			  )
			);


			//echo "Conexion Exitosa";				
			return $cn;

		} catch(PDOException $ex) {
			die($ex->getMessage());
		  }
	}//Connection

	
}

//Connect::conn();
?>