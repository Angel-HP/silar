<?php
//Importar la BD
include '../inc/Connect.php';
//Inluir modelo del Usuario
include '../model/User.php';

//Establecer conexion con la BD
class UserDAO extends Connect {
	//Definimos la variable de conexion
	protected static $cnx;

	//Definir la conexion a la BD
	private static function getConnection(){
		$self::$cnx = Connect::conn();

	}

	//Definir la desconexion a la BD
	private static function disconnect(){
		$self::$cnx = NULL;		
	}

	//Localizar datos en la BD del Usuario de Login
	public static function login($user){
		//Una consulta es generada por los campos seleccionado que seran enviados sin comprometer la seguridad del sistema, tal como datos visibles via HTML, Inyeccion de SQL o Js y CrosSiteScripting
		
		$query = "SELECT id_user, id_priv, name, user, pass, email, id_status_user, position, online 
				FROM users WHERE user = ':user' AND pass = ':pass'";

		//Inizializar la conexion con la BD
		$self::getConnection();

		//Preparar la consulta parametrizada (Los parametros devueltos son user y pass desde el formulario)
		$result = $self::$cnx->prepare($query);

		//Los parametros son enviados el usuario desde los marcadores respectivos (:user y :pass)
		//desde el formulario y almacenados en el objeto $user y $pass
		$user_bd  = $user->getUser();
		$result->bindParam(":user",$user_bd);

		//el mismo valor del objeto user->password del usuario enviado hacia el marcador :pass
		$pass_bd = $user->getPass();
		$result->bindParam(":pass",$pass_bd);

		//Corremos o ejecutamos la consulta preparada con PDO
		$result->execute();

		//Para obtener el numero de filas resultantes
		/*
		Contabilizamos el resultado de la consulta, comprobando que sea verdadero (1)
		$result->rowCount() = 1 que es el valor devuelto, de valores encontrados en la ejecucion de la consulta
		 */
		if($result->rowCount() > 0){
			//retornamos el valor hacia un arreglo
			$data = $result->fetch();

			if($data['user'] == $user->getUser() && $data['pass']==$user->$user->getPass()){
				//Verifico el estatus del usuario que ingreso
				if($data['id_status_user'] <> 1){
					$status = true;
					return false;
				}

				$login = true;
				return $login;
			}

		}
		//En caso de que sea Negativo retornamos la bandera a negativo
		return false;
		

	}



}

