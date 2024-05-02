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
class empleadosSede extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'usuario_sede';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idusuario_sede = '';
  private $idUsuario = '';
  private $idSede = '';
  private $token = '';


  public function getSedesEmpleados($idUsuario) //(revisado)
  {
    $where = " WHERE idUsuario <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and idUsuario = " . $idUsuario;
    }
    $query = 'select * from ' . $this->tabla . " $where ";

    return parent::ObtenerDatos($query);
  }

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
          (!isset($datos['idUsuario'])) ||
          (!isset($datos['idSede']))
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idUsuario = @$datos['idUsuario'];
          $this->idSede = @$datos['idSede'];

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
                idUsuario,
                idSede,
                  )
          value
          (
              '$this->idUsuario',
              '$this->idSede'
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
          (!isset($datos['idusuario_sede'])) ||
          (!isset($datos['idUsuario'])) ||
          (!isset($datos['idSede']))
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idusuario_sede = @$datos['idusuario_sede'];
          $this->idUsuario = @$datos['idUsuario'];
          $this->idSede = @$datos['idSede'];

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
                          idUsuario=$this->idUsuario,
                          idSede='$this->idSede'
                      WHERE idusuario_sede = $this->idusuario_sede";
                      //echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  public function del($json)//(-----)
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
          !isset($datos['idusuario_sede'])
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idusuario_sede = $datos['idusuario_sede'];

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

  private function Eliminar()//(-----)
  {
    $query = "delete from $this->tabla
        WHERE idusuario_sede = $this->idusuario_sede";
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
