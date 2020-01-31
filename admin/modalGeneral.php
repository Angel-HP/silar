<style>
   #mdialTamanio{
   width: 85% !important;

    /*width: 1270px;*/

   }

 </style>
<div class="modal fade" id="detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document" id="mdialTamanio">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Información del Usuario</h4>
  </div>

  <div class="modal-body">

    <div class="container-fluid">
      <div class="col-lg-12">
         <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Detalles del Usuario | <?php echo ' ID: <input type="text" style="width:50px; text-align:center; border:none;" class="" id="eid" disabled>' ?></div>
                <div class="panel-body">
                    <div class="col-lg-12">
                    <div class="table-responsive">
                    <table class="table table-hover">
                    <tbody style="cursor:pointer;">
                        
                        
                        <tr style=" text-align: center;">
                            <th style=" text-align: right;">Nombre: </th>
                            <td value="nombre"><input type="text" style="width:450px; border:none;" class="form-control" id="enombre" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Usuario: </th>
                            <td value="nombre"><input type="text" style="width:450px;" class="form-control" id="enombre" disabled></td>
                        </tr>


                        
                        
                        
                    </tbody>
                        <!-- <thead class="text-primary">
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Nombre</th>
                            <th style="text-align: center;">Email</th>
                        </thead> -->
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                                <!-- END Table -->
                </div>
              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
