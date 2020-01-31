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
		self::$cnx = Connect::conn();

	}

	//Definir la desconexion a la BD
	private static function disconnect(){
		self::$cnx = NULL;	
		
	}

	//Localizar datos en la BD del Usuario de Login
	public static function login($user){
		//Una consulta es generada por los campos seleccionado que seran enviados sin comprometer la seguridad del sistema, tal como datos visibles via HTML, Inyeccion de SQL o Js y CrosSiteScripting

		$query = "SELECT id_user, id_priv, name, user_name, user_pass, user_email, id_status_user, user_position, online FROM users WHERE user_name = :user_name AND user_pass = :user_pass";
		

		//Inizializar la conexion con la BD
		self::getConnection();

		//Preparar la consulta parametrizada (Los parametros devueltos son user y pass desde el formulario)
		$result = self::$cnx->prepare($query);

		//Los parametros son enviados el usuario desde los marcadores respectivos (:user y :pass)
		//desde el formulario y almacenados en el objeto $user y $pass
		$user_bd  = $user->getUser_name();
		$result->bindParam(":user_name",$user_bd);

		//el mismo valor del objeto user->password del usuario enviado hacia el marcador :pass
		$pass_bd = $user->getUser_pass();
		$result->bindParam(":user_pass",$pass_bd);


		

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




			if($data['user_name'] == $user->getUser_name() && $data['user_pass'] == $user->getUser_pass()){

				
				//Verifico el estatus del usuario que ingreso
				if($data['id_status_user'] <> 1){
					$status = true;
					return false;
				}

				
				$login = true;
				return $login;
				
				
				//cerramos la conexion activa con la BD
				self::disconnect();
			}
			return true;

		}
		//En caso de que sea Negativo retornamos la bandera a negativo
		return false;
		
	}//Metodo Login

	public static function logout(){
		self::disconnect();
	}

	public static function getUser($user){

		$query = "SELECT id_user, id_priv, name, user_name, user_pass, user_email FROM users WHERE
		user_name = :user_name and user_pass = :user_pass";

		self::getConnection();

		$result = self::$cnx->prepare($query);

		$user_bd = $user->getUser_name();
		$result->bindParam(":user_name", $user_bd);

		$pass_bd = $user->getUser_pass();
		$result->bindParam(":user_pass", $pass_bd);

		$result->execute();

		$data = $result->fetch();
       

		$user = new User();
		//Para enviar la información a la validacion y visualizacion de datos del usuario autentificado
		//lo cargaremos desde el objeto del usuario a traves de su instancia de objeto de la entidad usuarios.
		$user->setId_user($data["id_user"]);
		$user->setId_priv($data["id_priv"]);
		$user->setName($data["name"]);
		$user->setUser_name($data["user_name"]);
		$user->setUser_pass($data["user_pass"]);
		$user->setUser_email($data["user_email"]);

		
		self::disconnect();

		//Retornamos los vaores al objeto User
		return $user;



	}//Metodo getUser


	public static function changeIn($user){

		$idUser = $user->getId_user();

		$updateIn = "UPDATE `users` SET `online` = '1' WHERE `users`.`id_user` = '$idUser'";

		self::getConnection();

		$result = self::$cnx->prepare($updateIn);

		//$idUser = $user->getId_user();
		//$result->bindParam(":id_user", $idUser);

		if($result->execute()){
			
			self::disconnect();
			
			return true;
		}else{
			return false;
		}

	}//Metodo ChangeIn

   public static function changeOut($user){

		$idUser = $user->getId_user();

		$updateOut = "UPDATE `users` SET `online` = '0' WHERE `users`.`id_user` = '$idUser'";

		self::getConnection();

		$result = self::$cnx->prepare($updateOut);

		//$idUser = $user->getId_user();
		//$result->bindParam(":id_user", $idUser);

		if($result->execute()){
			
			self::disconnect();
			
			return true;
		}else{
			return false;
		}

	}//Metodo ChangeOut

	//Listar Usuarios
	public static function listUser($user){

		$query = "SELECT id_user, name, user_name FROM users";		

		self::getConnection();

		$result = self::$cnx->prepare($query);



		$result->execute();

		$data = $result->fetch();
       

		$user = new User();
		
		$user->setId_user($data["id_user"]);
		$user->setName($data["name"]);
		$user->setUser_name($data["user_name"]);

		
		self::disconnect();

		//Retornamos los vaores al objeto User
		return $user;


	}//Metodo getUser


	public static function getTableUsers($action){

		$query = "SELECT id_user as ID, name as Nombre, user_name as Usuario FROM users";

		//Establezco la conexion con la BD
		self::getConnection();

		//Preparo la sentencia SQL
		$result = self::$cnx->prepare($query);

		//Se ejecuta la consulta
		$result->execute();

		//Se obtienen el numero de filas y el numero de columnas
		$rows = $result->rowCount();
		$cols = $result->columnCount();

		//echo "Filas: " . $rows;
		/*echo "<br/>";
		echo "Columnas: " . $cols;*/

		//Si existen datos en la tabla
		if($rows > 0){
			echo '<table class="table">';
			echo '<thead class=" text-primary">
			<tr>';

			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols; $i++){
				echo '<th>' . $meta[$i]["name"] . '</td>';	
			}       		
			echo '<th style="text-align:center;">Acción</th>';

			echo '</tr>
			</thead>
			<tbody>';


			for($filas = 0; $filas < $rows; $filas++){
				$data = $result->fetch();
				echo '<tr>';

				for($columns = 0; $columns < $cols; $columns++){
					echo '<td>' . $data[$columns] .'</td>';
				}

			$id = $data["ID"];
			/*$detail = '<a class="btn btn-primary btn-sm" href="action.php?a=4&b='. $id .'">Detalles de ' . $data["Nombre"] . '</a>';	*/


			$detail = '<button type="button" class="btn btn-primary detail" value="' . $id . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-screenshot">' . $data["ID"] .'</span> </button>';

			echo '<td class="text-center">' . $detail . '</td>';




			echo '</tr>';


			}

			echo "</tbody></table><br/>";









		}else{
			echo "No hay usuarios en la BD o existe un error en la consulta";
		}

		//free memory
		self::disconnect();



	}//getTableUser


}

