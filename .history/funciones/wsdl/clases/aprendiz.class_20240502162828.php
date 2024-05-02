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
class aprendiz extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'aprendiz';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idAprendiz = '';
  private $nombreAprendiz = '';
  private $apellidoAprendiz = '';
  private $fechaNacimientoAprendiz = '';
  private $colegioAprendiz = '';
  private $gradoAprendiz = '';
  private $escolaridadAprendiz = '';
  private $direccionAprendiz = '';
  private $paisAprendiz = '';
  private $ciudadAprendiz = '';
  private $coordinadoraAprendiz = '';
  private $facilitadoraAprendiz = '';
  private $activoAprendiz = '';
  private $creadoPor = '';
  private $fechaCreacion = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getAprendiz($idAprendiz) //(revisado)
  {
    $where = " WHERE idAprendiz <> '' ";
    if ($idAprendiz != '') {
      $where =  $where . " and idAprendiz = " . $idAprendiz;
    }
    $query = 'select * from ' . $this->tabla . " $where ";

    return parent::ObtenerDatos($query);
  }

  public function getRepresentanteByAprendiz($idAprendiz) //(revisado)
  {
    $where = " WHERE aprendiz_representante.idAprendiz <> '' ";
    if ($idAprendiz != '') {
      $where =  $where . " and aprendiz_representante.idAprendiz = " . $idAprendiz;
    }
    $query = "SELECT representantes.*
              FROM aprendiz_representante
              INNER JOIN representantes on representantes.idRepresentante=aprendiz_representante.idRepresentante $where ";

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
          (!isset($datos['nombreAprendiz'])) ||
          (!isset($datos['apellidoAprendiz'])) ||
          (!isset($datos['fechaNacimientoAprendiz'])) ||
          (!isset($datos['colegioAprendiz'])) ||
          (!isset($datos['gradoAprendiz'])) ||
          (!isset($datos['escolaridadAprendiz'])) ||
          (!isset($datos['direccionAprendiz'])) ||
          (!isset($datos['paisAprendiz'])) ||
          (!isset($datos['ciudadAprendiz'])) ||
          (!isset($datos['coordinadoraAprendiz'])) ||
          (!isset($datos['facilitadoraAprendiz']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          $this->nombreAprendiz = @$datos['nombreAprendiz'];
          $this->apellidoAprendiz = @$datos['apellidoAprendiz'];
          $this->fechaNacimientoAprendiz = @$datos['fechaNacimientoAprendiz'];
          $this->colegioAprendiz = @$datos['colegioAprendiz'];
          $this->gradoAprendiz = @$datos['gradoAprendiz'];
          $this->escolaridadAprendiz = @$datos['escolaridadAprendiz'];
          $this->direccionAprendiz = @$datos['direccionAprendiz'];
          $this->paisAprendiz = @$datos['paisAprendiz'];
          $this->ciudadAprendiz = @$datos['ciudadAprendiz'];
          $this->coordinadoraAprendiz = @$datos['coordinadoraAprendiz'];
          $this->facilitadoraAprendiz = @$datos['facilitadoraAprendiz'];
          $this->activoAprendiz ="1";
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
                nombreAprendiz,
                apellidoAprendiz,
                fechaNacimientoAprendiz,
                colegioAprendiz,
                gradoAprendiz,
                escolaridadAprendiz,
                direccionAprendiz,
                paisAprendiz,
                ciudadAprendiz,
                coordinadoraAprendiz,
                facilitadoraAprendiz,
                activoAprendiz,
                fechaCreacion,
                creadoPor
                  )
          value
          (
              '$this->nombreAprendiz',
              '$this->apellidoAprendiz',
              '$this->fechaNacimientoAprendiz',
              '$this->colegioAprendiz',
              '$this->gradoAprendiz',
              '$this->escolaridadAprendiz',
              '$this->direccionAprendiz',
              '$this->paisAprendiz',
              '$this->ciudadAprendiz',
              '$this->coordinadoraAprendiz',
              '$this->facilitadoraAprendiz',
              '$this->activoAprendiz',
              '$this->fechaCreacion',
              '$this->creadoPor'
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
          (!isset($datos['idAprendiz'])) ||
          (!isset($datos['nombreAprendiz'])) ||
          (!isset($datos['apellidoAprendiz'])) ||
          (!isset($datos['fechaNacimientoAprendiz'])) ||
          (!isset($datos['colegioAprendiz'])) ||
          (!isset($datos['gradoAprendiz'])) ||
          (!isset($datos['escolaridadAprendiz'])) ||
          (!isset($datos['direccionAprendiz'])) ||
          (!isset($datos['paisAprendiz'])) ||
          (!isset($datos['ciudadAprendiz'])) ||
          (!isset($datos['coordinadoraAprendiz'])) ||
          (!isset($datos['facilitadoraAprendiz']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          $this->idAprendiz = @$datos['idAprendiz'];
          $this->nombreAprendiz = @$datos['nombreAprendiz'];
          $this->apellidoAprendiz = @$datos['apellidoAprendiz'];
          $this->fechaNacimientoAprendiz = @$datos['fechaNacimientoAprendiz'];
          $this->colegioAprendiz = @$datos['colegioAprendiz'];
          $this->gradoAprendiz = @$datos['gradoAprendiz'];
          $this->escolaridadAprendiz = @$datos['escolaridadAprendiz'];
          $this->direccionAprendiz = @$datos['direccionAprendiz'];
          $this->paisAprendiz = @$datos['paisAprendiz'];
          $this->ciudadAprendiz = @$datos['ciudadAprendiz'];
          $this->coordinadoraAprendiz = @$datos['coordinadoraAprendiz'];
          $this->facilitadoraAprendiz = @$datos['facilitadoraAprendiz'];
          $this->activoAprendiz ="1";
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$_SESSION['usuario'];


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

  private function Update()//()
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

  private function EliminarEmpleados()//()
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
