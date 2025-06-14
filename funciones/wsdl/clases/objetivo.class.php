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
require_once '../wsdl/clases/consumoApi.class.php';
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
  private $observacionObjetivo ='';
  private $creadoPor = '';
  private $activo='';
  private $fechaCreacion = '1900-01-01';
  private $versionObjetivo='';
  private $nivelObjetivo='';
  private $idAreaObjetivo='';



  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getObjetivosHeadere($idObjetivoHeader) //()
  {
    $where = " WHERE objetivo_header.idObjetivoHeader <> '' ";
    if ($idObjetivoHeader != '') {
      $where =  $where . " and objetivo_header.idObjetivoHeader = " . $idObjetivoHeader;
    }
    $query = "select
              objetivo_header.*,
              case when objetivo_header.activo = 1 Then 'Activo' else 'Desactivado' end estado,
              areasobjetivos.nombreArea ,
              nivelareaobjetivo.nombreNivelAreaObjetivo
            from objetivo_header
            inner join areasobjetivos on areasobjetivos.idArea =objetivo_header.idAreaObjetivo
            inner join nivelareaobjetivo on nivelareaobjetivo.idNivelAreaObjetivo =objetivo_header.nivelObjetivo  $where ";
    //echo   $query; die;
    return parent::ObtenerDatos($query);
  }
   public function getObjetivosHeaderePreView($idObjetivoHeader) //()
  {
    $where = " WHERE objetivo_header.idObjetivoHeader <> '' ";
    if ($idObjetivoHeader != '') {
      $where =  $where . " and objetivo_header.idObjetivoHeader = " . $idObjetivoHeader;
    }
    $query = "select
              objetivo_header.idObjetivoHeader,
              objetivo_header.nombreObjetivo,
              objetivo_header.observacionObjetivo,
              objetivo_header.fechaCreacion,
              objetivo_header.creadoPor,
              objetivo_header.activo,
              objetivo_header.nivelObjetivo,
              objetivo_header.idAreaObjetivo,
              case when objetivo_header.activo = 1 Then 'Activo' else 'Desactivado' end estado,
              areasobjetivos.nombreArea ,
              nivelareaobjetivo.nombreNivelAreaObjetivo
            from objetivo_header
            inner join areasobjetivos on areasobjetivos.idArea =objetivo_header.idAreaObjetivo
            inner join nivelareaobjetivo on nivelareaobjetivo.idNivelAreaObjetivo =objetivo_header.nivelObjetivo  $where ";
    //echo   $query; die;
    return parent::ObtenerDatos($query);
  }



  public function getIdObjetivo($idArea, $idNivel) //()
  {
    $where = " WHERE activo = 1 ";

      $where =  $where . " and idAreaObjetivo = " . $idArea . " and nivelObjetivo =".$idNivel;

    $query = "SELECT idObjetivoHeader FROM objetivo_header $where";
    echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getIemsByHeader($idRepresentante) //()
  {
    $where = " WHERE t1.activo = 1 ";
    if ($idRepresentante != '') {
      $where =  $where . " and t1.id_padre = " . $idRepresentante;
    }
    //13336768 SE MODIFICO LA CONSULKTA PARA QUE SOLO TRAIGA EL REGUISTRO DE LA ULTIMA VERSION.
    //PERO NO ESTOY SEGURO QUE ESTE SEA EL SERVICIO SI NO ES ESTE ES:
    /*getIemsByPadre*/


    // $query = "SELECT t1.jerarquia,CONCAT(REPEAT(' ', LENGTH(t1.jerarquia) - LENGTH(REPLACE(t1.jerarquia, '.', ''))), t1.descripcion) as descripcion, t1.id_padre, t1.id
    // FROM objetivo_item AS t1    $where  ORDER BY t1.jerarquia, t1.id_padre ";

    $query="WITH MaxVersion AS (
              SELECT
                  id_padre,
                  MAX(versionObjetivo) AS maxVersion
              FROM
                  objetivo_item
              GROUP BY
                  id_padre
          )
          SELECT
              t1.jerarquia,
              CONCAT(REPEAT(' ',
                          LENGTH(t1.jerarquia) - LENGTH(REPLACE(t1.jerarquia, '.', ''))),
                      t1.descripcion) AS descripcion,
              t1.id_padre,
              t1.id
          FROM
              objetivo_item AS t1
          INNER JOIN
              MaxVersion AS mv
          ON
              t1.id_padre = mv.id_padre
              AND t1.versionObjetivo = mv.maxVersion
          $where  ORDER BY t1.jerarquia, t1.id_padre
          ";
   // echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getVersionByHeader($idRepresentante) //()
  {
    $where = " where  idHeader = " . $idRepresentante;
    $query = "SELECT distinct versionObjetivo FROM objetivo_item
      $where order by 1 desc";
    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getLastVersionByHeader($idRepresentante) //()
  {
    $where = " where  idHeader = " . $idRepresentante;
    $query = "SELECT max(versionObjetivo) as maximo FROM objetivo_item
      $where order by 1 desc";
    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getidPadreByHeader($idHeader,$maxVersion) //()
  {
    $where = " WHERE activo = 1 and objetivo_item.id_padre is null";
    if ($idHeader != '') {
      $where =  $where . " and objetivo_item.idHeader  = " . $idHeader . " and versionObjetivo= $maxVersion ";
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


  public function del($json)  //()
  {
   
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);
    
    $idObjetivoHeader=$datos['idObjetivoHeader'];
    
    //Borrado de Items
    $queryDelItemObjetivo = "DELETE FROM objetivo_item WHERE idHeader = $idObjetivoHeader";
   
    parent::nonQuery($queryDelItemObjetivo);

    $queryDelHeaderObjetivo = "DELETE FROM objetivo_header WHERE idObjetivoHeader = $idObjetivoHeader";
    parent::nonQuery($queryDelHeaderObjetivo);

      return 1;

  }

  public function post($json)  //()
  {

    $_respuestas = new respuestas();
    $datos = json_decode($json, true);
    //print_r($datos); die;
    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        // valida los campos obligatorios
        if (
          (strlen($datos['nombreObjetivo'])<>'')&&
          (!isset($datos['observacionObjetivo'])) &&
          (!isset($datos['activo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior
            $this->idObjetivoHeader = @$datos['idObjetivoHeader'];
            $this->nombreObjetivo = @$datos['nombreObjetivo'];
            $this->observacionObjetivo = @$datos['observacionObjetivo'];
            $this->fechaCreacion = date('Y-m-d');
            $this->creadoPor =  @$datos['creadoPor'];//@$_SESSION['usuario'];
            $this->activo = @$datos['activo'];
            $this->nivelObjetivo = @$datos['nivelObjetivo'];

            $this->idAreaObjetivo = @$datos['idAreaObjetivo'];


          if($datos['mod']==1){//creacion del header y los items
            $resp = $this->InsertarHeader();
            $idHeader = $resp ;
            if($resp){
              $this->versionObjetivo=1;

              $respItem = $this->uploadXls($idHeader, $datos['file'],1);
            }
          }elseif($datos['mod']==2){//uldate solo del header
            $resp = $this->UpdateHeader();
          }elseif($datos['mod']==3){ //actualizacion del borrado de los itms
            $this->versionObjetivo=@$datos['versionActual'];

            $token='';
            $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/objetivoItem?idHeader=$this->idObjetivoHeader&versionObjetivo=$this->versionObjetivo";
            $rs         = API::DELETE($URL, $token);
            $delItemByHeader  = API::JSON_TO_ARRAY($rs);

            $resp1 = $this->UpdateHeader();

            $resp = $this->uploadXls( $this->idObjetivoHeader, $datos['file'],$this->versionObjetivo);

          }elseif($datos['mod']==4){//uldate solo del header

            $this->versionObjetivo=@$datos['versionActual'];
            $anteriorVersionObjetivo = $this->versionObjetivo-1;

            $where =  " where idHeader =".$this->idObjetivoHeader." and versionObjetivo  = " . $anteriorVersionObjetivo ;
            $query = "update objetivo_item  set activo='0' $where ";
            $update =  parent::nonQuery($query);


            //tiene que actualizar el header
            $resp = $this->UpdateHeader();
            $resp = $this->uploadXls( $this->idObjetivoHeader, $datos['file'],$this->versionObjetivo);

          }
          //echo $resp; die;

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

    if (strlen($jerarquia)==0)
      return $jerarquia;
    else{

      $string = $jerarquia;
      $lastDotPosition = strrpos($string, '.');
      $newString = substr($string, 0, $lastDotPosition);

      return $newString;
    }
  }

  private function insertItems($idHeader, $jerarquia, $id_padre, $descripcion,$activo,$versionObjetivo){
          $query = "insert Into objetivo_item
          (
            idHeader,
            jerarquia,
            id_padre,
            descripcion,
            activo,
            versionObjetivo
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
        '$activo',
        '$versionObjetivo'
        )";


       // echo $query; die;
      $Insertar = parent::nonQueryId($query);

       //print_r ($Insertar);die;
      if ($Insertar) {
      return $Insertar;
      } else {
      return null;
      }
  }

  public function uploadXls($idHeader, $file, $versionObjetivo)
  {
    //valores para el insert
    $activo =1;
    $jerarquiaAnterior='';
    $id_padre=null;
    $jerarquia='';
    $descripcion='';

    $spreadsheet = new Spreadsheet();

    $inputFileType = 'Xlsx';
    $inputFileName = $file['archivo']['tmp_name'];//'C:\wamp64\tmp\FarmatoCargaObjetivos.xlsx';

    $spreadsheet = IOFactory::load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();

    $highestRow = $sheet->getHighestRow();  //calcula el numero maximo de filas
    $highestColumn = $sheet->getHighestColumn();  //calcula el numero maximo de columnas

    $line=0;
    for ($row = 2; $row <= $highestRow; $row++) { //recorre las filas

      $jerarquia = $sheet->getCell('A' . $row)->getValue();
      $descripcion = $sheet->getCell('B' . $row)->getValue();

      $insert = $this->insertItems($idHeader, $jerarquia, null, $descripcion,$activo, $versionObjetivo);

        $line++;


    }

    $eval=$this->updateId_padre($idHeader, $versionObjetivo);

    return 'success';
  }

  private function padreJerarquia($idHeader, $jerarquia, $versionObjetivo){


    $query = "SELECT * FROM objetivo_item WHERE idHeader = $idHeader and jerarquia='$jerarquia' and versionObjetivo='$versionObjetivo'";
    $result = parent::ObtenerDatos($query);
    return $result[0]['id'];
  }

  public function updateId_padre($idHeader, $versionObjetivo){


      $jerarquiaPadre='';
      //query del objetivo
      $queryObjetivo = "SELECT * FROM objetivo_item WHERE activo = 1 and idHeader = $idHeader AND versionObjetivo= $versionObjetivo order by id";
      $arrayObjetivo = parent::ObtenerDatos($queryObjetivo);


      //echo $queryObjetivo; die;
      //recorrer el objetivo
      foreach($arrayObjetivo as $datoObjetivo){
        //validar si tiene una sola posicion la jerarquia no se hace nada
        if(strlen($datoObjetivo['jerarquia'])==2){

        }else{
          //print("<pre> Objetivo:".print_r(($datoObjetivo),true)."</pre>");die;

          //valida la jerarquia
          $jerarquiaPadre = $this->jerarquiaValidate($datoObjetivo['jerarquia']);
          //print("<pre> jerarquiaPadre:".print_r(($jerarquiaPadre),true)."</pre>");
          //funcion que busca el padre de la jerarquia
          $idPadreJerarquia=$this->padreJerarquia($idHeader, $jerarquiaPadre, $versionObjetivo);
          //print("<pre> idPadreJerarquia:".print_r(($idPadreJerarquia),true)."</pre>");
          $queryUpdate = "update objetivo_item set id_padre=$idPadreJerarquia WHERE id =".$datoObjetivo['id'];

          //echo $queryUpdate ; die;
          $update = parent::nonQuery($queryUpdate);


        }

      }
  }

  private function InsertarHeader()//()
  {
    $query = 'insert Into ' . $this->tablaHeader . "
              (
                nombreObjetivo,
                observacionObjetivo,
                activo,
                fechaCreacion,
                creadoPor,
                nivelObjetivo,
                idAreaObjetivo
                  )
          value
          (
              '$this->nombreObjetivo',
              '$this->observacionObjetivo',
              '$this->activo',
              '$this->fechaCreacion',
              '$this->creadoPor',
              '$this->nivelObjetivo',
              '$this->idAreaObjetivo'
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
                          observacionObjetivo='$this->observacionObjetivo',
                          activo='$this->activo',
                          fechaCreacion='$this->fechaCreacion',
                          creadoPor='$this->creadoPor',
                          nivelObjetivo='$this->nivelObjetivo',
                          idAreaObjetivo='$this->idAreaObjetivo'
                      WHERE idObjetivoHeader = $this->idObjetivoHeader";

                     // echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }
  public function put($json)//()
  {
    //echo  $json; die;
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    $datos['versionObjetivo'];
    $query = 'update ' . $this->tablaItems . "
                          set
                          activo='0'
                      WHERE idHeader =". $datos['idObjetivoHeader']."
                      And versionObjetivo=".$datos['versionObjetivo'];

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
