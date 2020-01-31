<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<!-- ********** Begins Meta and Links ********** -->
<?php include'inc/userHeadDashboard.php'; ?>
<!-- ********** Finish Meta and Links ********** -->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
<!-- ********** Begin HEADER ********** -->
<?php include'inc/userHeader.php'; ?>
<!-- ********** Finish HEADER ********** -->
<!--header end-->
</header>
<!--sidebar start-->
<aside class="main-sidebar">
<!-- ********** Begin Aside ********** -->


 <?php 
 //include'inc/userAside.php'; 
include 'chkmenu.php';
 ?>
<!-- ********** Finish Aside ********** -->
</aside>
<!--sidebar end-->
<!--- ####################################################### Begin Content ##################################################################### -->


<!--main content start-->
<section id="main-content">
<?php
  $_SESSION["user"]["code"] = "true";

/* ********************************************************************************************************************************************************
Begin Main Content
*********************************************************************************************************************************************************** */
/*
  After this will be adquire all document info and its tables
 */
include 'sql/DocumentSQL.php';

include '../controller/DocumentController.php';


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      SIOP
      <small>Sistema de Información de Oficialia de Partes</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/secoduvi/siop/user/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Consultas</a></li>
      <li class="active"><i class="fa fa-edit"></i> Documentos</li>
    </ol>
  </section>

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="ion ion-aperture"></i> Registro de Documentos sin seguimiento 
        <small class="pull-right"><?php echo date("d-m-Y") ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>


  <div class="row">

  </div>

  <div class="row invoice-info">

<!-- ************************   Begin List Documents   **************************** -->

<div class="col-lg-12">
    <h1 class="page-header">Listado de documentos dirigidos al Ing. Emiliano Alejandro Serrano García | <a href="op.php?a=1" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo documento</a>
    </h1>
</div>

      <!-- INICIO CONTENIDO -->
<?php

$query_count = "SELECT COUNT(*) FROM documents where status ='1'";

/*
$query = "SELECT A.id_doc as ID, A.id_destiny as Destinatario,
  A.send_doc as Remitente, A.subject_doc as Asunto, A.origin_doc as Origen, A.id_muni as Municipio, A.date_doc as Fecha_Documento, A.date_recep as Fecha_Recepción, A.id_type_doc as Tipo_Documento, A.status as Estado FROM documents A WHERE A.status = '1' ORDER BY id_doc";
 */

// $query = "SELECT A.id_doc as ID, A.send_doc as Remitente, A.subject_doc as Asunto,
// A.origin_doc as Origen, C.desc_muni as Municipio, A.date_doc as Elaborado, A.date_recep as Recibido,
// D.desc_type_doc as Tipo, A.id_destiny as Destinatario, A.id_muni as Muni, A.id_status_doc as Status_doc, A.desc_send_position as Send_position,
// A.dir_sender as Domicilio, A.tel_doc as Telefono, A.ext_doc as Extension, A.movil_doc as Movil, A.email_doc as Email, A.reference as Referencia
// FROM documents A, municipalities C, type_docs D
// WHERE A.id_muni = C.id_muni and A.id_type_doc = D.id_type_doc
// and A.status = '1' ORDER BY id_doc";

$query = "SELECT A.id_doc as ID, A.folio_doc as Folio, B.desc_destiny as Destinatario, B.destiny_position as Cargo, A.subject_doc as Asunto,
A.send_doc as Remitente, A.origin_doc as Origen, A.date_doc as Elaborado, A.date_recep as Recibido,
D.desc_type_doc as Tipo, A.id_destiny as Destinatario, A.id_muni as Muni, C.desc_muni as Municipio, A.desc_send_position as Send_position,
A.dir_sender as Domicilio, A.tel_doc as Telefono, A.ext_doc as Extension, A.movil_doc as Movil, A.email_doc as Email,
A.reference as Referencia, E.desc_status_docs as Status_doc
FROM documents A, destiny_docs B, municipalities C, type_docs D, status_docs E
WHERE A.id_muni = C.id_muni and A.id_type_doc = D.id_type_doc and A.id_destiny = B.id_destiny and A.id_status_doc = E.id_status_doc 
and A.status = '1' ORDER BY folio_doc";


$params = "";

//echo $query;
DocumentSQL::getTableDocuments_Pag($query_count, $query, $params);

?>
<!-- ************************   End List Documents   **************************** -->


  <?php

  //modal
  include 'modalGeneral.php';

  ?>




  </div>


  	</section>
<!-- /.content -->

<div class="pad margin no-print"></div>
<div class="clearfix"></div>
</div>
  <!-- /.content-wrapper -->
<?php
/* **********************************************************************************************************************************************************
Begin Main Content
*********************************************************************************************************************************************************** */
?>
</section><!-- /MAIN CONTENT -->

<!--- ####################################################### Finish Content ##################################################################### -->
<!--main content end-->

<!--footer start-->
<?php include'inc/userFooter.php'; ?>
<!--footer ends-->

</body>
</html>
<?php
ob_end_flush();
?>
