<div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Listado</h4>
              <p class="card-category">Usuarios</p>
            </div>
            <div class="card-body">



<!--   ---------------------- Begins Form Reg ---------------------   -->

<div class="card-body">
	<div class="row">
	<div class="">
		<h4 class="card-title">Formulario</h4>
	</div>
</div>
	<br/>

  	<form name="regContent_submit" method="POST" action="action.php?id=3" accept-charset="utf-8">
  			

        <div class="row">
          <div class="col-md-6">
            
            <div class="alert alert-primary">



                    <?php

                    
                      $query = "SELECT id_priv, privelege FROM `priveleges`";

                      $combo = new combo($query, "id_priv", "", "", "PRIVILEGIO ")

                      ?>
                      <?php
                      $query ="SELECT id_status_user, desc_status_user FROM `status_user` ";

                      $combo = new combo($query, "id_status_user", "", "", "ESTADO" )
                      ?>

            

              
              <div class="form-group">
                <label class="" for="name"><b> Nombre</b></label> 
                <div class="">
                  <input type="text" name="name" class="col-md-12" id="name" value="" maxlength="" size="" style="" placeholder="Escriba su Nombre" required="" autocomplete="off" autofocus="autofocus">
                </div>
              </div>

              <div class="form-group">
                <label class="" for="user_name"><b>Usuario</b></label> 
                <div class="">
                  <input type="text" name="user_name" class="col-md-12" id="user_name" value="" maxlength="" size="" style="" placeholder="Nombre de Usuario" required="" autocomplete="off" autofocus="autofocus">
                </div>
              </div>

            </div>
            
            
            
          </div>
          
          <div class="col-md-6">
            
            

            <div class="alert alert-primary">
              
              <div class="form-group">
                <label class="" for="user_pass"><b>Password</b></label> 
                <div class="">
                  <input type="password" name="user_pass" class="col-md-12" id="user_pass" value="" maxlength="" size="" style="" placeholder="********" required="" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
              
              
              <div class="form-group">
                <label class="" for="user_tel"><b>Telefono</b></label> 
                <div class="">
                  <input type="tel" name="user_tel" class="col-md-12" id="user_tel" value="" maxlength="10" size="" style="" placeholder="Teléfono" required="" autocomplete="off" autofocus="autofocus">
                </div>
              </div>


              <div class="form-group">
                <label class="" for="user_email"><b> Correo Electrónico</b></label> 
                <div class="">
                  <input type="email" name="user_email" class="col-md-12" id="user_email" value="" maxlength="" size="" style="" placeholder="Email" required="" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="" for="user_position"><b>Puesto</b></label> 
                <div class="">
                  <input type="text" name="user_position" class="col-md-12" id="user_position" value="" maxlength="" size="" style="" placeholder="Nombre de Usuario" required="" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            

            </div>

                     
           
          </div>



        </div>

        
            <div class="alert alert-primary">
              <div class="form-group">
              <center>
              <button type="submit" name="save" class="btn btn-primary " data-toggle="tooltip" data-placement="top" title="" data-original-title="">
              Registrar Información</button>
              </center>
              </div>
          


            </div>
        


  	</form>	


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