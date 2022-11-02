<?php

require_once "controllers/plantilla.controller.php";
require_once "controllers/usuarios.controller.php";


require_once "models/usuarios.model.php";


$plantilla = new ControladorPlatilla();
$plantilla -> ctrPlantilla();

