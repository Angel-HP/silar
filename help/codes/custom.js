$(document).ready(function(){
	$(document).on('click', '.detail', function(){

		var id = $(this).val();
		//var first=$('#ID'+id).text();
		var ID=$('#ID'+id).text();
		var folio=$('#Folio'+id).text();
		var addressee=$('#Destinatario'+id).text();
		var destiny_position=$('#Cargo'+id).text();
		var subject=$('#Asunto'+id).text();
		var sender=$('#Remitente'+id).text();
		var origin=$('#Origen'+id).text();
		var muni=$('#Municipio'+id).text();
		var date_doc=$('#Elaborado'+id).text();
		var date_recep=$('#Recibido'+id).text();
		var type_doc=$('#Tipo'+id).text();
		var status_doc=$('#Status_doc'+id).text();
		var send_position=$('#Send_position'+id).text();
		var dir_sender=$('#Domicilio'+id).text();
		var tel=$('#Telefono'+id).text();
		var ext=$('#Extension'+id).text();
		var movil=$('#Movil'+id).text();
		var email=$('#Email'+id).text();
		var reference=$('#Referencia'+id).text();

		
		$('#edit').modal('show');
		$('#eid').val(ID);
		$('#efolio').val(folio);
		$('#eaddressee').val(addressee);
		$('#ecargo').val(destiny_position);
		$('#easunto').val(subject);
		$('#eremitente ').val(sender);
		$('#eorigen').val(origin)
		$('#emunicipio').val(muni);
		$('#efecha_doc').val(date_doc);
		$('#efecha_recep').val(date_recep);
		$('#etipo_doc').val(type_doc);
		$('#estatus_doc').val(status_doc);
		$('#ecargoRem').val(send_position);
		$('#edomicilio').val(dir_sender);
		$('#etelefono').val(tel);
		$('#eextension').val(ext);
		$('#emovil').val(movil);
		$('#ecorreo').val(email);
		$('#ereferencia').val(reference);

	});
});




