<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Modal</title>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="img/favicon.ico">

	    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	    <link href="css/dashboard.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>    
    	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="css/dashboard.css" rel="stylesheet">

        <script src="js/ie-emulation-modes-warning.js"></script>
	    



	    <script>
        /**
         * Abrimos la ventana modal para crear un nuevo elemento.
         * We open a modal window to create a new element.
         * @returns {undefined}
         */
        /*function newCbLanguage(){                 */
        function new_User(){                 
            /*openCbLanguage('new', null, null, null, null, null, null, null);*/
            openUser('new', null, null, null);
        }
        /**
         * Abrimos la ventana modal teniendo en cuenta la acción (action) para 
         * utilizarla como creación (Create), lectura (Read) o actualización (Update).
         * We opened the modal window considering the action (action) to use 
         * as creation (Create), reading (Read) or upgrade (Update).
         * @param {type} action las acciones que utilizamos son : new para Create, see para Read y edit para Update.
         *      Actions we use are :  new for Create, see for Read and edit for Update.
         * @param {type} id_user
         * @param {type} name
         * @param {type} user_name
         * @returns {undefined}
         */
        function openUser(action, id_user, name, user_name){    
            document.formNewUser.id_user.value = id_user;
            document.formNewUser.nombre.value = nombre;
            document.formNewUser.user_name.value = user_name;
            
             
            document.formNewUser.id_user.disabled = (action === 'see')?true:false;                
            document.formNewUser.nombre.disabled = (action === 'see')?true:false; 
            document.formNewUser.user_name.disabled = (action === 'see')?true:false; 
            
             
            $('#myModal').on('shown.bs.modal', function () {
                var modal = $(this);
                if (action === 'new'){                            
                    modal.find('.modal-title').text('Creación de idioma');  
                    $('#save-language').show();
                    $('#update-language').hide();                
                }else if (action === 'edit'){
                    modal.find('.modal-title').text('Actualizar idioma');
                    $('#save-language').hide();                    
                    $('#update-language').show();   
                }else if (action === 'see'){
                    modal.find('.modal-title').text('Ver Usuario');
                    $('#save-language').hide();   
                    $('#update-language').hide();   
                }
                $('#idlanguage').focus()
             
            });
        }        
         
    </script>



    </head>
    <body>
        <h2 class="sub-header">Usuarios</h2>

<?php
include './database/Connect.php';
include './controller/UserController.php';
$dConnect = new Connect;

$cdb = $dConnect->dbConnectSimple();
?>

 <!-- Añadimos un botón para el diálogo modal -->
          <!--   <button type="button"
            class="btn btn-lg btn-primary"
            data-toggle="modal"
            data-target="#myModal"
            onclick="newUser()">NUEVO</button>  -->

            <!-- Botón para el diálogo modal -->



<!--                    Ventana Modal.                       -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Creación de Usuario</h4>
            </div>
            <form role="form" name="formNewUser" method="post" action="index.php">
                <div class="modal-body">                                    
                    <div class="input-group">
                        <label for="id_user">ID</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" placeholder="es_ES (por ejemplo)" >
                        
                    </div>
                    <div class="input-group"> 
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group"> 
                        <label for="user_name">User</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Activo" aria-describedby="sizing-addon2">
                        
                    </div>                          
                    
                </div>
                <div class="modal-footer">
                    <button id="save-language" name="save-language" type="submit" class="btn btn-primary">Guardar</button>
                     
                    <button id="cancel"type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                                    
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    

<!--                    Ventana Modal.                       -->


<div class="table-responsive">
<table class="table table-striped"> 
<thead>           
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>USER</th>
            <th>ACCIONES</th>
        </tr>           
<thead>   
<tbody>  
	<form role="form" name="formUser" method="post" action="index.php">   
<?php   
    try {
        /*$query = "SELECT id_user, name, user_name FROM users;";
        $statement = $cdb->prepare($query);
        $result = $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_OBJ);
*/

		$userController = new UserController();
    	$userController->cdb = $cdb;  

        $rows = $userController->readAll();

        echo '<br />';
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php print($row->id_user); ?></td>
                <td><?php print($row->nombre); ?></td>
                <td><?php print($row->user_name); ?></td>
                <!-- <td>Boton Ver</td> -->
				<td>
                <button id="see-user" name="see-user" type="button" class="btn btn-primary"
        				data-toggle="modal"
        				data-target="#myModal"
        				onclick="openUser('see', 
                    '<?php print($row->id_user); ?>', 
                    '<?php print($row->nombre); ?>',
                    '<?php print($row->user_name); ?>')">
    			Ver</button>
				</td>

            </tr>    
<?php
        }
    } catch (Exception $exception) {
        echo 'Error hacer la consulta: ' . $exception;
    }
    ?>  
	</form>        
</tbody>      
</table>


</div>        



<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>-->

    <script src="js/jquery-1.12.4.min.js"></script>

    <script>window.jQuery || document.write('<script src="js/jquery-1.12.4.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>
    
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>




    </body>
</html>         