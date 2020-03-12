<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>jQuery-Confirm</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<script src="js/jquery.min.js"></script>

	<script src="js/jquery-confirm.js"></script>

	<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css">

	

</head>
<body>
	
	<div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					
					<button type="submit" class="btn btn-danger confirmar"> Eliminar</button>
				
				</div>
			</div>
		</div>
	</div>

</body>
</html>

 <script type="text/javascript">
                        $('.confirmar').on('click',function(){
                            $.confirm({
                            	

                            	confirmButtonClass: 'btn-success',
    							
    							cancelButtonClass: 'btn-danger',

                                title: 'Delete user?',
                                content: 'This dialog will automatically trigger \'cancel\' in 5 seconds if you don\'t respond.',
                                autoClose: 'cancel|5000',
	                                confirm: function(){
	                                    alert('confirmed');
	                                },
	                                cancel:function(){
	                                    alert('cancelled');
	                                }
                            });
                        });
                        
                        </script>

