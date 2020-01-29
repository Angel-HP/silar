<?php

if(isset($_SESSION["user"]) and isset($_SESSION["user"]["url"])){

  $code = $_SESSION["user"]["code"];
//  echo $code;
  if($code == "true" and $_SESSION["user"]["code"] == "true"){
  //Definition of Paht principal
  define("PATH", $_SESSION["user"]["url"]);


include '../controller/UserController.php';

$user_name = $_SESSION["user"]["user_name"];

$id_user = $_SESSION["user"]["id_user"];  

$user  = UserController::getProfile($id_user);

?>
<!-- ********** Begin HEADER ********** -->
    <!-- Logo -->
    <div class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><span class="dark_green">T</span><span class="light_green">L<span class="red">X</span></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><span class="dark_green">T</span><span class="light_green">L<span class="red">X</span></b> <span class="grey">SECODUVI</span></span>
    </div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="../panel/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span class="hidden-xs"><?php echo $user->getName() ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assets/img/users/<?php echo $user->getUser_photo() ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user->getName() . " - " . $user->getUser_position() ?> 
                  <small><?php echo $user->getUser_resume() ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <span><?php echo $user->getUser_email() ?></span>
                  </div>
                  <div class="col-xs-6 text-center">
                    <span href="#"><?php echo date("d / m / Y") ?></span>
                  </div>
                  
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><i class="fa fa-cog fa-spin fa-1x fa-fw text-green"></i> Perfíl</a>

                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="control-sidebar"><i class="fa fa-gears text-blue"></i> - Configuración</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="../view/signout.php"><i class="fa fa-power-off fa-1x text-red"></i></a>


          </li>
        </ul>
      </div>
    </nav>

<!-- ********** Finish HEADER ********** -->
<?php

//After login turn off code
$_SESSION["user"]["code"] = "false";

}else{
      $_SESSION["user"]["code"] = "false";
      $code ="false";
        header("location:../login.php");
      }

$_SESSION["user"]["code"] = "false";

}else {

header("location:../login.php");
}
?>