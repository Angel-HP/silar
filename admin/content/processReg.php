<?php

  include '../controller/UserController.php';

?>


<div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Registro</h4>
              <p class="card-category">Usuarios</p>
            </div>
            <div class="card-body">



<!--   ---------------------- Begins Form Reg ---------------------   -->

<div class="card-body">
	<div class="row">
	<div class="">
		<h4 class="card-title">Datos del Usuario</h4>
	</div>
</div>
	<br/>

<!--   ---------------------- Begins Content ---------------------   -->
<?php  	

if(isset($_POST['save'])){

  if (isset($_POST['id_priv']) and isset($_POST['id_status_user']) and isset($_POST['name']) and isset( $_POST['user_name']) and isset($_POST['user_pass']) and isset($_POST['user_tel']) and isset($_POST['user_email']) and isset($_POST['user_position']) ) {

    $id_priv = $_POST['id_priv'];
    $id_status_user = $_POST['id_status_user'];
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $user_pass = $_POST['user_pass'];
    $user_tel = $_POST['user_tel'];
    $user_email = $_POST['user_email'];
    $user_position = $_POST['user_position'];


    /*echo "<h1>Datos obtnidos del formulario</h1>";

    echo "Privilegio: " . $id_priv . "</br>";
    echo "Estatus: " . $id_status_user . "</br>";
    echo "Nombre: " . $name . "</br>";
    echo "Nombre de Usuario: " . $user_name . "</br>";
    echo "Contraseña: " . $user_pass . "</br>";
    echo "Telefono: " . $user_tel . "</br>";
    echo "Correo Electronico: " . $user_email . "</br>";
    echo "Puesto: " . $user_position . "</br>";


    echo "<h2>Datos en el objeto USUARIO</h2>";*/
    UserController::regUser($id_priv, $id_status_user, $name, $user_name, $user_pass, $user_tel, $user_email, $user_position);




    
  }else{
    echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Alerta - </b> No se registro la información correctamente...
                  </div>';

    //echo '<span class="label label-info">No se registro la información correctamente...</span>';
    //echo"<meta HTTP-EQUIV='Refresh' CONTENT='2; URL=index.php'<head/>";
  }


}else{

    //echo '<p>Panel de Control | <span class="label label-info">No se recibieron datos desde el formulario...</span>';
    echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Alerta - </b> No se recibieron datos desde el formulario...
                  </div>';
    echo"<meta HTTP-EQUIV='Refresh' CONTENT='2; URL=index.php'<head/>";
  }












?>

<!--   ---------------------- Ends Content ---------------------   -->

	            </div>
              




<!--   ---------------------- Ends Form Reg ---------------------   -->



              <section class="invoice">
  <!-- title row -->
  <div class="">
    <div class="col-xs-12">
      <div class="">
        <div class="card-category">

          <center>
          

          <!-- <h3 class="page-header">
            <i class="material-icons">arrow_forward_ios </i> Registro de Documentos </h3>  -->

<div class="card-body">
  <div class="table-responsive">







 <!--         
    <table class="table">
        <thead class=" text-primary">
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Usuario
                </th>
                
                <th class="text-right">
                    Detalle
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                  N
                </td>
                <td>
                    Niger
                </td>
                
                <td class="text-right">
                    $36,738
                </td>
            </tr>
            
        </tbody>
    </table>
-->

</div>

        </div>



      </div>
      
    </div>
    <!-- /.col -->
  </div>


  <div class="row">
      
  </div>



<!--   <div class="row invoice-info">
  <div class="col-xs-12">
      <p class="lead text-center">Registro</p>
    </div>
    


  </div> -->
















</section>






            </div>
          </div>
        </div>
      </div>