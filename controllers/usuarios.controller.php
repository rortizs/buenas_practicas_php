<?php

class ControladorUsuarios
{
    //ingreso de usuario

    public static function ctrIngresoUsuario()
    {

        if (isset($_POST["IngUsuario"])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["IngUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["IngPassword"])
            ) {
                //Encriptar password
                $encrypter = crypt($_POST["IngPassword"], '
                        $2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";

                $item = "usuario";
                $value = $_POST["ingUsuario"];

                $respuesta = ModelUsers::mdlMostrarUsuarios($tabla, $item, $value);

                if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encrypter) {
                    if ($respuesta["estado"] == 1) {

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];
                        $_SESSION["perfil"] = $respuesta["perfil"];

                        //registrar la fecha del ultimo login
                        date_default_timezone_set('America/Guatemala');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha . '' . $hora;

                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;

                        $item2 = "id";
                        $valor2 = $respuesta["id"];

                        $ultimoLogin = ModelUsers::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        if($ultimoLogin == "ok"){

                            echo '<script>
                                window.localtion = "inicio";
                                </script>';
                        }

                        echo '<cript>
                            window.location = "inicio";
                        </cript>';

                    }else{
                        echo '<br>
                            <div class="alert alert-danger">El usuario a??n no est?? activado</div>';
                    }
                }else{
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

    //registro de usuario

    public static function ctrCrearUsuario()
    {

        if (isset($_POST["nuevoUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9???????????????????????? ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
            ) {

                $tabla = "usuarios";

                $encrypter = crypt($_POST["nuevoPassword"], '
                    $2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encrypter,
                    "perfil" => $_POST["nuevoPerfil"],
                );

                $respuesta = ModelUsers::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
                        swal({
                            type: "success",
                            title: "!El usuario ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                        swal({
                            type: "error",
                            title: "!El usuario no puede ir vac??o o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                            }
                        })
                    </script>';
            }
        }
    }

    //Mostrar usuario
    public static function ctrMostrarUsuarios($item, $value)
    {

        $tabla = "user";

        $respuesta = ModelUsers::mdlMostrarUsuarios($tabla, $item, $value);

        return $respuesta;
    }

    //editar usuario

    public static function ctrEditarUsuario()
    {

        if (isset($_POST["editarUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9???????????????????????? ]+$/', $_POST["editarNombre"])) {

                $tabla = "usuarios";

                if ($_POST["editarPassword" != ""]) {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                        $encrypter = crypt($_POST["editarPassword"], '
                         $2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {

                        echo '<script>
                            swal({
                                type: "error",
                                title: "!La contrase??a no puede ir vac??a o llevar caracteres espciales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if(result.value){
                                        window.localtion = "usuarios";
                                    }
                                })
                        </script>';
                        return;
                    }
                } else {

                    $encrypter = $_POST["passwordActual"];
                }

                $datos = array(
                   "nombre" => $_POST["editarNombre"],
                    "usuario" => $_POST["editarUsuario"],
                    "password" => $encrypter,
                    "perfil" => $_POST["editarPerfil"],
                );

                $respuesta = ModelUsers::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

                }
            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "??El nombre no puede ir vac??o o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

            }
        }
    }

    //Delete Usuario
    public static function ctrBorrarUsuario()
    {

         if (isset($_GET["idUsuario"])) {

            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            if ($_GET["fotoUsuario"] != "") {

                unlink($_GET["fotoUsuario"]);
                rmdir('vistas/img/usuarios/' . $_GET["usuario"]);
            }

            $respuesta = ModelUsers::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                swal({
                      type: "success",
                      title: "El usuario ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then(function(result) {
                                if (result.value) {

                                window.location = "usuarios";

                                }
                            })

                </script>';
            }
        }
    }
}
