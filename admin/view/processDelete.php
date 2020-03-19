<?php

include '../controller/UserController.php';

if(isset($_SESSION['user'])){

	require "inc/header_del.html";
	?>
	<?php
	require "inc/sidebar.html";
	?>
	 
	   <div class="main-panel">
	      <!-- Navbar -->
	<?php
	require "inc/navbar.html";
	?>
	      <!-- End Navbar -->
	<?php
	require "content/processingDelete.php";
	?>    
	</div>

	<?php
	
	/*require "inc/core-js.html";*/

}else{
  echo '<script>location.href = "../index.php"</script>';
}

?>      

</body></html>