<?php
//Despues de generar la entidad creamos el controlador
//importamos UserDAO Data Access Object -> POO Objeto de Acceso a Datos del Usuario para 
//utilizarlo en la clase definida de acceso de usuario

include '../data/UserDAO.php';
class UserController{
	//Se define el login con dos parametros, usuario y contraseña a traves de un objeto que enviara los datos
	//para su validación
	public static function login($user_name, $user_pass){
		//Inizializamos un objeto para enviar valores (usuario y contraseña)
		$obj_user = new User();

		//*Enviamos el objeto User desde la aplicacion (formulario)
		$obj_user->setUser_name($user_name);
		$obj_user->setUser_pass($user_pass);


		/*La clase nos envia por metodo (login), los parametros al objeto (obj_user) los valores recibidos del
			formulario (user. pass), nos devuelve el resultado de la operacion (true, false)
		*/
		return UserDAO::login($obj_user);
		
	}

	public static function logout(){
		
		return UserDAO::logout();
	}

	public function getUser($user_name, $user_pass){
		$obj_user = new User();

		$obj_user->setUser_name($user_name);
		$obj_user->setUser_pass($user_pass);

		return UserDAO::getUser($obj_user);
	}

	public function changeIn($idUser){
		$obj_user = new User();

		$obj_user->setId_user($idUser);

		return UserDAO::changeIn($obj_user);
	
	}
	
	public function changeOut($iduser){
		$obj_user = new User();

		$obj_user->setId_user($iduser);

		return UserDao::changeOut($obj_user);

	}


	//Listar Usuarios
	public function getTableUsers($user){
		$obj_user = new User();

		$obj_user->setId_user($user);

		return UserDAO::getTableUsers($obj_user);
	}



	

	}//Class UserController

	
	

