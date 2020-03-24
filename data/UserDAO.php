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
	public static function disconnect(){
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

		/*$query = "SELECT id_user AS ID, name as Nombre, user_name as Usuario, id_priv, id_status_user FROM users;";*/
		$query = "SELECT A.id_user AS ID, A.name as Nombre, A.user_name as Usuario, B.privelege, C.desc_status_user, A.user_tel AS Telefono, A.user_email AS Email, A.user_position AS Puesto 
			FROM users A, priveleges B, status_user C 
			WHERE A.id_priv = B.id_priv AND A.id_status_user = C.id_status_user ORDER BY ID ASC;";

			


		self::getConnection();

		

		$result = self::$cnx->prepare($query);

		$result->execute();

		
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		

		if($result->rowCount() > 0){

		?>
		<div class="table-responsive">
		<table class="table table-striped"> 
		<thead>   

		       <!--  <tr>
		            <th style="text-align:center;">ID</th>
		            <th style="text-align:center;">NAME</th>
		            <th style="text-align:center;">USERNAME</th>
		            <th style="text-align:center;">ACCIONES</th>
		        </tr>           --> 
<!------------------------   Table Head Begins ------------------------->
		       <?php
		       echo '  
		       <tr>';

			foreach(range(0, $result->columnCount() - 2) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols - 6; $i++){
				echo '<th style="text-align:center;">' . $meta[$i]["name"] . '</td>';	
			}       		
			echo '<th style="text-align:center;">Acción</th>';

			echo '</tr>

		       ';


		       ?>
<!------------------------   Table Head Ends ------------------------->		       
		<thead>   
		<tbody>  
			<form role="form" name="formUser" method="post" action="index.php"> 
		<?php
		echo '<br />';
        for($filas = 0; $filas < $rows; $filas++){
        	$data = $result->fetch();
            ?>
            <tr>
                <td style="text-align:center;"><?php echo $data['ID']; ?></td>
                <td style="text-align:center;"><?php echo $data['Nombre']; ?></td>
                
                <!-- <td>Boton Ver</td> -->
				<td style="text-align:center;">
                <button id="see-user" name="see-user" type="button" class="btn btn-primary"
        				data-toggle="modal"
        				data-target="#myModal"
        				onclick="openUser('see', 
                    '<?php echo $data['ID']; ?>', 
                    '<?php echo $data['Nombre']; ?>',
                    '<?php echo $data['Usuario']; ?>',
                    '<?php echo $data['privelege']; ?>',
                    '<?php echo $data['desc_status_user']; ?>',
                    '<?php echo $data['Telefono']; ?>',
                    '<?php echo $data['Email']; ?>',
                    '<?php echo $data['Puesto']; ?>'
                    )">
    			Ver</button>
				</td>

            </tr>    
		<?php
        	}
        ?>
       </form>        
</tbody>      
</table>


</div>         

<?php		
    

return true;

		}else{

			echo 'Tabla vacia: ' . $exception;
			return false;
		}





	}//getTableUsers method


	public static function regUser($user){

		/*echo $user->getId_priv();
		echo "</br>";
		echo $user->getId_status_user();
		echo "</br>";
		echo $user->getName();
		echo "</br>";
		echo $user->getUser_name();
		echo "</br>";
		echo $user->getUser_pass();
		echo "</br>";
		echo $user->getUser_tel();
		echo "</br>";
		echo $user->getUser_email();
		echo "</br>";
		echo $user->getUser_position();*/


		/*$id_priv 			= $user->getId_priv();	
		$id_status_user 	= $user->getId_status_user();
		$id_history			= 0;
		$name 				= $user->getName();	
		$user_name 			= $user->getUser_name();	
		$user_pass 			= $user->getUser_pass();	
		$user_tel 			= $user->getUser_tel();	
		$user_email 		= $user->getUser_email();	
		$user_position 		= $user->getUser_position();
		$online				= 0;*/


		/*$insertUser = "INSERT INTO `users` (`id_user`, `id_priv`, `id_status_user`, `id_history`, `name`, `user_name`, `user_pass`, `user_tel`, `user_email`, `user_position`, `online`) VALUES (NULL, '$id_priv', '$id_status_user', '$id_history', '$name', '$user_name', '$user_pass', '$user_tel', '$user_email', '$user_position', '$online');";*/

		$insertUser = "INSERT INTO `users` (`id_user`, `id_priv`, `id_status_user`, `id_history`, `name`, `user_name`, `user_pass`, `user_tel`, `user_email`, `user_position`, `online`) 
		VALUES (NULL, :id_priv, :id_status_user, :id_history, :name, :user_name, :user_pass, :user_tel, :user_email, :user_position, :online);";


		self::getConnection();

		$result = self::$cnx->prepare($insertUser);


		$id_priv 			= $user->getId_priv();	
		$result->bindParam(":id_priv", $id_priv);

		$id_status_user 	= $user->getId_status_user();
		$result->bindParam(":id_status_user", $id_status_user);

		$id_history			= 0;
		$result->bindParam(":id_history", $id_history);

		$name 				= $user->getName();	
		$result->bindParam(":name", $name);

		$user_name 			= $user->getUser_name();	
		$result->bindParam(":user_name", $user_name);

		$user_pass 			= $user->getUser_pass();	
		$result->bindParam(":user_pass", $user_pass);

		$user_tel 			= $user->getUser_tel();	
		$result->bindParam(":user_tel", $user_tel);

		$user_email 		= $user->getUser_email();	
		$result->bindParam(":user_email", $user_email);

		$user_position 		= $user->getUser_position();
		$result->bindParam(":user_position", $user_position);

		$online 			= '0';
		$result->bindParam(":online", $online);


		if($result->execute()){

			echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Listo - </b> Se registro la información correctamente...
                  </div>';

    
    		echo"<meta HTTP-EQUIV='Refresh' CONTENT='2; URL=index.php'<head/>";

			
			self::disconnect();
			
			return true;
		}else{
			return false;
		}



	} //regUser method


	public static function getTableUsersEdit($action){

		/*$query = "SELECT id_user AS ID, name as Nombre, user_name as Usuario, id_priv, id_status_user FROM users;";*/
		$query = "SELECT A.id_user AS ID, A.name as Nombre, A.user_name as Usuario, B.privelege, C.desc_status_user, A.user_tel AS Telefono, A.user_email AS Email, A.user_position AS Puesto 
			FROM users A, priveleges B, status_user C 
			WHERE A.id_priv = B.id_priv AND A.id_status_user = C.id_status_user ORDER BY ID ASC;";

			


		self::getConnection();

		

		$result = self::$cnx->prepare($query);

		$result->execute();

		
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		

		if($result->rowCount() > 0){

		?>
		<div class="table-responsive">
		<table class="table table-striped"> 
		<thead>   

		       <!--  <tr>
		            <th style="text-align:center;">ID</th>
		            <th style="text-align:center;">NAME</th>
		            <th style="text-align:center;">USERNAME</th>
		            <th style="text-align:center;">ACCIONES</th>
		        </tr>           --> 
<!------------------------   Table Head Begins ------------------------->
		       <?php
		       echo '  
		       <tr>';

			foreach(range(0, $result->columnCount() - 2) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols - 6; $i++){
				echo '<th style="text-align:center;">' . $meta[$i]["name"] . '</td>';	
			}       		
			echo '<th style="text-align:center;">Acción</th>';

			echo '</tr>

		       ';


		       ?>
<!------------------------   Table Head Ends ------------------------->		       
		<thead>   
		<tbody>  
			<form role="form" name="formUser" method="post" action="index.php"> 
		<?php
		echo '<br />';
        for($filas = 0; $filas < $rows; $filas++){
        	$data = $result->fetch();
            ?>
            <tr>
                <td style="text-align:center;"><?php echo $data['ID']; ?></td>
                <td style="text-align:center;"><?php echo $data['Nombre']; ?></td>
                
                <!-- <td>Boton Ver</td> -->
			<?php

			$edit = '<a class="btn btn-warning btn-sm" href="action.php?id=12&u='. $data['ID'] .'">Editar</a>';

			?>
				<td style="text-align:center;">

			<?php

			echo $edit;

			?>

				</td>

            </tr>    
		<?php
        	}
        ?>
       </form>        
</tbody>      
</table>


</div>         

<?php		
    

return true;

		}else{

			echo 'Tabla vacia: ' . $exception;
			return false;
		}


}//getTableUsers method


public function getUserData($user){

$query = "SELECT A.id_priv, B.privelege, A.id_status_user, C.desc_status_user, A.name, A.user_name, A.user_tel, A.user_email, A.user_position 
	FROM users A, priveleges B, status_user C 
	WHERE A.id_priv = B.id_priv AND A.id_status_user = C.id_status_user AND A.id_user = :id_user";

self::getConnection();

	$result = self::$cnx->prepare($query);

	$id_user 			= $user->getId_user();	
	$result->bindParam(":id_user", $id_user);

$result->execute();


$data = $result->fetch();

$user = new User();

$user->setId_priv($data["id_priv"]);
$user->setPrivelege($data["privelege"]);
$user->setId_status_user($data["id_status_user"]);
$user->setDesc_status_user($data["desc_status_user"]);
$user->setName($data["name"]);
$user->setUser_name($data["user_name"]);
$user->setUser_tel($data["user_tel"]);
$user->setUser_email($data["user_email"]);
$user->setUser_position($data["user_position"]);


self::disconnect();

	
	//Retornamos el objeto $user
	return $user;


}//getUserData method

public static function updateUser ($user){

$updatetUser = "UPDATE `users` SET `id_user` = :id_user , `id_priv` = :id_priv, `id_status_user` = :id_status_user, `name` = :name, `user_name` = :user_name, `user_tel` = :user_tel , `user_email` = :user_email, `user_position` = :user_position WHERE `users`.`id_user` = :id_user";


//echo "<br/>" . $query;
		self::getConnection();

		$result = self::$cnx->prepare($updatetUser);

		$id_user 			= $user->getId_user();	
		$result->bindParam(":id_user", $id_user);

		$id_priv 			= $user->getId_priv();	
		$result->bindParam(":id_priv", $id_priv);

		$id_status_user 	= $user->getId_status_user();
		$result->bindParam(":id_status_user", $id_status_user);

		$name 				= $user->getName();	
		$result->bindParam(":name", $name);

		$user_name 			= $user->getUser_name();	
		$result->bindParam(":user_name", $user_name);

		$user_tel 			= $user->getUser_tel();	
		$result->bindParam(":user_tel", $user_tel);

		$user_email 		= $user->getUser_email();	
		$result->bindParam(":user_email", $user_email);

		$user_position 		= $user->getUser_position();
		$result->bindParam(":user_position", $user_position);


		if($result->execute()){

			echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Listo - </b> Se actualizo la información correctamente...
                  </div>';

    
    		echo"<meta HTTP-EQUIV='Refresh' CONTENT='2; URL=index.php'<head/>";

			
			self::disconnect();
			
			return true;
		}else{
			return false;
		}



}//updateUser METHOD


public static function getTableUserDelete($action){


			
$query = "SELECT A.id_user AS ID, A.name as Nombre, A.user_name as Usuario, B.privelege, C.desc_status_user, A.user_tel AS Telefono, A.user_email AS Email, A.user_position AS Puesto 
		FROM users A, priveleges B, status_user C 
		WHERE A.id_priv = B.id_priv AND A.id_status_user = C.id_status_user ORDER BY ID ASC;";

	self::getConnection();

	$result = self::$cnx->prepare($query);

	$result->execute();

	$rows = $result->rowCount();
	$cols = $result->columnCount();

	if($result->rowCount() > 0){

	?>
	<div class="table-responsive">
	<table class="table table-striped"> 
	<thead>   

<!------------------------   Table Head Begins ------------------------->
<?php
	echo '  
	<tr>';

	foreach(range(0, $result->columnCount() - 2) as $column_index){
		$meta[] = $result->getColumnMeta($column_index);
	}

	for ($i=0; $i < $cols - 6; $i++){
		echo '<th style="text-align:center;">' . $meta[$i]["name"] . '</td>';	
	}       		
		echo '<th style="text-align:center;">Acción</th>';

	echo '</tr>

	';

?>
<!------------------------   Table Head Ends ------------------------->		       
	<thead>   
	<tbody>  
		<!--<form role="form" name="formUser" method="post" action="index.php"> -->
	<?php
	echo '<br />';
    for($filas = 0; $filas < $rows; $filas++){
    	$data = $result->fetch();

    	$id = $data['ID'];
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $data['ID']; ?></td>
            <td style="text-align:center;"><?php echo $data['Nombre']; ?></td>
            
            <!-- <td>Boton Editar</td> -->
		<?php

		//$delete = '<a class="btn btn-danger btn-sm" href="op.php?id=22&u='. $data['ID'] .'">Eliminar</a>';
		//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'op.php?id=22&u='. $data['ID'] .'\')">Eliminar</button>';
		$delete = '<button class="btn btn-danger btn-sm" type="submit" id="eliminar" onclick="confirmar(\'action.php?id=22&u=' . $id . '\')">Eliminar</button>';

		?>
			<td style="text-align:center;">

	<div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					
					<!-- <button type="submit" class="btn btn-danger btn-sm confirmar"> Eliminar<?php echo $id; ?></button>  -->

					<?php

					echo $delete;

					?>
				
				</div>
			</div>
		</div>
	</div>








			</td>

        </tr>    
	<?php
    	}
    ?>
   <!--</form>-->        

<!-- <script type="text/javascript">
                        $('.confirmar').on('click',function(){
                            $.confirm({
                            	

                            	confirmButtonClass: 'btn-success',
    							
    							cancelButtonClass: 'btn-danger',

                                title: 'Delete user?',
                                content: 'This dialog will automatically trigger \'cancel\' in 5 seconds if you don\'t respond.',
                                autoClose: 'cancel|5000',
	                                confirm: function(){
	                                    /*alert('confirmed');*/
	                                },
	                                cancel:function(){
	                                    /*alert('cancelled');*/
	                                }
                            });
                        });
                        
                        </script> -->


  <script>

function confirmar(url){
  $.confirm({

  	confirmButtonClass: 'btn-danger',
    cancelButtonClass: 'btn-success',
    title: '¿Deseas eliminar este registro?',
    content: 'Se eliminará completamente del sistema. \n Si elimino por error, esta acción se cancelara en 5 segundos.', 
    theme: 'modern', //modern, material, bootstrap, supervan
    autoClose: 'cancel|5000',
        confirm: function(){
        	/*action: function() {*/
          		window.location.href=url;
        	//}        	
            /*alert('confirmed');*/
        },
        cancel:function(){
        	
            //alert('cancelled');
        }




  });
}  	


 </script>






</tbody>      
</table>


</div>         

<?php		

return true;

	}else{

		echo 'Tabla vacia: ' . $exception;
		return false;
	}


}//getTableUsers method

public static function deleteUser($user){

	//$userDelete="DELETE FROM `users` WHERE `users`.`id_user`";
	$updatetUser = "UPDATE `users` SET `id_status_user` = :id_status_user WHERE `users`.`id_user` = :id_user";

	self::getConnection();

		$result = self::$cnx->prepare($updatetUser);

		$id_user 			= $user->getId_user();	
		$result->bindParam(":id_user", $id_user);

		$id_status_user 	= 0;
		$result->bindParam(":id_status_user", $id_status_user);

		if($result->execute()){

			echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Listo - </b> Se elimino correctamente el registro...
                  </div>';

    
    		echo"<meta HTTP-EQUIV='Refresh' CONTENT='2; URL=index.php'<head/>";

			
			self::disconnect();
			
			return true;
		}else{
			return false;
		}





} //deleteUser method

	public static function getTablePass($user){

	$query = "SELECT id_user as ID, name as Nombre FROM users WHERE id_user <> '1' ORDER BY id_user";

	self::getConnection();

	$result = self::$cnx->prepare($query);

	$result->execute();

	$rows = $result->rowCount();
	$cols = $result->columnCount();

	if($result->rowCount() > 0){

	?>
	<div class="table-responsive">
	<table class="table table-striped"> 
	<thead>   


<?php
	echo '  
	<tr>';

	foreach(range(0, $result->columnCount() - 2) as $column_index){
		$meta[] = $result->getColumnMeta($column_index);
	}

	/*for ($i=0; $i < $cols - 6; $i++){

		echo '<th style="text-align:center;">' . $meta[$i]["name"] . '</td>';	
	} */      		
		echo '<th style="text-align:center;">ID</th>';
		echo '<th style="text-align:center;">Nombre</th>';
		
		echo '<th style="text-align:center;">Acción</th>';

	echo '</tr>

	';

?>
<!------------------------   Table Head Ends ------------------------->		       
	</thead>   
	<tbody>  
		<!--<form role="form" name="formUser" method="post" action="index.php"> -->
	<?php
	//echo '<br />';
    for($filas = 0; $filas < $rows; $filas++){
    	$data = $result->fetch();

    	$id = $data['ID'];
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $data['ID']; ?></td>
            <td style="text-align:center;"><?php echo $data['Nombre']; ?></td>
           
            
            <!-- <td>Boton Editar</td> -->
		<?php

		$pass = '<a class="btn btn-warning btn-sm" href="action.php?id=32&u='. $data['ID'] .'">Cambiar Password</a>';
		?>
		
			<td style="text-align:center;">

	
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					
					
					<?php

					echo $pass;

					?>
				
				</div>
			</div>
		</div>

	








			</td>

        </tr>    
	<?php
    	}
    ?>
  





</tbody>      
</table>


</div>         

<?php		

return true;

	}else{

		echo 'Tabla vacia: ' . $exception;
		return false;
	}

			


		
}//getTablePass





}//UserDAO Class

