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
class objetivo extends conexion
{
  // Tabla Principal de Empleados
  private $tablaHeader = 'objetivo_header';
  private $tablaItems = 'objetivo_item';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idObjetivoHeader ='';
  private $nombreObjetivo ='';
  private $versionObjetivo ='';
  private $creadoPor = '';
  private $activo='';
  private $fechaCreacion = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getObjetivosHeadere($idObjetivoHeader) //()
  {
    $where = " WHERE idObjetivoHeader <> '' ";
    if ($idObjetivoHeader != '') {
      $where =  $where . " and idObjetivoHeader = " . $idObjetivoHeader;
    }
    $query = "select *, case when objetivo_header.activo = 1 Then 'Activo' else 'Bloqueado' end estado from " . $this->tablaHeader . " $where ";
    //echo   $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getIemsByHeader($idRepresentante) //()
  {
    $where = " WHERE t1.activo = 1 ";
    if ($idRepresentante != '') {
      $where =  $where . " and t1.id_padre = " . $idRepresentante;
    }
    $query = "SELECT t1.jerarquia,CONCAT(REPEAT(' ', LENGTH(t1.jerarquia) - LENGTH(REPLACE(t1.jerarquia, '.', ''))), t1.descripcion) as descripcion, t1.id_padre, t1.id
    FROM objetivo_item AS t1

    $where

    ORDER BY t1.jerarquia, t1.id_padre ";
   // echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getidPadreByHeader($idHeader) //()
  {
    $where = " WHERE activo = 1 and objetivo_item.id_padre is null";
    if ($idHeader != '') {
      $where =  $where . " and objetivo_item.idHeader  = " . $idHeader;
    }
    $query = "SELECT * FROM objetivo_item  $where order by jerarquia  ";

    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getIemsByPadre($id_padre) //()
  {
    $where = " WHERE activo = 1 ";
    if ($id_padre != '') {
      $where =  $where . " and objetivo_item.id_padre = " . $id_padre;
    }
    $query = "SELECT * FROM objetivo_item  $where order by jerarquia  ";
  //    echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function post($json)  //()
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
          (strlen($datos['nombreObjetivo'])>2)||
          (!isset($datos['versionObjetivo'])) ||
          (!isset($datos['activo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
            $this->idObjetivoHeader = @$datos['idObjetivoHeader'];
            $this->nombreObjetivo = @$datos['nombreObjetivo'];
            $this->versionObjetivo = @$datos['versionObjetivo'];
            $this->fechaCreacion = date('Y-m-d');
            $this->creadoPor =  @$datos['creadoPor'];//@$_SESSION['usuario'];
            $this->activo = @$datos['activo'];



          if($datos['mod']==1){
            $resp = $this->InsertarHeader();
          }elseif($datos['mod']==2){

            $resp = $this->UpdateHeader();
          }


          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Operacion Finalizada con Exito'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR - Operacion con el Representante'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }

  private function InsertarHeader()//()
  {
    $query = 'insert Into ' . $this->tablaHeader . "
              (
                nombreObjetivo,
                versionObjetivo,
                activo,
                fechaCreacion,
                creadoPor
                  )
          value
          (
              '$this->nombreObjetivo',
              '$this->versionObjetivo',
              '$this->activo',
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

  private function UpdateHeader()//()
  {
    $query = 'update ' . $this->tablaHeader . "
                          set
                          nombreObjetivo='$this->nombreObjetivo',
                          versionObjetivo='$this->versionObjetivo',
                          activo='$this->activo',
                          fechaCreacion='$this->fechaCreacion',
                          creadoPor='$this->creadoPor'
                      WHERE idObjetivoHeader = $this->idObjetivoHeader";

                      //echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }



  private function buscarToken()//()
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

  private function actualizarToken($tokenId) //()
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
