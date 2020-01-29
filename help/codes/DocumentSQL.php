<?php
include '../data/Reconnect.php';
//include '../model/Document.php';

class DocumentSQL extends Reconnect {

	protected static $cnx;

	private static function getConection(){

		self::$cnx = Reconnect::connection();
		
	}//getConection

	private static function disconnect(){
		//This close the conection in PDO
		self::$cnx = null;
	}// disconnect

	public static function getTableDocuments_Pag($query_count, $sql, $action){

		/**
		 * Vars to build pagination
		 */
		$order="id_user ASC";
		$id_url = $_GET["a"];
		$url = basename($_SERVER ["PHP_SELF"]) . '?a=' . $id_url;
		$limit_end = 10;
		//safe the value of the actual position
		if(!isset($_GET["pos"])){
			$ini = 1;
		}else{
			$ini = $_GET["pos"];

		}
		$init = ($ini-1) * $limit_end;

		/*-------------------------*/

		$query = $sql;
		$query .= " LIMIT $init, $limit_end";//add limit init and limit end to the query
		


		self::getConection();

		/**
		 * -Execute a new query only to count the fields in the table of BD
		 */
		$count = self::$cnx->prepare($query_count);

		$count->execute();

		$rows_count = $count->fetch();

		$counted = $rows_count[0];
		/*---------------------------------------------------------*/


		//Query of data 
		$result = self::$cnx->prepare($query);

		$result->execute();

		$rows = $result->rowCount();
		$cols = $result->columnCount();

		/**
		 * Calculate pages
		 */
		$total = ceil($counted/$limit_end);

  		/*-------------------------------------*/

		if($rows > 0){

			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols; $i++){

				if($i > 7){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}       		
				echo '<th> &nbsp; </th>';
				echo '<th><center>  Acción</center></th>';
			
			/*if( $i <8 ){
			}else {
				echo '<th style="visibility: hidden">Acción ' . $i . '</th>';	
			}*/


			echo '</tr>
			</thead>
			<tbody>';
		

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';

				for($j = 0; $j < $cols; $j++){

					//echo '<td>' . $data[$j] .'</td>';
					// <span id="firstname1">Klvst3r</span>
					
						if($j > 7){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
					

				}
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];
				
				//$detail = '<a class="btn btn-success btn-sm" href="action.php?a=10&b='. $id .'">Detalles</a>';
				//$detail = '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Detalles</button>';
				
				//$detail =  '<a onclick="accion(' . $id . ');" href="#" class="btn btn-success" data-toggle="modal" data-target="#myModalmostrar" role="button">Detalles</a>';
				
				//$detail = '<td><button type="button" class="btn btn-success edit" value="' . $id . '"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>';
				$detail = '<td align="center"><button type="button" class="btn btn-primary detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-screenshot"></span> </button>';
				//$edit = '<td><button type="button" class="btn btn-success edit" value="' . $i . '"><span class="glyphicon glyphicon-edit"></span> Detalle</button></td>';
				//$edit = '<a class="btn btn-success edit" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>';
				//$track = '<a class="btn btn-primary" href="op.php?a=42&b='. $id .'&c=' . $folio . '"><span class="glyphicon glyphicon-edit"></span> Turnar</a>';
				

				//$edit = '<a class="btn btn-primary btn-sm" href="action.php?a=11&b='. $id .'">Editar</a>';
				//$edit = '';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';
            	
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=21&b=' . $id . '\')">Eliminar</button>';
            	//$delete = '';
				//echo '<td>' . $detail . ' ' . $edit . ' ' . $delete . '</td>';
				echo '</td>';
				echo '<td>' . $detail . '</td>';
				//echo '<td>' . $track . '</td>';
				echo '</tr>';


			}
			echo "</tbody></table>";

			  /*
			   * numeration of records [important]
			   */ 
				  //echo "<div class='pagination'>";
				  echo '<ul class="pagination">';
				  /****************************************/
				  if(($ini - 1) == 0)
				  {
				    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
				  }
				  else
				  {
				    echo '<li><a href="'.$url.'&pos='.($ini-1).'"><b>&laquo;</b></a></li>';
				  }
				  /****************************************/
				  for($k=1; $k <= $total; $k++)
				  {
				    if($ini == $k)
				    {
				      echo '<li class="active"><a href="#""><b>'.$k.'</b></a></li>';
				      
				    }
				    else
				    {
				    	
				      echo "<li><a href='$url&pos=$k'>".$k."</a></li>";
				    }
				  }
				  /****************************************/
				  if($ini == $total)
				  {
				    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
				  }
				  else
				  {
				  	echo '<li><a href="'.$url.'&pos='.($ini+1).'"><b>&raquo;</b></a></li>';

				  }
				  echo "</ul>";
				  //echo "</div>";
				  /*******************END*******************/
				 /*
			   * End numeration of records [important]
			   */ 


		}else{
			echo "No hay Documento en la Base de Datos con el folio introducido. ";
		}

		//free memory
		self::disconnect();


}//function getTableUsers


public static function getTableGeneral_Pag($query_count, $sql, $action){

		/**
		 * Vars to build pagination
		 */
		$order="id_user ASC";
		$id_url = $_GET["a"];
		$url = basename($_SERVER ["PHP_SELF"]) . '?a=' . $id_url;
		$limit_end = 10;
		//safe the value of the actual position
		if(!isset($_GET["pos"])){
			$ini = 1;
		}else{
			$ini = $_GET["pos"];

		}
		$init = ($ini-1) * $limit_end;

		/*-------------------------*/

		$query = $sql;
		$query .= " LIMIT $init, $limit_end";//add limit init and limit end to the query
		


		self::getConection();

		/**
		 * -Execute a new query only to count the fields in the table of BD
		 */
		$count = self::$cnx->prepare($query_count);

		$count->execute();

		$rows_count = $count->fetch();

		$counted = $rows_count[0];
		/*---------------------------------------------------------*/


		//Query of data 
		$result = self::$cnx->prepare($query);

		$result->execute();

		$rows = $result->rowCount();
		$cols = $result->columnCount();

		/**
		 * Calculate pages
		 */
		$total = ceil($counted/$limit_end);

  		/*-------------------------------------*/

		if($rows > 0){

			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols; $i++){

				if($i > 7){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}       		
				//echo '<th> &nbsp; </th>';
				echo '<th><center>  Acción</center></th>';
			
			/*if( $i <8 ){
			}else {
				echo '<th style="visibility: hidden">Acción ' . $i . '</th>';	
			}*/


			echo '</tr>
			</thead>
			<tbody>';
		

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';

				for($j = 0; $j < $cols; $j++){

					//echo '<td>' . $data[$j] .'</td>';
					// <span id="firstname1">Klvst3r</span>
					
						if($j > 7){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
					

				}
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];
				
				//$detail = '<a class="btn btn-success btn-sm" href="action.php?a=10&b='. $id .'">Detalles</a>';
				//$detail = '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Detalles</button>';
				
				//$detail =  '<a onclick="accion(' . $id . ');" href="#" class="btn btn-success" data-toggle="modal" data-target="#myModalmostrar" role="button">Detalles</a>';
				
				//$detail = '<td><button type="button" class="btn btn-success edit" value="' . $id . '"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>';
				//$detail = '<td><button type="button" class="btn btn-primary detail" value="' . $i . '"><span class="glyphicon glyphicon-search"></span> Detalle</button>';
				//$edit = '<td><button type="button" class="btn btn-success edit" value="' . $i . '"><span class="glyphicon glyphicon-edit"></span> Detalle</button></td>';
				//$edit = '<a class="btn btn-success edit" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>';
				$track = '<a class="btn btn-primary" href="op.php?a=42&b='. $id .'&c=' . $folio . '"data-toggle="tooltip" data-placement="top" title="Turnar Folio: ' . $folio . '"><span class="glyphicon glyphicon-edit" ></span> </a>';
				

				//$edit = '<a class="btn btn-primary btn-sm" href="action.php?a=11&b='. $id .'">Editar</a>';
				//$edit = '';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';
            	
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=21&b=' . $id . '\')">Eliminar</button>';
            	//$delete = '';
				//echo '<td>' . $detail . ' ' . $edit . ' ' . $delete . '</td>';
				//echo '<td>' . $detail . '</td>';
				echo '<td style="width:120px"><center>' . $track . '</center></td>';
				echo '</tr>';


			}
			echo "</tbody></table>";

			  /*
			   * numeration of records [important]
			   */ 
				  //echo "<div class='pagination'>";
				  echo '<ul class="pagination">';
				  /****************************************/
				  if(($ini - 1) == 0)
				  {
				    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
				  }
				  else
				  {
				    echo '<li><a href="'.$url.'&pos='.($ini-1).'"><b>&laquo;</b></a></li>';
				  }
				  /****************************************/
				  for($k=1; $k <= $total; $k++)
				  {
				    if($ini == $k)
				    {
				      echo '<li class="active"><a href="#""><b>'.$k.'</b></a></li>';
				      
				    }
				    else
				    {
				    	
				      echo "<li><a href='$url&pos=$k'>".$k."</a></li>";
				    }
				  }
				  /****************************************/
				  if($ini == $total)
				  {
				    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
				  }
				  else
				  {
				  	echo '<li><a href="'.$url.'&pos='.($ini+1).'"><b>&raquo;</b></a></li>';

				  }
				  echo "</ul>";
				  //echo "</div>";
				  /*******************END*******************/
				 /*
			   * End numeration of records [important]
			   */ 


		}else{
			echo "No hay Documento en la Base de Datos con el folio introducido. ";
		}

		//free memory
		self::disconnect();


}//function getTableGeneral_Pag

public static function getTableDocGeneral($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				


				$detail = '<td align="center"><button type="button" class="btn btn-primary detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-screenshot"></span> </button>';
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				//$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')">Eliminar</button>';

				//$edit = '<a class="btn btn-primary btn-sm" href="action.php?a=23&b='. $id .'">Editar</a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				//echo '<td>' . $detail . ' ' . $delete . '</td>';
				echo '<td>' . $detail . '</td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				No hay Documento en la Base de Datos con el folio introducido. 
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableDocGeneral

public static function getTableDoc($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				$detail = '<td style="width:120px"><button type="button" class="btn btn-warning detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-search"></span> </button>';
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')" data-toggle="tooltip" data-placement="top" title="Eliminar"><span class="glyphicon glyphicon-remove"></span> </button>';

				//$edit = '<a class="btn btn-primary btn-sm" href="action.php?a=23&b='. $id .'">Editar</a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
            	echo '</td>';
				echo '<td>' . $detail . ' ' . $delete . '</td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				No hay Documento en la Base de Datos con el folio introducido o ya fue procesado. 
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableUsers


public static function getTableDocPeriod_Pag($query_count, $sql, $action){

		/**
		 * Vars to build pagination
		 */
		$order="id_user ASC";
		$id_url = $_GET["a"];
		$url = basename($_SERVER ["PHP_SELF"]) . '?a=' . $id_url;
		$limit_end = 10;
		//safe the value of the actual position
		if(!isset($_GET["pos"])){
			$ini = 1;
		}else{
			$ini = $_GET["pos"];

		}
		$init = ($ini-1) * $limit_end;

		/*-------------------------*/

		$query = $sql;
		$query .= " LIMIT $init, $limit_end";//add limit init and limit end to the query
		


		self::getConection();

		/**
		 * -Execute a new query only to count the fields in the table of BD
		 */
		$count = self::$cnx->prepare($query_count);

		$count->execute();

		$rows_count = $count->fetch();

		$counted = $rows_count[0];
		/*---------------------------------------------------------*/


		//Query of data 
		$result = self::$cnx->prepare($query);

		$result->execute();

		$rows = $result->rowCount();
		$cols = $result->columnCount();

		/**
		 * Calculate pages
		 */
		$total = ceil($counted/$limit_end);

  		/*-------------------------------------*/

  		//echo $action;

		if($rows > 0){


			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			echo '<th>No. </th>'; 
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols; $i++){

				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}       		
				echo '<th> &nbsp; </th>';
				echo '<th><center>  Acción</center></th>';
			
			/*if( $i <8 ){
			}else {
				echo '<th style="visibility: hidden">Acción ' . $i . '</th>';	
			}*/


			echo '</tr>
			</thead>
			<tbody>';
		

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';

				$n = $i + 1;
				echo '<td>' . $n . '</td>';

				for($j = 0; $j < $cols; $j++){

					//echo '<td>' . $data[$j] .'</td>';
					// <span id="firstname1">Klvst3r</span>
					
						if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
					

				}
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				
				//$detail = '<a class="btn btn-success btn-sm" href="action.php?a=10&b='. $id .'">Detalles</a>';
				//$detail = '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Detalles</button>';
				
				//$detail =  '<a onclick="accion(' . $id . ');" href="#" class="btn btn-success" data-toggle="modal" data-target="#myModalmostrar" role="button">Detalles</a>';
				
				//$detail = '<td><button type="button" class="btn btn-success edit" value="' . $id . '"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>';
				$detail = '<td align="center"><button type="button" class="btn btn-primary detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-screenshot"></span> </button>';
				//$edit = '<td><button type="button" class="btn btn-success edit" value="' . $i . '"><span class="glyphicon glyphicon-edit"></span> Detalle</button></td>';
				//$edit = '<a class="btn btn-success edit" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>';
				

				//$edit = '<a class="btn btn-primary btn-sm" href="action.php?a=11&b='. $id .'">Editar</a>';
				//$edit = '';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';
            	
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=21&b=' . $id . '\')">Eliminar</button>';
            	//$delete = '';
				//echo '<td>' . $detail . ' ' . $edit . ' ' . $delete . '</td>';
				echo '<td>' . $detail . '</td>';
				echo '</tr>';


			}
			echo "</tbody></table>";

			  /*
			   * numeration of records [important]
			   */ 
				  //echo "<div class='pagination'>";
				  echo '<ul class="pagination">';
				  /****************************************/
				  if(($ini - 1) == 0)
				  {
				    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
				  }
				  else
				  {
				    echo '<li><a href="'.$url.'&pos='.($ini-1).'"><b>&laquo;</b></a></li>';
				  }
				  /****************************************/
				  for($k=1; $k <= $total; $k++)
				  {
				    if($ini == $k)
				    {
				      echo '<li class="active"><a href="#""><b>'.$k.'</b></a></li>';
				      
				    }
				    else
				    {
				    	
				      echo "<li><a href='$url&pos=$k&b=$action'>".$k."</a></li>";
				    }
				  }
				  /****************************************/
				  if($ini == $total)
				  {
				    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
				  }
				  else
				  {
				  	echo '<li><a href="'.$url.'&pos='.($ini+1).'"><b>&raquo;</b></a></li>';

				  }
				  echo "</ul>";
				  //echo "</div>";
				  /*******************END*******************/
				 /*
			   * End numeration of records [important]
			   */ 


		}else{
			echo "No hay Documento en la Base de Datos con el periodo establecido. ";
		}

		//free memory
		self::disconnect();


}//function getTableDocPeriod_Pag


public static function getTableDocUpdate($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				$detail = '<td style="width:120px"><button type="button" class="btn btn-primary detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-bookmark"></span> </button>';
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				//$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')">Eliminar</button>';

				$edit = '<a class="btn btn-warning" href="op.php?a=21&b='. $id .'" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit"></span> </a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				echo '<td>' . $detail . ' ' . $edit . '</td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				No hay Documento en la Base de Datos con el folio introducido, o el registro ya tiene seguimiento. 
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableUsers


public static function getTableDocUpdate_Pag($query_count, $sql, $action){

		/**
		 * Vars to build pagination
		 */
		$order="id_user ASC";
		$id_url = $_GET["a"];
		$url = basename($_SERVER ["PHP_SELF"]) . '?a=' . $id_url;
		$limit_end = 10;
		//safe the value of the actual position
		if(!isset($_GET["pos"])){
			$ini = 1;
		}else{
			$ini = $_GET["pos"];

		}
		$init = ($ini-1) * $limit_end;

		/*-------------------------*/

		$query = $sql;
		$query .= " LIMIT $init, $limit_end";//add limit init and limit end to the query
		


		self::getConection();

		/**
		 * -Execute a new query only to count the fields in the table of BD
		 */
		$count = self::$cnx->prepare($query_count);

		$count->execute();

		$rows_count = $count->fetch();

		$counted = $rows_count[0];
		/*---------------------------------------------------------*/


		//Query of data 
		$result = self::$cnx->prepare($query);

		$result->execute();

		$rows = $result->rowCount();
		$cols = $result->columnCount();

		/**
		 * Calculate pages
		 */
		$total = ceil($counted/$limit_end);

  		/*-------------------------------------*/

		if($rows > 0){

			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			echo '<th>No. </th>'; 
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols; $i++){

				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}       		
				echo '<th> &nbsp; </th>';
				echo '<th><center>  Acción</center></th>';
			
			/*if( $i <8 ){
			}else {
				echo '<th style="visibility: hidden">Acción ' . $i . '</th>';	
			}*/


			echo '</tr>
			</thead>
			<tbody>';
		

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';

				$n = $i + 1;
				echo '<td>' . $n . '</td>';

				for($j = 0; $j < $cols; $j++){

					//echo '<td>' . $data[$j] .'</td>';
					// <span id="firstname1">Klvst3r</span>
					
						if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
					

				}
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				$detail = '<td style="width:120px"><button type="button" class="btn btn-primary detail" value="' . $i . '"data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-bookmark"></span> </button>';
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				//$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')">Eliminar</button>';

				$edit = '<a class="btn btn-warning" href="op.php?a=21&b='. $id .'" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit"></span> </a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				echo '<td>' . $detail . ' ' . $edit . '</td>';
				echo '</tr>';


			}
			echo "</tbody></table>";

			  /*
			   * numeration of records [important]
			   */ 
				  //echo "<div class='pagination'>";
				  echo '<ul class="pagination">';
				  /****************************************/
				  if(($ini - 1) == 0)
				  {
				    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
				  }
				  else
				  {
				    echo '<li><a href="'.$url.'&pos='.($ini-1).'"><b>&laquo;</b></a></li>';
				  }
				  /****************************************/
				  for($k=1; $k <= $total; $k++)
				  {
				    if($ini == $k)
				    {
				      echo '<li class="active"><a href="#""><b>'.$k.'</b></a></li>';
				      
				    }
				    else
				    {
				    	
				      echo "<li><a href='$url&pos=$k'>".$k."</a></li>";
				    }
				  }
				  /****************************************/
				  if($ini == $total)
				  {
				    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
				  }
				  else
				  {
				  	echo '<li><a href="'.$url.'&pos='.($ini+1).'"><b>&raquo;</b></a></li>';

				  }
				  echo "</ul>";
				  //echo "</div>";
				  /*******************END*******************/
				 /*
			   * End numeration of records [important]
			   */ 


		}else{
			echo "No hay Documento en la Base de Datos con el periodo establecido. ";
		}

		//free memory
		self::disconnect();


}//function getTableDocUpdate_Pag

public static function getTableDocFolio($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				$detail = '<td align="center"><button type="button" class="btn btn-primary detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-screenshot"></span> </button>';
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				//$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')">Eliminar</button>';

				//$edit = '<a class="btn btn-primary btn-sm" href="action.php?a=23&b='. $id .'">Editar</a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				//echo '<td>' . $detail . ' ' . $delete . '</td>';
				echo '</td>';
				echo '<td>' . $detail . ' </td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				No hay Documento en la Base de Datos con el folio introducido. 
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableDocFolio

public static function getTableDocTrack($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];
				//$status 	= $data["id_status"];
				//$classif 	= 

				$detail = '<td style="width:120px"><button type="button" class="btn btn-default detail" value="' . $i . '" data-toggle="tooltip" data-placement="top" title="Detalle"><span class="glyphicon glyphicon-search"></span> </button>';
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				//$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')">Eliminar</button>';

				$track = '<a class="btn btn-success" href="op.php?a=42&b='. $id .'&c=' . $folio . '" data-toggle="tooltip" data-placement="top" title="Turnar"><span class="glyphicon glyphicon-edit"></span> </a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				echo '<td>' . $detail . ' ' . $track . '</td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				<p>No hay Documento en la Base de Datos con el folio introducido. </p>
				<p> El folio ya tiene seguimiento. </p>
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableDocTrack


public static function getTableTracking_Pag($query_count, $sql, $action){

		/**
		 * Vars to build pagination
		 */
		$order="id_user ASC";
		$id_url = $_GET["a"];
		$url = basename($_SERVER ["PHP_SELF"]) . '?a=' . $id_url;
		$limit_end = 10;
		//safe the value of the actual position
		if(!isset($_GET["pos"])){
			$ini = 1;
		}else{
			$ini = $_GET["pos"];

		}
		$init = ($ini-1) * $limit_end;

		/*-------------------------*/

		$query = $sql;
		$query .= " LIMIT $init, $limit_end";//add limit init and limit end to the query
		


		self::getConection();

		/**
		 * -Execute a new query only to count the fields in the table of BD
		 */
		$count = self::$cnx->prepare($query_count);

		$count->execute();

		$rows_count = $count->fetch();

		$counted = $rows_count[0];
		/*---------------------------------------------------------*/


		//Query of data 
		$result = self::$cnx->prepare($query);

		$result->execute();

		$rows = $result->rowCount();
		$cols = $result->columnCount();

		/**
		 * Calculate pages
		 */
		$total = ceil($counted/$limit_end);

  		/*-------------------------------------*/

		if($rows > 0){

			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}

			for ($i=0; $i < $cols; $i++){

				if($i > 7){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}       		
				echo '<th> &nbsp; </th>';
				echo '<th><center>  Acción</center></th>';
			
			/*if( $i <8 ){
			}else {
				echo '<th style="visibility: hidden">Acción ' . $i . '</th>';	
			}*/


			echo '</tr>
			</thead>
			<tbody>';
		

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';

				for($j = 0; $j < $cols; $j++){

					//echo '<td>' . $data[$j] .'</td>';
					// <span id="firstname1">Klvst3r</span>
					
						if($j > 7){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
					

				}
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id = $data["ID"];
				$folio = $data["Folio"];

				//$detail = '<td><button type="button" class="btn btn-success detail" value="' . $i . '">Detalle <span class="glyphicon glyphicon-triangle-right"></span></button>';
				$track = '<td><a class="btn btn-success" href="op.php?a=42&b='. $id .'&c=' . $folio . '"><span class="glyphicon glyphicon-edit"></span> Turnar</a></td>';

				echo '<td>' . $track . '</td>';
				echo '</tr>';


			}
			echo "</tbody></table>";

			  /*
			   * numeration of records [important]
			   */ 
				  //echo "<div class='pagination'>";
				  echo '<ul class="pagination">';
				  /****************************************/
				  if(($ini - 1) == 0)
				  {
				    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
				  }
				  else
				  {
				    echo '<li><a href="'.$url.'&pos='.($ini-1).'"><b>&laquo;</b></a></li>';
				  }
				  /****************************************/
				  for($k=1; $k <= $total; $k++)
				  {
				    if($ini == $k)
				    {
				      echo '<li class="active"><a href="#""><b>'.$k.'</b></a></li>';
				      
				    }
				    else
				    {
				    	
				      echo "<li><a href='$url&pos=$k'>".$k."</a></li>";
				    }
				  }
				  /****************************************/
				  if($ini == $total)
				  {
				    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
				  }
				  else
				  {
				  	echo '<li><a href="'.$url.'&pos='.($ini+1).'"><b>&raquo;</b></a></li>';

				  }
				  echo "</ul>";
				  //echo "</div>";
				  /*******************END*******************/
				 /*
			   * End numeration of records [important]
			   */ 


		}else{
			echo "No hay Documento en la Base de Datos con el folio introducido. ";
		}

		//free memory
		self::disconnect();


}//function getTableTracking_Pag


public static function getTableDocTrackAnswer($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				//echo '<td>' . $action . '</td>';
				//$id = $data[$i];
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];
				//$status 	= $data["id_status"];
				//$classif 	= 

				
				//$delete = '<a class="btn btn-danger delete" href="op.php?a=21&b='. $id .'"><span class="glyphicon glyphicon-edit"></span> Eliminar</a></td>';

				//$delete = '<button class="btn btn-danger delete" onclick="confirmar(\'op.php?a=91&b=' . $id . '\')">Eliminar</button>';

				$answer = '<a class="btn btn-success" href="op.php?a=2&b='. $id . '" data-toggle="tooltip" data-placement="top" title="Registrar Respuesta"><span class="glyphicon glyphicon-pencil"></span> </a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
            	echo '<td></td>';
				echo '<td><center>' . $answer . '</center></td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				<p>No hay Seguimiento al folio de este Documento. </p>
				<p><b> Por favor registre seguimiento a su documento. </b></p>
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableDocTrack



public static function tableDocReg($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			//echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];

				$track = '<a class="btn btn-primary" href="op.php?a=42&b='. $id .'&c=' . $folio . '" data-toggle="tooltip" data-placement="top" title="Turnar"><span class="glyphicon glyphicon-edit"></span> </a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				echo '<td style="width:120px"><center>' . $track . '</center></td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				<p>No hay Seguimiento al folio de este Documento. </p>
				<p><b> Por favor registre seguimiento a su documento. </b></p>
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='4; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function getTableDocTrack





public static function tableDocTracked($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){
				//echo '<th>' . $meta[$i]["name"] . '</td>';
				if($i > 8){
					//echo '<th style="visibility: hidden">' . $meta[$i]["name"] . '</td>';	
					
					//echo '<th style="display:none">' . $meta[$i]["name"] . '</td>';	
				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			//echo '<th> &nbsp; </th>';
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					//echo '<td>' . $data[$j] .'</td>';
					
					if($j > 8){
							
							//echo '<td style="visibility: hidden"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];

				$track = '<a class="btn btn-info" href="op.php?a=2&b='. $folio . '" data-toggle="tooltip" data-placement="top" title="Registrar Respuesta"><span class="glyphicon glyphicon-edit"></span> </a>';
            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(action.php?a=6)">Eliminar</button>';

            	//$delete = '<button class="btn btn-danger btn-sm" onclick="confirmar(\'action.php?a=25&b=' . $id . '\')">Eliminar</button>';
				echo '<td style="width:120px"><center>' . $track . '</center></td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				<p>No hay Seguimiento al folio de este Documento. </p>
				<p><b> Por favor registre seguimiento a su documento. </b></p>
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='4; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function tableDocTracked


public static function tableAnswered($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){

				if($i > 8){

				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			
			//echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					
					
					if($j > 8){
							
			
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];

				/*$track = '<a class="btn btn-success" href="op.php?a=2&b='. $folio . '" data-toggle="tooltip" data-placement="top" title="Registrar Respuesta"><span class="glyphicon glyphicon-edit"></span> </a>';*/
            
				//echo '<td style="width:120px"><center>' . $track . '</center></td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				<p>No hay documentos con Respuesta para este mes. </p>
				<p><b> Por favor realice otra busqueda. </b></p>
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='4; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();

}//function tableAnswered



public static function tableNotAnswered($sql){
		$query = $sql;
		self::getConection();
		$result = self::$cnx->prepare($query);
		$result->execute();
		$rows = $result->rowCount();
		$cols = $result->columnCount();
		if($rows > 0){
			echo '<table class="table table-striped table-hover">';
			echo '<thead>
			<tr>';
			foreach(range(0, $result->columnCount() - 1) as $column_index){
				$meta[] = $result->getColumnMeta($column_index);
			}
			for ($i=0; $i < $cols; $i++){

				if($i > 8){

				}else{
					echo '<th>' . $meta[$i]["name"]  . '</td>';	
				}
			}
			
			echo '<th><center>  Acción</center></th>';

			echo '</tr>
			</thead>
			<tbody>';

			for($i = 0; $i < $rows; $i++){
				$data = $result->fetch();
				echo '<tr>';
				for($j = 0; $j < $cols; $j++){
					
					
					if($j > 8){
							
			
							echo '<td style="display:none"><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}else{
							echo '<td><span id="'. $meta[$j]["name"] . $i .  '">' . $data[$j] . '</span></td>';
						}
				}//for $j
				$id 		= $data["ID"];
				$folio 		= $data["Folio"];

				$track = '<a class="btn btn-success" href="op.php?a=2&b='. $folio . '" data-toggle="tooltip" data-placement="top" title="Registrar Respuesta"><span class="glyphicon glyphicon-edit"></span> </a>';
            
				echo '<td style="width:120px"><center>' . $track . '</center></td>';
				echo '</tr>';
			}
			echo "</tbody></table><br/>";
		}else{

			echo '
			<section class="content-header">
			<center>
				<p>No hay documentos sin Respuesta para este mes. </p>
				<p><b> Por favor realice otra busqueda. </b></p>
			</center>
			</section>				
			';

			echo"<meta HTTP-EQUIV='Refresh' CONTENT='4; URL=index.php'<head/>";
		}
		//free memory
		self::disconnect();
}//function tableNotAnswered



} //Class UserSQL	
?>