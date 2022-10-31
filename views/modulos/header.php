<header class="main-header">

<!--Logo -->
<a href="inicio" class="logo">
    <span class="logo-mini">
        <img src="views/img/plantilla/logomini.png"  class="img-responsive" style="padding:10px">
    </span>

    <span class="logo-lg">
        <img src="views/img/plantilla/logolg.png"  class="img-responsive" style="padding:10px 0px">

    </span>

    <!--Barra Nav -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toogle" data-toogle="dropdown">
                    <?php
if ($_SESSION["foto"] != "") {
    echo '<img src="' . $_SESSION["foto"] . '" class="user-image>"';
} else {
    echo '<img src="views/img/users/default/anonymous.png" class="user-image>"';

}
?>

                    <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                </a>

                <!--dropdown toogle -->

                <ul class="dropdown-menu">
                    <li class="user-body">
                        <div class="pull-right">
                            <a href="" class="btn btn-default btn-flat">Salir</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</a>

</header>
