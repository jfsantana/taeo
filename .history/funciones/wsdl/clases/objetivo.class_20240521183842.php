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
//carga xlxs
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
//fin carga xlxs

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
          (strlen($datos['nombreObjetivo'])<>'')&&
          (!isset($datos['versionObjetivo'])) &&
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
            $resp = 11; //$this->InsertarHeader();
            $idHeader = $resp ;
            if($resp){
              $respItem = $this->uploadXls($idHeader, $datos['file']);
            }

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

  public function jerarquiaValidate($jerarquia){

    if (strlen($jerarquia)==1)
      return $jerarquia;
    else{

      $string = $jerarquia;
      $lastDotPosition = strrpos($string, '.');
      $newString = substr($string, 0, $lastDotPosition);

      return $newString;
    }
}

  private function insertItems($idHeader, $jerarquia, $id_padre, $descripcion,$activo){
          $query = "insert Into objetivo_item
          (
            idHeader,
            jerarquia,
            id_padre,
            descripcion,
            activo
              )
      value
      (
          '$idHeader',
          '$jerarquia',";
      if($id_padre==''){
        $query = $query ."null,";

      } else{
          $query = $query ."'$id_padre',";
      }
      $query = $query ."'$descripcion',
        '$activo'
        )";


        //echo $query; die;
      $Insertar = parent::nonQueryId($query);

       //print_r ($Insertar);die;
      if ($Insertar) {
      return $Insertar;
      } else {
      return null;
      }
  }

  public function uploadXls($idHeader, $file){
    //valores para el insert
    $activo =1;
    $jerarquiaAnterior='';
    $id_padre=null;
    $jerarquia='';
    $descripcion='';

    $spreadsheet = new Spreadsheet();

    $inputFileType = 'Xlsx';
    $inputFileName = 'C:\wamp64\tmp\cargaObjetivoV2.xlsx';

    $spreadsheet = IOFactory::load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();

    $highestRow = $sheet->getHighestRow();  //calcula el numero maximo de filas
    $highestColumn = $sheet->getHighestColumn();  //calcula el numero maximo de columnas

    $line=0;
    for ($row = 2; $row <= $highestRow; $row++) { //recorre las filas

      $jerarquia = $sheet->getCell('A' . $row)->getValue();
      $descripcion = $sheet->getCell('B' . $row)->getValue();

      if($jerarquiaAnterior==''){// es la primera corrida
        $insert = $this->insertItems($idHeader, $jerarquia, null, $descripcion,$activo);
        $jerarquiaAnterior = $this->jerarquiaValidate($jerarquia);
        $id_padre = $insert ;
      }else{
        $jerarquiaValor = $this->jerarquiaValidate($jerarquia);

        if($jerarquiaAnterior==$jerarquiaValor){

          echo '$jerarquiaAnterior==$jerarquiaValor'."\n";
          echo $jerarquiaAnterior.' - '.$jerarquiaValor."\n";
          echo $idHeader.'- '.$jerarquia.'- '.$id_padre.'- '.$descripcion.'- '.$activo."\n";
          echo "***************************\n";

          $insert = $this->insertItems($idHeader, $jerarquia, $id_padre, $descripcion,$activo);

        }else{

          echo '$jerarquiaAnterior!=$jerarquiaValor'."\n";

          if(strlen($jerarquiaValor)>2){
            $insert = $this->insertItems($idHeader, $jerarquia, $id_padre, $descripcion,$activo);
          }else{
            $insert = $this->insertItems($idHeader, $jerarquia, null, $descripcion,$activo);
            echo $idHeader.'- '.$jerarquia.'- null- '.$descripcion.'- '.$activo."\n";
          }


          echo $jerarquiaAnterior.' - '.$jerarquiaValor."\n";

          echo "***************************\n";

         // $id_padre = $insert ;
          $jerarquiaAnterior = $this->jerarquiaValidate($jerarquia);

          echo $jerarquiaAnterior."\n";
          echo $idHeader.'- '.$jerarquia.'- '.$id_padre.'- '.$descripcion.'- '.$activo."\n";
          $id_padre = $insert ;
        }
      }


      //echo $idHeader.'- '.@$jerarquia.'- '.$id_padre.'- '.@$descripcion.'- '.$activo."\n";

        $line++;
             if ($line==15)
               die;
    }
    die;

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
