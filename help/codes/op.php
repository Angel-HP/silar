<?php

/*
action
	Registro
		Documentos
		Respuesta de tramite
	Cosulta
		Documentos
	Actualizar
		Documentos
	Seguimiento
		Documentos
		Tramite
	Reporte
		Seguimiento de Tramite
	Busqueda avanzada
		Folio
		Periodo
		Fecha
		Asunto
	Informe
		Caratula
	Tools
		xlsExport
		bdExport
*/


$a = $_GET['a'];


if(isset($a)){
	switch($a){
	/*----------------- Register  --------------------- */		
		case 1:
			//Register Form
			require_once("view/reg/formRegDoc.php");
			/*require_once("view/reg/formSelect.php");*/
			break;
		case 2:
			//Register Answer
			require_once("view/reg/insAnswer.php");
			break;

	/*----------------- Query --------------------- */		
		case 11:
			// Options Query form
			require_once("view/query/queryGeneral.php");
			break;
		case 12:
			// Folio by Tracked
			require_once("view/search/folioTracked.php");
			break;
		case 13:
			// Folio by Reference
			require_once("view/query/folioRefered.php");
			break;
		case 14:
			// Documents Registered
			require_once("view/query/queryDocs.php");
			break;
		case 15:
			// Documents Tracked
			require_once("view/query/queryTracked.php");
			break;
		case 17:
			// Documents Registred and Not Tracked
			require_once("view/query/queryNotTracked.php");
			break;
		case 18:
			// Documents Registred, Tracked and with Answer
			require_once("view/query/queryAnswered.php");
			break;
		case 19:
			// Documents Registred, Tracked and without Answer
			require_once("view/query/queryNotAnswered.php");
			break;
	/*----------------- Update --------------------- */
		case 21:
			//Form Update
			require_once("view/update/updateDoc.php");
			break;
		case 22:
			//Ejecute update
			require_once("view/update/insUpdateDoc.php");
			break;
		case 23:
			//Ejecute update general
			require_once("view/update/updateGeneral.php");
			break;
		case 24:
			//Ejecute update by Muni
			require_once("view/update/updateMuni.php");
			break;
	
	/*----------------- Cancel --------------------- */
		case 31:
			//Form Update
			require_once("view/update/insUpdateDoc.php");
			break;
	/*----------------- Tracing --------------------- */
		case 41: 
			//form Tracing Document Search
			require_once("view/search/searchTracking.php");
			break;
		case 42:
		//Ejecute Document Tracing
			require_once("view/tracking/trackingDoc.php");
			break; 
		case 43: 
			require_once("view/tracking/generalTracking.php");
			break;
		case 44:
			require_once("view/tracking/insTracingTramit.php");
			break;
		case 45:
			require_once("view/tracking/answerTrack.php");
			break;			
		
	/*----------------- Report --------------------- */	
		case 51:
			require_once("view/report/formReportTracing.php");
			break;
		case 52:
			require_once("view/report/insReportTracing.php");
			break;
	/*----------------- Search --------------------- */				
		case 61:
			require_once("view/search/findCancel.php");
			break;
		case 62:
			require_once("view/search/searchFolio.php");
			break;
		case 63:
			require_once("view/search/searchMuni.php");
			break;
		case 64:
			require_once("view/search/searchPeriod.php");
			break; 
		case 65:
			require_once("view/search/searchUpdate.php");
			break; 
		case 66:
			require_once("view/search/searchAnswer.php");
			break;
		case 67:
			require_once("view/search/searchSubject.php");
			break;
		case 68:
			require_once("view/search/findPeriod.php");
			break; 

	/*----------------- Print --------------------- */	
		case 71: 
			require_once("view/print/printReg.php");
			break; 
		case 72: 
			//require_once("view/print/exePrintCover.php");                   
			break;
		case 73: 
			require_once("view/print/PrintRequest.php");                   
			break;
	/*----------------- Tool --------------------- */	
		case 81: 
			require_once("view/tool/configExport.php");
			break;
		case 82: 
			require_once("view/tool/exportToExcel.php");
			break;
		case 83: 
			//require_once("view/tool/xlsFormExport.php");
			break;
		case 84: 
			// 
			//require_once("view/tool/xlsExport.php");
			break;
		case 85: 
			// 
			//require_once("view/tool/bdFormExport.php");
			break;
		case 86:
	/*----------------- Delete --------------------- */	
		case 91: 
			require_once("view/del/delbyFolio.php");
			break;
			
    /*-------------- End Option ------------------- */	
		default:
			echo 'No hay mas Opciones';
			echo ' 
				<script type="text/javascript">
					
					  window.close();
					
				</script>
			';


			break;

	}
}else{
	echo 'Sin variable correcta';
	echo ' 
				<script type="text/javascript">
					
					  window.close();
				
					</script>
			';

			
}

?>




