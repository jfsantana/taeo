<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE SEDE
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 * 'clases/SEDE.class.php';
 *************************************************************/

require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class rol extends conexion
{
  // Tabla Principal de sede
  private $tabla = 'rol';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idRol ='';
  private $descripcionRol ='';
  private $creadoPor = '';
  private $fechaCreacion = '1900-01-01'; //date('Y-m-d');
  private $orderRol ='';
  private $token = '';

  /**
   * Listado de Roles
   * http://taeo/funciones/wsdl/sede?idSede
   */
  public function getRol($idRol)//(revisado)
  {
    $where = " WHERE idRol <> '' ";
    if ($idRol != '') {
      $where =  $where . " and idRol = " . $idRol;
    }
    $query = "select * from $this->tabla $where";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;

  }

  public function getEmpleadoPorRol($idRol)//(revisado)
  {
    $where = " WHERE rol.idRol <> '' ";
    if ($idRol != '') {
      $where =  $where . " and rol.idRol = " . $idRol;
    }

    $query = "SELECT *
              FROM usuario
              INNER JOIN rol on usuario.rolUsuario=rol.idRol
              $where";

              //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  //Crear una Sede
  public function post($json)//(revisado)
  {

    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();


      if ($arrayToken) {
        if (  // valida los campos obligatorios
          (!isset($datos['descripcionRol'])) ||
          (!isset($datos['orderRol']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->descripcionRol =@$datos['descripcionRol'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$_SESSION['usuario'];
          $this->orderRol =@$datos['orderRol'];

          $resp = $this->Insertar();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se Creo Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR EN LA ACCION SOBRE LA SEDE'
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
              descripcionRol ,
              creadoPor ,
              fechaCreacion ,
              orderRol
                )
        value
        (
            '$this->descripcionRol',
            '$this->creadoPor',
            '$this->fechaCreacion',
            '$this->orderRol'
            )";

    $Insertar = parent::nonQueryId($query);

    // print_r ($Insertar);die;
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }

  //Actualizar una Sede
  public function put($json)//(revisado)
  {

    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (  // valida los campos obligatorios
          (!isset($datos['idRol'])) ||
          (!isset($datos['descripcionRol'])) ||
          (!isset($datos['orderRol']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idRol =@$datos['idRol'];
          $this->descripcionRol =@$datos['descripcionRol'];
          $this->orderRol =@$datos['orderRol'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$_SESSION['usuario'];

          $resp = $this->Update();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se Actualizo Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'No se realizo ningun cambio sobre la Sede'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }
  private function Update()//()
  {
    $query = 'update ' . $this->tabla . "
                        set
                        descripcionRol  ='$this->descripcionRol',
                        creadoPor  ='$this->creadoPor',
                        fechaCreacion  ='$this->fechaCreacion',
                        orderRol  ='$this->orderRol'

                    WHERE idRol = $this->idRol";
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  //Desactivar una Sede
  public function del($json)//()
  {

    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (  // valida los campos obligatorios
          (!isset($datos['idSede']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idSede =@$datos['idSede'];
          $resp = $this->delete();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se Desactivo Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'No se realizo ningun cambio sobre la Sede'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }
  public function delete()
  {
    $query = 'update ' . $this->tabla . "
                        set
                        activo  ='0'
                    WHERE idSede = $this->idSede";

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
