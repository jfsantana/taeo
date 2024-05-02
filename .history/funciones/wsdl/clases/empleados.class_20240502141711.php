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
    $where = " WHERE idUsuario <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and idUsuario = " . $idUsuario;
    }
    $query = 'select * from ' . $this->tabla . " $where ";

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
          // Asignacion de datos validados su existencia en el If anterior
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

    //echo $query; die;
    $Insertar = parent::nonQueryId($query);

    // print_r ($Insertar);die;
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }

  private function Update()
  {
    $query = 'update ' . $this->tabla . "
                          set
                          nom_usu='$this->nom_usu',
                          ape_usu='$this->ape_usu',
                          log_usu='$this->log_usu',
                          pass_usu='$this->pass_usu',
                          act_usu='$this->act_usu',
                          tel_usu='$this->tel_usu',
                          ced_usu='$this->ced_usu',
                          car_usu='$this->car_usu',
                          cor_usu='$this->cor_usu',
                          rol_usu='$this->rol_usu',

                          ubicacionResidencia='$this->ubicacionResidencia',
                          ident='$this->ident',
                          frenteAsignado='$this->frenteAsignado',
                          carnetizacion='$this->carnetizacion',
                          pcModelo='$this->pcModelo',
                          pcSerial='$this->pcSerial',
                          pcMacLan='$this->pcMacLan',
                          pcMacWam='$this->pcMacWam',


                          foraneo='$this->foraneo',
                          equipoAsignado='$this->equipoAsignado',
                          idConsultoraContratante='$this->idConsultoraContratante',

                          vehiculoTipo='$this->vehiculoTipo',
                          vehiculoModelo='$this->vehiculoModelo',
                          vehiculoMarca='$this->vehiculoMarca',
                          vehiculoColor='$this->vehiculoColor',
                          vehiculoPlaca='$this->vehiculoPlaca',
                          vehiculoAnio='$this->vehiculoAnio',
                          vehiculoAseguradora='$this->vehiculoAseguradora',
                          vehiculoContrato='$this->vehiculoContrato'
                      WHERE id_usu = $this->idEmpleado";
    //echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  public function delete($json)
  {
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {
      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        // solo validamos que tenga la clave primaria para poder eliminar correctamente el resgitro
        if (
          !isset($datos['id'])
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          // $this->id = $datos['id'];

          // llama a la funcion de insertar
          $resp = $this->EliminarEmpleados();

          // valida que paso d/rante el inser
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

  private function EliminarEmpleados()
  {
    $query = "delete from $this->tabla
        WHERE id = $ this->id";

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
