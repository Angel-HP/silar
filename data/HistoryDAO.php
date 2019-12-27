<?php
include '../inc/Connect.php';

include '../model/History.php';

class HistoryDAO extends Connect {
	protected static $cnx;

	private static function getConection(){
			self::$cnx = Connect::connection();
		
	}

	private static function disconnect(){
		self::$cnx = null;
	}

	public static function regHistory($history){
		$query = "INSERT INTO `history_access` (`id_history`, `ip`, `date_access`, `time_in`, `time_out`) VALUES (NULL, ':ip', ':date_access', ':time_in', ':time_out')";

		//Fase 1. Preparacion de la consulta parametrizada
		self::getConection();
	
		$result = self::$cnx->prepare($query);

		$ip = $history->getIp();
		$result->bindParam(":ip", $ip);

		$date_access = $history->getDate_access();
		$result->bindParam(":date_access", $date_access);

		$time_in = $history->getTime_in();
		$result->bindParam(":time_in", $time_in);		

		$time_out = $history->getTime_out();
		$result->bindParam(":time_out", $time_out);

		//Fase 2. Ejecutar consulta
		if($result->execute()){
			//return true;
			echo "Insercion Exitosa";
			//$lastId = $result->insert_id();
			/*$temp_result = $result->fetch(PDO::FETCH_ASSOC);
            return ( $temp_result ) ? $temp_result['last_value'] : false;
            */
           /* Haremos una seleccion del ultimo registro y lo enviamos a la tabla de Usuarios como una actualización */
           //echo "Last ID: " . $lastId;
			
			self::disconnect();
			//return $lastId;
			return true;
		}
		return false;

	}
}