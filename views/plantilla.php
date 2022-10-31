<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buenas Practicas PHP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../views/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../views/dist/css/adminlte.min.css">
</head>
//**Custom Body */
<body class="hold-transition  skin-bluue sidebar-collapse sidebar-mini login-page">
<?php
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
echo '<div class="wrapper">';
//header
include "modulos/header.php";

//nav
include "moduo/nav.php";

//content
if(isset($_GET["ruta"])){
    if($_GET["ruta"] == "inicio" ||
       $_GET["ruta"] == "usuarios" ||
       $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";
}else{
    include "modulos/404.php";
}

}else{
    include "moduos/incio.php";
}

//footer
include "modulos/footer.php";
echo '</div>';
}else{
    include "modulos/login.php";
}

?>

<!-- jQuery -->
<script src="../views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../views/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../views/dist/js/demo.js"></script>
</body>
</html>
