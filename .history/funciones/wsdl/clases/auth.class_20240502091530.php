<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class auth extends conexion{

    public function login($json){

        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['usuario']) || !isset($datos['password'])){
            // error con los campos
            return $_respuestas->error_400();
        } else{

            $usuario = $datos['usuario']; //empleados_nroPersonal
            $password = $datos['password'];
            $sede = $datos['locacion'];

            $datos = $this->obtenerDatosUsuarios($usuario,$password);

            if($datos){
                //Despues de obtener los datos del usuarios se genera el TOKEN
                $verificar = $this->insertarToken($datos[0]["loginUsuario"], $sede);

                if($verificar){
                    // Si se genero el Token
                    $result = $_respuestas->response;
                    $result["result"]=array(
                        "token"=> $verificar
                    );
                    return $result;
                }else{
                    //error al guardar
                    return $_respuestas->error_500();
                }
            }else{
                return $_respuestas->error_200("Usuario no existe");
            }

        }
    }

    //actualizada
    private function obtenerDatosUsuarios($usuario,$password){
        $query="select * from usuario where loginUsuario='".$usuario."' and passUsuario = '".$password."' and activoUsuario = 1";
        //echo $query; die;
        $datos1 = parent::ObtenerDatos($query);

        if(isset($datos1[0]["loginUsuario"])){
            return($datos1);
        }else{
            return 0;
        }
    }

    private function insertarToken($usuario, $sede){
        $val=true;
        $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
        $datetoken = date("Y-m-d H:i");
        $estadoToken=1;

        $query = "insert into usuario_token (loginUsuario, token, estado, fecha, sede) value('$usuario','$token','$estadoToken','$datetoken',' $sede')";
        $verificar = parent::nonQuery($query);
        if($verificar){
            // si incerto
            return $token;
        }else{
            //error generando token
            echo'no'; die;
            return false; //$_respuestas->error_200("Error generando el token");
        }
    }

    public function updateToken(){
      $query="DELETE FROM usuario_token
                WHERE TIMESTAMPDIFF(DAY, fecha, NOW()) > 1;
                ";
      echo $query; die;
      $datos1 = parent::ObtenerDatos($query);
      return 1;

    }

}




?>
