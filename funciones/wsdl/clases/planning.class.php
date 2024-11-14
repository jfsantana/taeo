<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE planning
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 *
 * 'clases/planning.class.php';
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
class planning extends conexion
{
  // Tabla Principal de Empleados
  private $tablaHeader = 'planificacion_header';
  private $tablaItems = 'planning_items';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idPlanificacion ='';
  private $idArea ='';
  private $idSede ='';
  private $idFacilitador='';
  private $idAprendiz='';
  private $periodoEvaluacion = '';
  private $observacion='';
  private $fechaCreacion = '1900-01-01';
  private $creadoPor = '';
  private $activo='';

  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getPlanningHeadere($idPlanificacion, $sede) //()
  {
    $where = " WHERE planificacion_header.idPlanificacion <> '' ";
    if ($idPlanificacion != '') {
      $where =  $where . " and planificacion_header.idPlanificacion = " . $idPlanificacion;
    }

    if ($sede != '') {
      $where =  $where . " and planificacion_header.idSede in (" . $sede . ")";
    }


    $query = "SELECT 
          planificacion_header.*,
          CASE
              WHEN planificacion_header.activo = 1 THEN 'Activo'
              ELSE 'Desactivado'
          END AS estado,
          areasobjetivos.nombreArea,
          sede.nombreSede,
          CONCAT(usuario.nombreUsuario, ', ', usuario.apellidoUsuario) AS facilitador,
          CONCAT(aprendiz.nombreAprendiz, ', ', aprendiz.apellidoAprendiz) AS aprendiz,
          CASE
              WHEN EXISTS (
                  SELECT 1
                  FROM planificacion_items pi
                  INNER JOIN planificacion_evaluacion pe ON pi.idItems = pe.idItems
                  WHERE pi.idPlanificacionHeader = planificacion_header.idPlanificacion
              ) THEN 1
              ELSE 0
          END AS evaluacion
      FROM
          planificacion_header
          INNER JOIN areasobjetivos ON areasobjetivos.idArea = planificacion_header.idArea
          INNER JOIN sede ON sede.idSede = planificacion_header.idSede
          INNER JOIN usuario ON usuario.idUsuario = planificacion_header.idFacilitador
          INNER JOIN aprendiz ON aprendiz.idAprendiz = planificacion_header.idAprendiz
      $where 
      ORDER BY aprendiz.nombreAprendiz;";

    return parent::ObtenerDatos($query);
  }

  public function getPlanningHeadereActivo($idPlanificacion, $sede) //()
  {
    $where = " WHERE planificacion_header.activo=1 ";
    if ($idPlanificacion != '') {
      $where =  $where . " and planificacion_header.idPlanificacion = " . $idPlanificacion;
    }

    if ($sede != '') {
      $where =  $where . " and planificacion_header.idSede in (" . $sede . ")";
    }


    $query = "SELECT 
          planificacion_header.*,
          CASE
              WHEN planificacion_header.activo = 1 THEN 'Activo'
              ELSE 'Desactivado'
          END AS estado,
          areasobjetivos.nombreArea,
          sede.nombreSede,
          CONCAT(usuario.nombreUsuario, ', ', usuario.apellidoUsuario) AS facilitador,
          CONCAT(aprendiz.nombreAprendiz, ', ', aprendiz.apellidoAprendiz) AS aprendiz,
          CASE
              WHEN EXISTS (
                  SELECT 1
                  FROM planificacion_items pi
                  INNER JOIN planificacion_evaluacion pe ON pi.idItems = pe.idItems
                  WHERE pi.idPlanificacionHeader = planificacion_header.idPlanificacion
              ) THEN 1
              ELSE 0
          END AS evaluacion
      FROM
          planificacion_header
          INNER JOIN areasobjetivos ON areasobjetivos.idArea = planificacion_header.idArea
          INNER JOIN sede ON sede.idSede = planificacion_header.idSede
          INNER JOIN usuario ON usuario.idUsuario = planificacion_header.idFacilitador
          INNER JOIN aprendiz ON aprendiz.idAprendiz = planificacion_header.idAprendiz
      $where 
      ORDER BY aprendiz.nombreAprendiz;";

    return parent::ObtenerDatos($query);
  }

  public function getPlanningbySede() //()
  {
    $query = " select sede.idSede, count(idPlanificacion) as total,sede.nombreSede
              from sede
              left join planificacion_header on sede.idSede =planificacion_header.idSede
              group by sede.idSede
              order by sede.nombreSede";

    return parent::ObtenerDatos($query);
  }


  public function getPlanningbySedeActiva() //()
  {
    $query = " select sede.idSede, count(idPlanificacion) as total,sede.nombreSede
              from sede
              left join planificacion_header on sede.idSede =planificacion_header.idSede
              where planificacion_header.activo=1
              group by sede.idSede
              order by sede.nombreSede";

    return parent::ObtenerDatos($query);
  }


  public function getNumPadres($idPlanificacionHeader)  {

    $where = " WHERE  idPlanificacionHeader=$idPlanificacionHeader and LENGTH(jerarquia) = 2";
    $query = "SELECT * FROM planificacion_items  $where order by idNivel, jerarquia  ";

    return parent::ObtenerDatos($query);

  }
    public function getUltimoPadre($jerarquia,$nivelObjetivo,$idAreaObjetivo)  {
    if($jerarquia==0){
      $response = [[
        'result' => '1'
      ]];
      return $response;
    }else{
      $spName = 'CheckHierarchyLevel2';
      $query = "CALL $spName('$jerarquia',$nivelObjetivo,$idAreaObjetivo)";
      return parent::ObtenerDatos($query);
    }

  }




  public function getNodosHijos($idArea, $nivelObjetivo, $nivel_nodo, $valor_padre) //()
  {

    // $query ="SELECT oi.*
    //           FROM objetivo_header as oh
    //             Inner join objetivo_item as oi  on oh.idObjetivoHeader=oi.idHeader
    //           WHERE
    //             oh.idAreaObjetivo=$idArea  and oh.nivelObjetivo=$nivelObjetivo and oh.activo=1
    //             AND CHAR_LENGTH(REPLACE(jerarquia, '.', '')) = (LENGTH(REPLACE('01.01.01.01.01', '.', '')) - (5 - $nivel_nodo) * 2)
    //             AND (jerarquia LIKE CONCAT($valor_padre, '.%') OR ($valor_padre = '0' AND jerarquia NOT LIKE '%.%'))
    //             AND (CHAR_LENGTH(REPLACE(SUBSTRING_INDEX(jerarquia, '.', $nivel_nodo), '.', '')) = $nivel_nodo * 2)

    //             order by oi.jerarquia";

    $query="SELECT oi.*
            FROM objetivo_header as oh
              Inner join objetivo_item as oi on oh.idObjetivoHeader=oi.idHeader
            WHERE
            oh.idAreaObjetivo=$idArea   and oh.nivelObjetivo=$nivelObjetivo and oh.activo=1
            and
                -- Condición para el nivel del nodo
                CHAR_LENGTH(REPLACE(jerarquia, '.', '')) = (LENGTH(REPLACE('01.01.01.01.01', '.', '')) - (5 - $nivel_nodo) * 2)
                -- Condición para el nodo padre
                AND (jerarquia LIKE CONCAT('$valor_padre', '.%') OR ('$valor_padre' = '0' AND jerarquia NOT LIKE '%.%'))
                -- Condición para obtener los nodos hijos directos
                AND (CHAR_LENGTH(REPLACE(SUBSTRING_INDEX(jerarquia, '.', $nivel_nodo), '.', '')) = $nivel_nodo * 2)

                order by jerarquia";
    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getIemsByHeader($idPlanificacionHeader, $jerarquia) //()
  {
    // $where = " WHERE t1.jerarquia <>'' ";
    // $where =  $where . " and t1.jerarquia = " . $jerarquia. " and t1.idPlanificacionHeader = " . $idPlanificacionHeader;
    // $query = "SELECT t1.jerarquia,CONCAT(REPEAT(' ', LENGTH(t1.jerarquia) - LENGTH(REPLACE(t1.jerarquia, '.', ''))), t1.descripcion) as descripcion, t1.idItems
    // FROM planificacion_items AS t1   $where     ORDER BY t1.jerarquia ";

    $query = "SELECT *
    FROM planificacion_items
    WHERE jerarquia LIKE CONCAT('$jerarquia', '.%')
      AND LENGTH(jerarquia) = LENGTH('$jerarquia') + 3
     and idPlanificacionHeader = $idPlanificacionHeader";



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

  public function post($json)  //(iniciando la creacion)
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
          (!isset($datos['activo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          // Asignacion de datos validados su existencia en el If anterior
            $this->idPlanificacion = @$datos['idObjetivoHeader'];
            $this->idArea = @$datos['idArea'];
            $this->idSede = @$datos['idSede'];
            $this->idFacilitador = @$datos['idFacilitador'];
            $this->idAprendiz = @$datos['idAprendiz'];
            $this->periodoEvaluacion = @$datos['periodoEvaluacion'];
            $this->observacion = @$datos['observacion'];
            $this->fechaCreacion = date('Y-m-d');
            $this->creadoPor =  @$datos['creadoPor'];//@$_SESSION['usuario'];
            $this->activo = @$datos['activo'];

            

          if($datos['mod']==1){//creacion del header y los items
            $resp = $this->InsertarHeader();
            $idHeader = $resp ;
          }elseif($datos['mod']==2){//uldate solo del header
            $resp = $this->UpdateHeader();
          }

          //echo $resp; die;
          if ($resp=='errorExisteRegistro'){
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR - Ya existe una Planificacion para este Aprendiz'
            ];
          }elseif ($resp) {
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

  private function updateId_padre($idHeader, $versionObjetivo){
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
          $jerarquiaPadre = $this->jerarquiaValidate($datoObjetivo['jerarquia']);
          //funcion que busca el padre de la jerarquia
          $idPadreJerarquia=$this->padreJerarquia($idHeader, $jerarquiaPadre, $versionObjetivo);

          $queryUpdate = "update objetivo_item set id_padre=$idPadreJerarquia WHERE id =".$datoObjetivo['id'];
          $update = parent::nonQuery($queryUpdate);


        }

      }
  }

  private function InsertarHeader()//()
  {

    //consulta que busca las planifiaciones de un alumna para que no se repitan:
    // valida AREA, Sede, Aprnediz y que este activio
    $validarHeader="SELECT * FROM taeho_v2.planificacion_header
    where
      idArea=$this->idArea and
      idSede=$this->idSede and
      idAprendiz= $this->idAprendiz and 
      activo = 1";
      //valida que no exitsa una 
      $validarExistencia = parent::ObtenerDatos($validarHeader);

      if($validarExistencia){
        return 'errorExisteRegistro';

      }else{

        $query = 'insert Into ' . $this->tablaHeader . "
              (
                idArea,
                idSede,
                idFacilitador,
                idAprendiz,
                periodoEvaluacion,
                observacion,
                fechaCreacion,
                creadoPor,
                activo
                  )
          value
          (
              '$this->idArea',
              '$this->idSede',
              '$this->idFacilitador',
              '$this->idAprendiz',
              '$this->periodoEvaluacion',
              '$this->observacion',
              '$this->fechaCreacion',
              '$this->creadoPor',
              '$this->activo'
              )";

          $Insertar = parent::nonQueryId($query);

          // print_r ($Insertar);die;
          if ($Insertar) {
          return $Insertar;
          } else {
          return 0;
          }
      }



  }

  private function UpdateHeader()//()
  {
     //buscar los datos de la planifiacion que se quiere actualizar
    $validarHeader="SELECT * FROM taeho_v2.planificacion_header where idPlanificacion=$this->idPlanificacion";
    $validaractual = parent::ObtenerDatos($validarHeader);
   
    $queryValidarexistencia="SELECT * FROM taeho_v2.planificacion_header
                            where idArea= ".$validaractual[0]['idArea']." and
                                  idSede= ".$validaractual[0]['idSede']." and
                                  idAprendiz= ".$validaractual[0]['idAprendiz']." and 
                                  activo = 1";
                              //valida que no exitsa una 
      $validarExistencia = parent::ObtenerDatos($queryValidarexistencia);
      
      if($validarExistencia){
        return 'errorExisteRegistro';
      }else{
        $updateFile='';
        if (isset($this->idArea)){$updateFile = $updateFile . " idArea='$this->idArea', "; }
        if (isset($this->idSede)){$updateFile = $updateFile . " idSede='$this->idSede', "; }
        if (isset($this->idFacilitador)){$updateFile = $updateFile . " idFacilitador='$this->idFacilitador', "; }
        if (isset($this->idAprendiz)){$updateFile = $updateFile . " idAprendiz='$this->idAprendiz', "; }
        if (isset($this->periodoEvaluacion)){$updateFile = $updateFile . " periodoEvaluacion='$this->periodoEvaluacion', "; }
        if (isset($this->observacion)){$updateFile = $updateFile . " observacion='$this->observacion', "; }
        if (isset($this->fechaCreacion)){$updateFile = $updateFile . " fechaCreacion='$this->fechaCreacion', "; }
        if (isset($this->creadoPor)){$updateFile = $updateFile . " creadoPor='$this->creadoPor', "; }
        if (isset($this->activo)){$updateFile = $updateFile . " activo='$this->activo' "; }
  
  
          $query = 'update ' . $this->tablaHeader . "
                                set
                                $updateFile
  
                            WHERE idPlanificacion = $this->idPlanificacion";
  
   
          $update = parent::nonQuery($query);
  
        return 1;
      }

     

  }


  
  
  public function del($json)//()
  {
    
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);
    
    $idHeader=$datos['idPlanificacion'];
    
    //Borrado de Items
    $queryDelItemPlan = "DELETE FROM planificacion_items WHERE idPlanificacionHeader = $idHeader";
   
    parent::nonQuery($queryDelItemPlan);

    $queryDelHeaderPlan = "DELETE FROM planificacion_header WHERE idPlanificacion = $idHeader";
    parent::nonQuery($queryDelHeaderPlan);

      return 1;

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
