


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
<div class="row">
  <div class="col-md-6">
    
    <div class="alert alert-primary">

  <div class="form-group">
    <label for="id_priv"><b>Privilegio</b></label>
    <select name="id_priv" id="id_priv" class="form-control" required="required"  >
      <option value='1 '> Administrador</option>
      <option value="2">Desarrollador</option>
      <option value="3">Usuario</option>
      </select>
    </div>


  <div class="form-group">
    <label for="id_status_user"><b>Estado</b></label>
      <select name="id_status_user" id="id_status_user" class="form-control" required="required"  >
        <option value='1 '> Activo</option>
        <option value="2">Baja</option>
      </select>
    </div>


    <div class="form-group">
      <label class="" for="name"><b> Nombre</b></label> 
        <div class="">
          <input type="text" name="name" class="col-md-12" id="name"   value="Angel" maxlength="" size="" style=""     placeholder="Escriba su Nombre" required  autocomplete="off" />
        </div>
    </div>
                
    <div class="space">&nbsp;</div>

    <div class="form-group">
      <label class="" for="user_name"><b> Usuario</b></label> 
        <div class="">
          <input type="text" name="user_name" class="col-md-12" id="user_name"   value="angel" maxlength="" size="" style=""     placeholder="Nombre de Usuario" required  autocomplete="off" />
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


  <div class="form-group">
    <label class="" for=" user_tel "><b> Telefono</b></label>
  <div class="">  
      <input type="tel" name="user_tel" class="col-md-12" id=" user_tel"   value="123456789" maxlength=10size=10style=     placeholder="Numero telefónico..." required autofocus/>
    </div>
  </div>


  <div class="space">&nbsp;</div>

 <div class="form-group">
      <label class="" for=" user_email "><b> Correo Electrónico</b></label>
     <div class="">    
        <input type="email" name="user_email" class="col-md-12" id=" user_email"   value="angelhpjuli@gmail.com" maxlength=size=style=     placeholder="Escriba su email..." required autofocus/>
     </div>
 </div>



  <div class="form-group">
    <label class="" for="user_position"><b> Puesto</b></label> 
    <div class="">
      <input type="text" name="user_position" class="col-md-12" id="user_position"   value="Administrador" maxlength="" size="" style=""     placeholder="Puesto del usuario" required  autocomplete="off" />
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