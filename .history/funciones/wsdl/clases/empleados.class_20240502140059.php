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


  public function getEmpleado($idUsuario)
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

  public function post($json)
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
          (!isset($datos['nom_usu'])) ||
          (!isset($datos['ape_usu'])) ||
          (!isset($datos['log_usu'])) ||
          (!isset($datos['pass_usu'])) ||
          (!isset($datos['ced_usu'])) ||
          (!isset($datos['cor_usu']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {


          // Asignacion de datos validados su existencia en el If anterior
          $this->nom_usu = @$datos['nom_usu'];
          $this->ape_usu = @$datos['ape_usu'];
          $this->log_usu = @$datos['log_usu'];
          $this->pass_usu = @$datos['pass_usu'];
          $this->tel_usu = @$datos['tel_usu'];
          $this->ced_usu = @$datos['ced_usu'];
          $this->car_usu = @$datos['car_usu'];
          $this->cor_usu = @$datos['cor_usu'];
          $this->act_usu = @$datos['act_usu'];
          $this->rol_usu = @$datos['rol_usu'];

          $this->ubicacionResidencia = @$datos['ubicacionResidencia'];
          $this->ident = @$datos['ident'];
          $this->frenteAsignado = @$datos['frenteAsignado'];
          $this->carnetizacion = @$datos['carnetizacion'];
          $this->pcModelo = @$datos['pcModelo'];
          $this->pcSerial = @$datos['pcSerial'];
          $this->pcMacLan = @$datos['pcMacLan'];
          $this->pcMacWam = @$datos['pcMacWam'];

          $this->foraneo = @$datos['foraneo'];
          $this->equipoAsignado = @$datos['equipoAsignado'];
          $this->idConsultoraContratante = @$datos['idConsultoraContratante'];

          $this->vehiculoTipo = @$datos['vehiculoTipo'];
          $this->vehiculoModelo = @$datos['vehiculoModelo'];
          $this->vehiculoMarca = @$datos['vehiculoMarca'];
          $this->vehiculoColor = @$datos['vehiculoColor'];
          $this->vehiculoPlaca = @$datos['vehiculoPlaca'];
          $this->vehiculoAnio = @$datos['vehiculoAnio'];
          $this->vehiculoAseguradora = @$datos['vehiculoAseguradora'];
          $this->vehiculoContrato = @$datos['vehiculoContrato'];



          $this->fechaCreacion = date('Y-m-d');

          if ($datos['mod'] != 1) {

            $this->idEmpleado = @$datos['idEmpleado'];
            $resp = $this->Update();
          } else {
            $resp = $this->Insertar();
          }


          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Ejecutado Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR EN LA ACCION SOBRE EL CLIENTE'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }

  private function Insertar()
  {
    $query = 'insert Into ' . $this->tabla . "
              (
                nom_usu,
                ape_usu,
                log_usu,
                pass_usu,
                act_usu,
                tel_usu,
                ced_usu,
                car_usu,
                cor_usu,
                rol_usu,
                ubicacionResidencia,
                ident,
                frenteAsignado,
                carnetizacion,
                pcModelo,
                pcSerial,
                pcMacLan,
                pcMacWam,
                foraneo,
                equipoAsignado,
                idConsultoraContratante,
                vehiculoTipo,
                vehiculoModelo,
                vehiculoMarca,
                vehiculoColor,
                vehiculoPlaca,
                vehiculoAnio,
                vehiculoAseguradora,
                vehiculoContrato
                  )
          value
          (
              '$this->nom_usu',
              '$this->ape_usu',
              '$this->log_usu',
              '$this->pass_usu',
              '$this->act_usu',
              '$this->tel_usu',
              '$this->ced_usu',
              '$this->car_usu',
              '$this->cor_usu',
              '$this->rol_usu',

              '$this->ubicacionResidencia',
              '$this->ident',
              '$this->frenteAsignado',
              '$this->carnetizacion',
              '$this->pcModelo',
              '$this->pcSerial',
              '$this->pcMacLan',
              '$this->pcMacWam',

              '$this->foraneo',
              '$this->equipoAsignado',
              '$this->idConsultoraContratante',

              '$this->vehiculoTipo',
              '$this->vehiculoModelo',
              '$this->vehiculoMarca',
              '$this->vehiculoColor',
              '$this->vehiculoPlaca',
              '$this->vehiculoAnio',
              '$this->vehiculoAseguradora',
              '$this->vehiculoContrato'
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

  private function buscarToken()
  {
    $query = "select * from dg_empleado_token where token = '$this->token' and estado = 1";

    $resp = parent::ObtenerDatos($query);

    if ($resp) {
      $actualizarToken = $this->actualizarToken($resp[0]['empleadoTokenId']);

      return $resp;
    } else {
      return 0;
    }
  }

  private function actualizarToken($tokenId)
  {
    $date = date('Y-m-d H:i');
    $query = "update dg_empleado_token set date = '$date' where empleadoTokenId = '$tokenId'";
    $resp = parent::nonQuery($query);

    if ($resp >= 1) {
      return $resp;
    } else {
      return 0;
    }
  }
}
