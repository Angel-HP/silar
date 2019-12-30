<?php
//Despues de generar la entidad creamos el controlador
//importamos UserDAO Data Access Object -> POO Objeto de Acceso a Datos del Usuario para 
//utilizarlo en la clase definida de acceso de usuario

include '../data/UserDAO.php';
class UserController{
	//Se define el login con dos parametros, usuario y contraseña a traves de un objeto que enviara los datos
	//para su validación
	public static function login($user, $pass){
		//Inizializamos un objeto para enviar valores (usuario y contraseña)
		$obj_user = new User();

		//*Enviamos el objeto User desde la aplicacion (formulario)
		$obj_user->setUser($user);
		$obj_user->setPass($pass);

		/*La clase nos envia por metodo (login), los parametros al objeto (obj_user) los valores recibidos del
			formulario (user. pass), nos devuelve el resultado de la operacion (true, false)
		*/
		return UserDAO::login($obj_user);
	}
	public function getUser($user, $pass){
		$obj_user = new User();

		$obj_user->getUser($user);
		$obj_user->getUser($pass);

		return UserDAO::getUser($obj_user);
	}

}