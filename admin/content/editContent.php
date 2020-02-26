


<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Edición</h4>
        <p class="card-category">Usuarios</p>
      </div>
<div class="card-body">



<!--   ---------------------- Begins Form Reg ---------------------   -->

<?php

include '../sql/Combo.php';

?>

<div class="card-body">
  <div class="row">
  <div class="">
    <h4 class="card-title">Actualice la información del usuario</h4>
  </div>
</div>
  <br/>


<?php

if(isset($_GET['u'])){

?>  

<!--    <form name="regContent_submit" method="POST" action="action.php?id=3" accept-charset="utf-8"> -->
<form name="regContent_submit" method="POST" action="op.php?id=13" accept-charset="utf-8"><input type="hidden" value="1" name="id_user" />  

<?php

$id_user = $_GET['u'];




?>

<div class="row">
  <div class="col-md-6">
    
    <div class="alert alert-primary">

  <input type="hidden" value="<?php echo $id_user  ?>" name="id_user">


<?php


$user = UserController::getUserData($id_user);

?>


<?php





?>   



  <div class="form-group">
    <!-- <label for="id_priv"><b>Privilegio</b></label> -->
    <?php

    //echo $id_priv . "<br/>";
    $position = $user->getId_priv();
    $desc_position = $user->getPrivelege();

    $val_position = $position . " - " . $desc_position; 

    //echo $val_position;
    $query = "SELECT id_priv, privelege FROM priveleges EXCEPT WHERE id_priv <> '$position' ORDER BY id_priv";

    $combo = new combo($query,"id_priv","id_priv", $val_position, "Privilegio","required","","","1");



    ?>
    <!-- <select name="id_priv" id="id_priv" class="form-control" required="required"  >
      <option value='1 '> Administrador</option>
      <option value="2">Desarrollador</option>
      <option value="3">Usuario</option>
      </select> -->
    </div>


  <div class="form-group">
    <!-- <label for="id_status_user"><b>Estado</b></label> -->
    <?php

    //echo $id_priv . "<br/>";
    $status = $user-> getId_status_user();
    $desc_status = $user->getDesc_status_user();

    $val_status = $status . " - " . $desc_status;

    $query = "SELECT id_status_user, desc_status_user FROM status_user EXCEPT WHERE id_status_user <> '$status' ORDER BY id_status_user";
     $combo = new combo($query,"id_status_user","id_status_user", $val_status, "Estado","required","","","1");
    



    ?><!-- 
      <select name="id_status_user" id="id_status_user" class="form-control" required="required"  >
        <option value='1 '> Activo</option>
        <option value="2">Baja</option>
      </select> -->
    </div>

<?php

$name = $user->getName();
?>    

    <div class="form-group">
      <label class="" for="name"><b> Nombre</b></label> 
        <div class="">
          <input type="text" name="name" class="col-md-12" id="name"   value="<?php echo $name  ?>" maxlength="" size="" style=""     placeholder="Escriba su Nombre" required  autocomplete="off" />
        </div>
    </div>
                
    <div class="space">&nbsp;</div>

<?php


$user_name = $user->getUser_name();
?>

    <div class="form-group">
      <label class="" for="user_name"><b> Usuario</b></label> 
        <div class="">
          <input type="text" name="user_name" class="col-md-12" id="user_name"   value="<?php echo $user_name  ?>" maxlength="" size="" style=""     placeholder="Nombre de Usuario" required  autocomplete="off" />
       </div>
    </div>



  <div class="space">&nbsp;</div>
    </div>
            
  </div>
          
  <div class="col-md-6">
            
  <div class="alert alert-primary">
  
  <div class="form-group">
    <label class="" for="user_pass"><b> Password</b></label> 
    <div class="">
      <input type="password" name="user_pass" class="col-md-12" id=" user_pass"  disabled value="" maxlength="" size="" style=""  placeholder="**********" required autofocus/>
    </div>
  </div>


<?php

$user_tel = $user->getUser_tel();

?>

  <div class="form-group">
    <label class="" for=" user_tel "><b> Telefono</b></label>
  <div class="">  
      <input type="tel" name="user_tel" class="col-md-12" id=" user_tel"   value="<?php echo $user_tel  ?>" maxlength=10size=10style=     placeholder="Numero telefónico..." required autofocus/>
    </div>
  </div>


  <div class="space">&nbsp;</div>



<?php

$user_email = $user->getUser_email();

?>

 <div class="form-group">
      <label class="" for=" user_email "><b> Correo Electrónico</b></label>
     <div class="">    
        <input type="email" name="user_email" class="col-md-12" id=" user_email"   value="<?php echo $user_email  ?>" maxlength=size=style=     placeholder="Escriba su email..." required autofocus/>
     </div>
 </div>


<?php

$user_position = $user->getUser_position();

?>
  <div class="form-group">
    <label class="" for="user_position"><b> Puesto</b></label> 
    <div class="">
      <input type="text" name="user_position" class="col-md-12" id="user_position"   value="<?php echo $user_position  ?>" maxlength="" size="" style=""     placeholder="Puesto del usuario" required  autocomplete="off" />
    </div>
  </div>


  <div class="space">&nbsp;</div>      
                
 </div>

</div>

</div>

<div class="alert alert-primary">
<center>
              
<button type="submit" name="update" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Registrar"><i class="fa fa-save"></i> &nbsp;&nbsp;Actualizar Información</button>              
</center>
</div>

<!--    </form>  -->
</form>



<?php 
}else{


      echo '<div class="alert alert-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Advertencia - </b> No hay información para actualizar...
                  </div>';

      echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
}
?>


</div>
           

<!--   	<form name="regContent_submit" method="POST" action="action.php?id=3" accept-charset="utf-8"> -->




</div>
           

<!--   ---------------------- Ends Form Reg ---------------------   -->


      </div>
    </div>
  </div>
</div>