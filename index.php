<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicons/favicon.ico">

    <title>Signin</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for login -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" id="loginForm" action="view/validaCode.php" method="POST" role="form">
      <img class="mb-4" src="assets/img/favicons/favicon.ico" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Ingrese sus credenciales</h1>
      <label for="inputUser" class="sr-only">Usuario</label>
      <input type="text" id="inputUser" class="form-control" placeholder="Nombre de usuario" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
 
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y') ?></p>
    </form>
  </body>
</html>
