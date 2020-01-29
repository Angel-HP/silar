<style>
   #mdialTamanio{
   width: 85% !important;

    /*width: 1270px;*/

   }

 </style>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document" id="mdialTamanio">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Información del Documento</h4>
  </div>

  <div class="modal-body">

    <div class="container-fluid">
      <div class="col-lg-12">
         <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Detalles del Documento | <?php echo ' ID: <input type="text" style="width:50px; text-align:center; border:none;" class="" id="eid" disabled>' ?></div>
                <div class="panel-body">
                    <div class="col-lg-12">
                    <div class="table-responsive">
                    <table class="table table-hover">
                    <tbody style="cursor:pointer;">
                        
                        
                        <tr style=" text-align: center;">
                            <th style=" text-align: right;">Folio: </th>
                            <td value="id"><input type="text" style="width:450px; border:none;" class="form-control" id="efolio" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Telefono: </th>
                            <td value="telefono"><input type="text" style="width:450px;" class="form-control" id="etelefono" disabled></td>
                        </tr>


                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Dirigido a: </th>
                            <td value="destinatario"><input type="text" style="width:450px;" class="form-control" id="eaddressee" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Extensión: </th>
                            <td value="extension"><input type="text" style="width:450px;" class="form-control" id="eextension" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Cargo:</th>
                            <td value="cargo"><input type="text" style="width:450px;" class="form-control" id="ecargo" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Otro Telefono: </th>
                            <td value="movil"><input type="text" style="width:450px;" class="form-control" id="emovil" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Asunto:</th>
                            <td value="asunto"><input type="text" style="width:450px;" class="form-control" id="easunto" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Correo: </th>
                            <td value="correo"><input type="text" style="width:450px;" class="form-control" id="ecorreo" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Enviado por: </th>
                            <td value="Remitente"><input type="text" style="width:450px;" class="form-control" id="eremitente" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Fecha de Documento </th>
                            <td value="fecha_doc"><input type="text" style="width:450px;" class="form-control" id="efecha_doc" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Cargo Remitente: </th>
                            <td value="cargo"><input type="text" style="width:450px;" class="form-control" id="ecargoRem" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Fecha de Recepción </th>
                            <td value="fecha_recep"><input type="text" style="width:450px;" class="form-control" id="efecha_recep" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Lugar de Origen: </th>
                            <td value="Origen"><input type="text" style="width:450px;" class="form-control" id="eorigen" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Referencia del Asunto </th>
                            <td value="referencia"><input type="text" style="width:450px;" class="form-control" id="ereferencia" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Domicilio: </th>
                            <td value="domicilio"><input type="text" style="width:450px;" class="form-control" id="edomicilio" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Tipo de Documento </th>
                            <td value="tipo_doc"><input type="text" style="width:450px;" class="form-control" id="etipo_doc" disabled></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th style=" text-align: right;">Municipio: </th>
                            <td value="Municipio"><input type="text" style="width:450px;" class="form-control" id="emunicipio" disabled></td>
                            <td value=""></td>
                            <th style=" text-align: right;">Estatus Documento </th>
                            <td value="status_doc"><input type="text" style="width:450px;" class="form-control" id="estatus_doc" disabled></td>
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
