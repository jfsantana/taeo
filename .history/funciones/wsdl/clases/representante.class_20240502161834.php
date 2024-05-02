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
class representante extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'representantes';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idRepresentante = '';
  private $nombreRepresentante = '';
  private $apellidoRepresentante = '';
  private $cedulaRepresentante = '';
  private $profesionRepresentante = '';
  private $lugarTrabajoRepresentante = '';
  private $correoRepresentante = '';
  private $telefonoRepresentante = '';
  private $parentescoRepresentante = '';
  private $retirarAprendiz = '';
  private $razonSocialRepresentante = '';
  private $rifRepresentante = '';
  private $direccionFiscalRepresentante = '';
  private $activoRepresentante = '';
  private $creadoPor = '';
  private $fechaCreacion = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getRepresentante($idRepresentante) //(revisado)
  {
    $where = " WHERE activoRepresentante = 1 ";
    if ($idRepresentante != '') {
      $where =  $where . " and idRepresentante = " . $idRepresentante;
    }
    $query = 'select * from ' . $this->tabla . " $where ";

    return parent::ObtenerDatos($query);
  }

  public function getAprendizByRepresentante($idRepresentante) //(revisado)
  {
    $where = " WHERE aprendiz_representante.activoAprendiz = 1 ";
    if ($idRepresentante != '') {
      $where =  $where . " and aprendiz_representante.idRepresentante = " . $idRepresentante;
    }
    $query = "SELECT  aprendiz.*  FROM aprendiz_representante INNER JOIN aprendiz on aprendiz.idAprendiz=aprendiz_representante.idAprendiz $where ";

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
        // valida los campos obligatorios
        if (
          (!isset($datos['nombreRepresentante'])) ||
          (!isset($datos['apellidoRepresentante'])) ||
          (!isset($datos['cedulaRepresentante'])) ||
          (!isset($datos['profesionRepresentante'])) ||
          (!isset($datos['lugarTrabajoRepresentante'])) ||
          (!isset($datos['correoRepresentante'])) ||
          (!isset($datos['telefonoRepresentante'])) ||
          (!isset($datos['parentescoRepresentante']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          $this->nombreRepresentante = @$datos['nombreRepresentante'];
          $this->apellidoRepresentante = @$datos['apellidoRepresentante'];
          $this->cedulaRepresentante = @$datos['cedulaRepresentante'];
          $this->profesionRepresentante = @$datos['profesionRepresentante'];
          $this->lugarTrabajoRepresentante = @$datos['lugarTrabajoRepresentante'];
          $this->correoRepresentante = @$datos['correoRepresentante'];
          $this->telefonoRepresentante = @$datos['telefonoRepresentante'];
          $this->parentescoRepresentante = @$datos['parentescoRepresentante'];
          $this->retirarAprendiz = @$datos['retirarAprendiz'];
          $this->rifRepresentante = @$datos['rifRepresentante'];
          $this->direccionFiscalRepresentante = @$datos['direccionFiscalRepresentante'];
          $this->activoRepresentante ="1";
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$_SESSION['usuario'];

          $resp = $this->Insertar();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se creo Correctamente el Representante'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR - Creacion del Representante'
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
                nombreRepresentante,
                apellidoRepresentante,
                cedulaRepresentante,
                profesionRepresentante,
                lugarTrabajoRepresentante,
                correoRepresentante,
                telefonoRepresentante,
                parentescoRepresentante,
                retirarAprendiz,
                razonSocialRepresentante,
                rifRepresentante,
                direccionFiscalRepresentante,
                activoRepresentante,
                creadoPor,
                fechaCreacion
                  )
          value
          (
              '$this->nombreRepresentante',
              '$this->apellidoRepresentante',
              '$this->cedulaRepresentante',
              '$this->profesionRepresentante',
              '$this->lugarTrabajoRepresentante',
              '$this->correoRepresentante',
              '$this->telefonoRepresentante',
              '$this->parentescoRepresentante',
              '$this->retirarAprendiz',
              '$this->razonSocialRepresentante',
              '$this->rifRepresentante',
              '$this->direccionFiscalRepresentante',
              '$this->activoRepresentante',
              '$this->rifRepresentante',
              '$this->creadoPor',
              '$this->fechaCreacion'

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
        // valida los campos obligatorios
        if (
          (!isset($datos['idRepresentante'])) ||
          (!isset($datos['nombreRepresentante'])) ||
          (!isset($datos['apellidoRepresentante'])) ||
          (!isset($datos['cedulaRepresentante'])) ||
          (!isset($datos['profesionRepresentante'])) ||
          (!isset($datos['lugarTrabajoRepresentante'])) ||
          (!isset($datos['correoRepresentante'])) ||
          (!isset($datos['telefonoRepresentante'])) ||
          (!isset($datos['parentescoRepresentante']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          $this->idRepresentante = @$datos['idRepresentante'];
          $this->nombreRepresentante = @$datos['nombreRepresentante'];
          $this->apellidoRepresentante = @$datos['apellidoRepresentante'];
          $this->cedulaRepresentante = @$datos['cedulaRepresentante'];
          $this->profesionRepresentante = @$datos['profesionRepresentante'];
          $this->lugarTrabajoRepresentante = @$datos['lugarTrabajoRepresentante'];
          $this->correoRepresentante = @$datos['correoRepresentante'];
          $this->telefonoRepresentante = @$datos['telefonoRepresentante'];
          $this->parentescoRepresentante = @$datos['parentescoRepresentante'];
          $this->retirarAprendiz = @$datos['retirarAprendiz'];
          $this->rifRepresentante = @$datos['rifRepresentante'];
          $this->direccionFiscalRepresentante = @$datos['direccionFiscalRepresentante'];
          $this->activoRepresentante ="1";
          $this->creadoPor = @$_SESSION['usuario'];
          $this->fechaCreacion = date('Y-m-d');


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
                          nombreRepresentante='$this->nombreRepresentante',
                          apellidoRepresentante='$this->apellidoRepresentante',
                          cedulaRepresentante='$this->cedulaRepresentante',
                          profesionRepresentante='$this->profesionRepresentante',
                          lugarTrabajoRepresentante=$this->lugarTrabajoRepresentante,
                          correoRepresentante='$this->correoRepresentante',
                          telefonoRepresentante='$this->telefonoRepresentante',
                          parentescoRepresentante='$this->parentescoRepresentante',
                          retirarAprendiz='$this->retirarAprendiz',
                          rifRepresentante='$this->rifRepresentante',
                          direccionFiscalRepresentante='$this->direccionFiscalRepresentante',
                          activoRepresentante='$this->activoRepresentante',
                          fechaCreacion='$this->fechaCreacion',
                          creadoPor='$this->creadoPor'

                      WHERE idRepresentante = $this->idRepresentante";

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
          !isset($datos['idRepresentante'])
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idRepresentante = $datos['idRepresentante'];

          $resp = $this->EliminarEmpleados();

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

  private function EliminarEmpleados()//(revisado)
  {
    $query = "delete from $this->tabla
        WHERE idRepresentante = $this->idRepresentante";
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
