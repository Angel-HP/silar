<?php

class UserController {
	var $cdb = null;

	public function readAll(){
		$query = "SELECT id_user, name as nombre, user_name FROM users;";

		//Preparo consulta y ejecuto
		$statement = $this->cdb->prepare($query);
        $statement->execute();

        //Volcar el recultado a un array
        $rows = $statement->fetchAll(\PDO::FETCH_OBJ);

        return $rows;

	}//readAll

}//Class