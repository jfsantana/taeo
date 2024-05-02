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

class sede extends conexion
{
  // Tabla Principal de sede
  private $tabla = 'sede';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idSede ='';
  private $nombreSede ='';
  private $paisSede ='';
  private $ciudadSede ='';
  private $direccionSede ='';
  private $rifSede ='';
  private $telefonoSede ='';
  private $emailSede ='';
  private $activo = '';
  private $fechaCreacion = '1900-01-01'; //date('Y-m-d');
  private $creador = '';
  private $token = '';




  private $nombreEmpresaConsultora = '';
  private $idEmpresaConsultora = '';
  private $idAprobador ='';



  /**
   * Listado de Sedes
   * http://taeo/funciones/wsdl/sede?idSede
   */
  public function getSede($idSede)
  {
    $where = " WHERE idSede <> '' ";
    if ($idSede != '') {
      $where =  $where . " and idSede = " . $idSede;
    }
    $query = "select *, CASE WHEN activo = 1 THEN 'Activo' ELSE 'Desactivado' END AS estado  from $this->tabla $where";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;

  }

  public function getEmpleadoPorSede($idSede)
  {
    $where = " WHERE sede.idSede <> '' ";
    if ($idSede != '') {
      $where =  $where . " and usuario_sede.idSede = " . $idSede;
    }

    $query = "SELECT sede.nombreSede,usuario.*
              FROM usuario_sede
                inner join  usuario on usuario_sede.idUsuario=usuario.idUsuario
                inner join sede on usuario_sede.idSede=sede.idSede
              $where";

              //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  //Crear una Sede
  public function post($json)
  {



    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();
      return ($arrayToken); die;
      if ($arrayToken) {
        // valida los campos obligatorios
        if (
          (!isset($datos['nombreEmpresaConsultora'])) ||
          (!isset($datos['activo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {


          // Asignacion de datos validados su existencia en el If anterior
          $this->nombreEmpresaConsultora = @$datos['nombreEmpresaConsultora'];
          $this->activo = @$datos['activo'];
          $this->fechaCreacion = date('Y-m-d');

          $this->idAprobador = implode(",", @$datos['aprobador']);

          //$stringAprobador = implode(",", $aprobador);




          if ($datos['mod'] != 1) {

            $this->idEmpresaConsultora = @$datos['idEmpresaConsultora'];
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
              'mensaje' => 'ERROR EN LA ACCION SOBRE LA CONSULTORA'
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
              nombreEmpresaConsultora,
              activo,
              idAprobador
                )
        value
        (
            '$this->nombreEmpresaConsultora',
            $this->activo,
            '$this->idAprobador'
            )";
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

                        nombreEmpresaConsultora ='$this->nombreEmpresaConsultora',
                        activo =$this->activo,
                        idAprobador='$this->idAprobador'


                    WHERE idEmpresaConsultora = $this->idEmpresaConsultora";
    //echo $query; die;
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
        WHERE id =";

    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  private function buscarToken()
  {
    $query = "select * from usuario_token where token = '$this->token' and estado = 1";

    $resp = parent::ObtenerDatos($query);
return $resp; die;
    if ($resp) {
      $actualizarToken = $this->actualizarToken($resp[0]['idusuario_token']);

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
