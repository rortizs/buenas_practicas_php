<?php

class ControladorUsuarios{
    //ingreso de usuario

    static public function ctrIngresoUsuario(){

        if(isset($_POST["IngUsuario"])){
            if(
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["IngUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["IngPassword"])
            ){
                $tabla = "user"
            }
        }
    }
}
