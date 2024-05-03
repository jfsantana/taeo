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
class empleados extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'usuario';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idUsuario = '';
  private $loginUsuario = '';
  private $passUsuario = '';
  private $rolUsuario = '';
  private $nombreUsuario = '';
  private $apellidoUsuario = '';
  private $cargoUsuario = '';
  private $cedulaUsuario = '';
  private $emailUsuario = '';
  private $telefonoUsuario = '';
  private $TelefonoEmergencia = '';
  private $activoUsuario = '';
  private $creadoPor = '';
  private $fechaCreacion = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getEmpleado($idUsuario) //(revisado)
  {
    $where = " WHERE usuario.idUsuario <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and usuario.idUsuario = " . $idUsuario;
    }
      $query = "SELECT usuario.*, rol.descripcionRol, case when usuario.activoUsuario = 1 Then 'Activo' else 'Bloqeuado' end estado, usuario_sede.idSede, sede.nombreSede FROM usuario
                INNER JOIN rol ON usuario.rolUsuario = rol.idRol
                  INNER JOIN usuario_sede on usuario_sede.idUsuario=usuario.idUsuario
                  INNER JOIN sede on sede.idSede=usuario_sede.idSede $where  group by usuario.idUsuario";

    return parent::ObtenerDatos($query);
  }


  public function getCargos($idUsuario) //(revisado)
  {
    $where = " WHERE cargo.idcargos <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and cargo.idUsuario = " . $idUsuario;
    }
      $query = "SELECT * FROM cargo". " $where ";

    return parent::ObtenerDatos($query);
  }

  public function obtenerEmpleadoToken($token)  //(revisado)
  {

    $query = "SELECT
                usuario.*,
                rol.descripcionRol,
                usuario_sede.idSede
                FROM
                usuario_token
                INNER JOIN usuario ON usuario_token.loginUsuario = usuario.loginUsuario
                INNER JOIN rol ON usuario.rolUsuario = rol.idRol
                INNER JOIN usuario_sede ON usuario_token.sede=usuario.idUsuario
                WHERE
                usuario_token.token =  '$token'";

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
          (!isset($datos['loginUsuario'])) ||
          (!isset($datos['passUsuario'])) ||
          (!isset($datos['rolUsuario'])) ||
          (!isset($datos['nombreUsuario'])) ||
          (!isset($datos['apellidoUsuario'])) ||
          (!isset($datos['cargoUsuario'])) ||
          (!isset($datos['cedulaUsuario'])) ||
          (!isset($datos['emailUsuario'])) ||
          (!isset($datos['telefonoUsuario']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idUsuario = @$datos['idUsuario'];
          $this->loginUsuario = @$datos['loginUsuario'];
          $this->passUsuario = @$datos['passUsuario'];
          $this->rolUsuario = @$datos['rolUsuario'];
          $this->nombreUsuario = @$datos['nombreUsuario'];
          $this->apellidoUsuario = @$datos['apellidoUsuario'];
          $this->cargoUsuario = @$datos['cargoUsuario'];
          $this->cedulaUsuario = @$datos['cedulaUsuario'];
          $this->emailUsuario = @$datos['emailUsuario'];
          $this->telefonoUsuario = @$datos['telefonoUsuario'];
          $this->TelefonoEmergencia = @$datos['TelefonoEmergencia'];
          $this->activoUsuario = @$datos['activoUsuario'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$datos['creadoPor'];

          if(@$datos['mod']==1){
            $resp = $this->Insertar();
          }else{
            $resp = $this->Update();
          }


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
                loginUsuario,
                passUsuario,
                rolUsuario,
                nombreUsuario,
                apellidoUsuario,
                cargoUsuario,
                cedulaUsuario,
                emailUsuario,
                telefonoUsuario,
                TelefonoEmergencia,
                activoUsuario,
                fechaCreacion,
                creadoPor
                  )
          value
          (
              '$this->loginUsuario',
              '$this->passUsuario',
              '$this->rolUsuario',
              '$this->nombreUsuario',
              '$this->apellidoUsuario',
              '$this->cargoUsuario',
              '$this->cedulaUsuario',
              '$this->emailUsuario',
              '$this->telefonoUsuario',
              '$this->TelefonoEmergencia',
              '$this->activoUsuario',
              '$this->fechaCreacion',
              '$this->creadoPor'
              )";


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
          (!isset($datos['idUsuario'])) ||
          (!isset($datos['loginUsuario'])) ||
          (!isset($datos['passUsuario'])) ||
          (!isset($datos['rolUsuario'])) ||
          (!isset($datos['nombreUsuario'])) ||
          (!isset($datos['apellidoUsuario'])) ||
          (!isset($datos['cargoUsuario'])) ||
          (!isset($datos['cedulaUsuario'])) ||
          (!isset($datos['emailUsuario'])) ||
          (!isset($datos['telefonoUsuario']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          $this->idUsuario = @$datos['idUsuario'];
          $this->loginUsuario = @$datos['loginUsuario'];
          $this->passUsuario = @$datos['passUsuario'];
          $this->rolUsuario = @$datos['rolUsuario'];
          $this->nombreUsuario = @$datos['nombreUsuario'];
          $this->apellidoUsuario = @$datos['apellidoUsuario'];
          $this->cargoUsuario = @$datos['cargoUsuario'];
          $this->cedulaUsuario = @$datos['cedulaUsuario'];
          $this->emailUsuario = @$datos['emailUsuario'];
          $this->telefonoUsuario = @$datos['telefonoUsuario'];
          $this->TelefonoEmergencia = @$datos['TelefonoEmergencia'];
          $this->activoUsuario = @$datos['activoUsuario'];
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

  private function Update()//(revisado)
  {
    $query = 'update ' . $this->tabla . "
                          set
                          passUsuario='$this->passUsuario',
                          rolUsuario='$this->rolUsuario',
                          nombreUsuario='$this->nombreUsuario',
                          apellidoUsuario='$this->apellidoUsuario',
                          cargoUsuario='$this->cargoUsuario',
                          emailUsuario='$this->emailUsuario',
                          telefonoUsuario='$this->telefonoUsuario',
                          TelefonoEmergencia='$this->TelefonoEmergencia',
                          activoUsuario='$this->activoUsuario',
                          fechaCreacion='$this->fechaCreacion',
                          creadoPor='$this->creadoPor'

                      WHERE idUsuario = $this->idUsuario";

                      //echo  $query; die;echo  $query; die;
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
          !isset($datos['idUsuario'])
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idUsuario = $datos['idUsuario'];

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
        WHERE idUsuario = $this->idUsuario";
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
