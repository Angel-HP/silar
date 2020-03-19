<?php
//include '../controller/UserController.php';
//include '../help/helper.php';

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

//if(isset($_REQUEST["eliminar"])){
 

 $id = $_GET['u'];

echo "El usuario a eliminar es: " . $id;

//invocar a un controlador que llame al objeto para eliminar el registro especifico


    
    
  
//}






?>


              </div>


            </div>
          </div>
        </div>
      </div>