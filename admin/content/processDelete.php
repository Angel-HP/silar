<?php
include '../controller/UserController.php';
include '../help/helper.php';

?>


<div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Eliminar</h4>
              <p class="card-category">Usuarios</p>
            </div>
            <div class="card-body">



<!--   ---------------------- Begins Form Reg ---------------------   -->

<div class="card-body">
  <div class="row">
  <div class="">
    <h4 class="card-title">Eliminar usuarios</h4>
  </div>
</div>
  <br/>

<!--   ---------------------- Begins Content ---------------------   -->
<?php 

if(isset($_POST["update"])){
 
   if (isset($_POST['id_user']) and isset($_POST['id_priv']) and isset($_POST['id_status_user']) and isset($_POST['name']) and isset( $_POST['user_name']) and isset( $_POST['user_pass']) and isset($_POST['user_tel']) and isset($_POST['user_email']) and isset($_POST['user_position']) ) {

    
    $id_user          = validate_field($_POST['id_user']);
    $id_priv          = validate_field($_POST['id_priv']);
    $id_status_user   = validate_field($_POST['id_status_user']);
    $name             = validate_field($_POST['name']);
    $user_name        = validate_field($_POST['user_name']);
    $user_pass        = validate_field($_POST['user_pass']);
    $user_tel         = validate_field($_POST['user_tel']);
    $user_email       = validate_field($_POST['user_email']);
    $user_position    = validate_field($_POST['user_position']);


    
    
  } 
}

?>


              </div>


            </div>
          </div>
        </div>
      </div>