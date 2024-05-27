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
class area extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'areasobjetivos';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idAreas = '';
  private $nombreArea = '';
  private $descripcionArea = '';
  private $activo = '';
  private $idNivelAreaObjetivo = '';
  private $creadoPor = '';
  private $fechaCreacion = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getArea($idAreas) //(revisado)
  {
    $where = " WHERE idArea <> '' ";
    if ($idAreas != '') {
      $where =  $where . " and idArea = " . $idAreas;
    }
    $query = "select * , case when activo = 1 Then 'Activo' else 'Bloqueado' end estado from " . $this->tabla . " $where ";

    return parent::ObtenerDatos($query);
  }

  public function getNiveleByArea($idAreas) //(revisado)
  {
    $where = " WHERE idNivelAreaObjetivo <> '' ";
    if ($idAreas != '') {
      $where =  $where . " and idAreaObjetivo = " . $idAreas;
    }
    $query = "SELECT nivelareaobjetivo.*  , case when activo = 1 Then 'Activo' else 'Bloqueado' end estado
              FROM  nivelareaobjetivo
               $where ";

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
          (!isset($datos['nombreArea'])) ||
          (!isset($datos['descripcionArea'])) ||
          (!isset($datos['idNivelAreaObjetivo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
          $this->idAreas = @$datos['idAreas'];
          $this->nombreArea = @$datos['nombreArea'];
          $this->descripcionArea = @$datos['descripcionArea'];
          $this->activo =@$datos['activo'];
          $this->idNivelAreaObjetivo = @$datos['idNivelAreaObjetivo'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$datos['creadoPor'];

          if($datos['mod']==1){
            $resp = $this->Insertar();
          }elseif($datos['mod']==2){
            $resp = $this->Update();
          }


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

                nombreArea,
                descripcionArea,
                activo,
                idNivelAreaObjetivo,
                fechaCreacion,
                creadoPor
                  )
          value
          (
              '$this->nombreArea',
              '$this->descripcionArea',
              '$this->activo',
              '$this->idNivelAreaObjetivo',
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

  private function Update()//(revisado)
  {
    $query = 'update ' . $this->tabla . "
                          set
                          nombreArea='$this->nombreArea',
                          descripcionArea='$this->descripcionArea',
                          activo='$this->activo',
                          idNivelAreaObjetivo='$this->idNivelAreaObjetivo',
                          fechaCreacion='$this->fechaCreacion',
                          creadoPor='$this->creadoPor'
                      WHERE idAreas = $this->idAreas";

                      //echo  $query; die;
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
