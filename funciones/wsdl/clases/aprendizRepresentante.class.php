<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE EMPLEADOS
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 *
 * 'clases/empleados.class.php';
 *************************************************************/

require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

// hereda de la clase conexion
class aprendizRepresentante extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'aprendiz_representante';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idAprendizRepresentante ='';
  private $idAprendiz = '';
  private $idRepresentante = '';

  private $token = '';



  public function post($json)  //(revisado)
  {
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (
          (!isset($datos['idAprendiz'])) ||
          (!isset($datos['idRepresentante']))
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idAprendiz = @$datos['idAprendiz'];
          $this->idRepresentante = @$datos['idRepresentante'];

          $resp = $this->Insertar();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se creo Correctamente el Facilitador'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR - Creacion del Facilitador'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }

  private function Insertar()//(revisado)
  {
    $query = 'insert Into ' . $this->tabla . "
              (
                idAprendiz,
                idRepresentante,
                  )
          value
          (
              '$this->idAprendiz',
              '$this->idRepresentante'
              )";
    //echo $query; die;
    $Insertar = parent::nonQueryId($query);

    // print_r ($Insertar);die;
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }

  public function put($json)  //(revisado)
  {
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (
          (!isset($datos['idAprendizRepresentante'])) ||
          (!isset($datos['idAprendiz'])) ||
          (!isset($datos['idRepresentante']))
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idAprendizRepresentante = @$datos['idAprendizRepresentante'];
          $this->idAprendiz = @$datos['idAprendiz'];
          $this->idRepresentante = @$datos['idRepresentante'];

          $resp = $this->Update();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se ActualiO Correctamente el Facilitador'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'No se ejecuto ningun cambio en el Facilitador'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }

  private function Update()//(revisado)
  {
    $query = 'update ' . $this->tabla . "
                          set
                          idAprendiz=$this->idAprendiz,
                          idRepresentante='$this->idRepresentante'
                      WHERE idAprendizRepresentante = $this->idAprendizRepresentante";
                      //echo  $query; die;
    $update = parent::nonQuery($query);


    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  public function del($json)//(revisado)
  {
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {
      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (
          (
            (!isset($datos['idAprendiz'])) ||
            (!isset($datos['idRepresentante']))
          )
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idAprendiz = @$datos['idAprendiz'];
          $this->idRepresentante = @$datos['idRepresentante'];

          $resp = $this->Eliminar();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['result'] = [
              'Msg' => "eliminado el registro $ this->id",
            ];

            return $respuesta;
          } else {
            return $_respuestas->error_500();
          }
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }

  private function Eliminar()//(revisado)
  {
    $query = "delete from $this->tabla
        WHERE idAprendiz = $this->idAprendiz and  idRepresentante = $this->idRepresentante";
    $update = parent::nonQuery($query);
    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  private function buscarToken()//(revisado)
  {
    $query = "select * from usuario_token where token = '$this->token' and estado = 1";

    $resp = parent::ObtenerDatos($query);

    if ($resp) {
      $actualizarToken = $this->actualizarToken($resp[0]['idusuaio_token']);

      return $resp;
    } else {
      return 0;
    }
  }

  private function actualizarToken($tokenId) //(revisado)
  {
    $date = date('Y-m-d H:i');
    $query = "update usuario_token set fecha = '$date' where idusuaio_token = '$tokenId'";
    $resp = parent::nonQuery($query);

    if ($resp >= 1) {
      return $resp;
    } else {
      return 0;
    }
  }
}
