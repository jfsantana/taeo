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
class preEvaluacion extends conexion
{
  // Tabla Principal de Empleados
  private $tablaHeader = 'evaluacion_header';
  private $tablaItems = 'evaluacion_item';
  private $tablaDetalle = 'evaluacion_detalle';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534

  private $idHeaderEvaluacion='';
  private $idAprendiz='';
  private $idSede='';
  private $idEvaluadoPor='';
  private $fechaUltimaEvaluacion = '1900-01-01';
  private $fechaEvaluacion = '1900-01-01';
  private $conclucionesRecomendaciones='';
  private $idHeaderEvaluacionAnterior='';
  private $activo='';
  private $observacion='';
  private $creadoPor = '';  

  //Tabla Items
  private $edadCronologica='';
  private $idNivelEvaluacion='';
  private $idAreaEvaluacion='';

  //tagbla detalles
  private $idItemEvaluacion='';
  private $detalleEvalaacion='';
  private $evaluacion_detalle='';


  public function getHeader($idHeaderEvaluacion,$idSedesString) //( 01112024 )
  {

    $where = " WHERE eh.idHeaderEvaluacion <> ''  ";

    //valida que el idHeaderEvaluacion no este vacio para la lista principal de las evaliaciones
    if($idSedesString){
      $idSedes='';
      $queryidSede="SELECT * FROM taeho_v2.usuario_sede where idusuario_sede in ($idSedesString)";
      $idSedesArray = parent::ObtenerDatos($queryidSede);
      foreach($idSedesArray as $sede){
        $idSedes = $idSedes.$sede['idSede'].',';
      }
      $idSedes = substr($idSedes, 0, -1);
    }

    //verifica que no esta buscando una evaluacion especifica
    if ($idHeaderEvaluacion != '') {
      $where =  $where . " and eh.idHeaderEvaluacion = " . $idHeaderEvaluacion;
    }else{
      $where =  $where . " and eh.idSede in ($idSedes) ";
    }
    $query = "SELECT 
                  idHeaderEvaluacion,
                  fechaUltimaEvaluacion,
                  fechaEvaluacion,
                  conclucionesRecomendaciones,
                  idHeaderEvaluacionAnterior,
                  eh.idAprendiz,
                  nombreAprendiz,
                  apellidoAprendiz,
                  cedulaAprendiz,
                  fechaNacimientoAprendiz,
                  colegioAprendiz,
                  gradoAprendiz,
                  escolaridadAprendiz,
                  direccionAprendiz,
                  paisAprendiz,
                  ciudadAprendiz,
                  alergiaAprendiz,
                  idEvaluadoPor,
                  nombreUsuario,
                  apellidoUsuario,
                  emailUsuario,
                  eh.idSede,
                  s.nombreSede,
                  eh.activo,
                  eh.observacion,
                  eh.creadoPor
              FROM
                  evaluacion_header AS eh
                      INNER JOIN
                  aprendiz AS a ON eh.idAprendiz = a.idAprendiz
                      INNER JOIN
                  usuario AS u ON eh.idEvaluadoPor = u.idUsuario
                      INNER JOIN
                  sede AS s ON s.idSede = eh.idSede
              $where    
              ORDER BY 1 DESC";
    
    return parent::ObtenerDatos($query);
  }
  

  public function getPreEvaluacioensByAprendiz($idAprendiz) //( 01112024 )
  {
    $where = " WHERE eh.idAprendiz <> '' ";
    if ($idAprendiz != '') {
      $where =  $where . " and eh.idAprendiz = " . $idAprendiz;
    }
    $query = "SELECT 
                  eh.*,
                  a.nombreAprendiz,
                  a.apellidoAprendiz,
                  a.fechaNacimientoAprendiz,
                  concat(u.nombreUsuario,', ', u.apellidousuario) as evaluadorPor
              FROM
                   taeho_v2.evaluacion_header as eh
                    inner join aprendiz as a on eh.idAprendiz= a.idAprendiz
                    inner join	usuario as u on eh.idEvaluadoPor=u.idUsuario
              $where
              ORDER BY eh.fechaEvaluacion DESC";
      //echo   $query; die;
    return parent::ObtenerDatos($query);
  }

  
  public function getEvaluacionPrevia($idHeaderEvaluacion) //(01112024)
  {
    $where = " WHERE activo = 1 ";
    if ($idHeaderEvaluacion != '') {
      $where =  $where . " and idHeaderEvaluacion = " . $idHeaderEvaluacion;
    }
    $query = "SELECT
              idHeaderEvaluacionAnterior
              FROM
              evaluacion_header
              $where
               ";
    $idEvaAnterior =  parent::ObtenerDatos($query);
    
    if($idEvaAnterior[0]['idHeaderEvaluacionAnterior']){
      return $this->getResumenEva($idEvaAnterior[0]['idHeaderEvaluacionAnterior']);
    }else{
      return array();
    }

    
    
  }
  
  
  public function getEvaluadoresData($idHeaderEvaluacion) //(01112024)
  {
    $where = " WHERE u.activoUsuario = 1 ";
    if ($idHeaderEvaluacion != '') {
      $where =  $where . " and eh.idHeaderEvaluacion = " . $idHeaderEvaluacion;
    }
    $query = "SELECT
              u.*,
              c.descripcionCargo
              FROM
              evaluacion_header as eh
              JOIN
              usuario as u
              ON
              FIND_IN_SET(u.idUsuario, eh.idEvaluadoPor) > 0

              inner join cargo as c 
              on u.cargousuario = c.idcargos
              $where
               order by u.apellidoUsuario, u.nombreUsuario";
    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  
  
  public function getResumenEva($idDetalleEvaluacion) //(01112024)
  {
    $where = " WHERE idDetalleEvaluacion is not null ";
    if ($idDetalleEvaluacion != '') {
      $where =  $where . " and idHeaderEvaluacion = " . $idDetalleEvaluacion;
    }
    $query = "SELECT 
                ei.idHeaderEvaluacion,
                ei.edadCronologica,
                ei.idNivelEvaluacion,
                en.nombreNivelEvaluacion,
                ei.idAreaEvaluacion,
                ea.nombreAreaEvaluacion,
                ed.idDetalleEvaluacion,
                ed.idItemEvaluacion,
                ed.detalleEvalaacion,
                ed.evaluacion_detalle
            FROM
                taeho_v2.evaluacion_detalle AS ed
                    INNER JOIN
                evaluacion_item AS ei ON ed.idItemEvaluacion = ei.idItemEvaluacion
                    INNER JOIN
                evaluacion_niveles AS en ON ei.idNivelEvaluacion = en.idNivelesEvaluacion
                    INNER JOIN
                evaluacion_area AS ea ON ei.idAreaEvaluacion = ea.idAreaEvaluacion
              $where
               order by ei.idNivelEvaluacion, ea.nombreAreaEvaluacion";
    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getNivelesAll() //(01112024)
  {
    
    $query = "SELECT * FROM taeho_v2.evaluacion_niveles order by idNivelesEvaluacion";

    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getItemsAll() //(01112024)
  {
    
    $query = "SELECT * FROM taeho_v2.evaluacion_area order by nombreAreaEvaluacion";

    //echo $query; die;
    return parent::ObtenerDatos($query);
  }
  public function getItemsByHeader($idHeaderEvaluacion) //(01112024)
  {
    $where = " WHERE ei.idHeaderEvaluacion is NOT NULL ";
    if ($idHeaderEvaluacion != '') {
      $where =  $where . " and ei.idHeaderEvaluacion  = " . $idHeaderEvaluacion ;
    }
    $query = "SELECT 
                  ei.idItemEvaluacion,
                  ei.idHeaderEvaluacion,
                  ei.edadCronologica,
                  ei.idNivelEvaluacion,
                  en.nombreNivelEvaluacion,
                  ei.idAreaEvaluacion,
                  ea.nombreAreaEvaluacion
              FROM
                  evaluacion_item AS ei
                      INNER JOIN
                  evaluacion_niveles AS en ON ei.idNivelEvaluacion = en.idNivelesEvaluacion
                      INNER JOIN
                  evaluacion_area AS ea ON ei.idAreaEvaluacion = ea.idAreaEvaluacion
                $where
              ORDER BY ei.idAreaEvaluacion     ";

    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getDetalleByIems($idItemEvaluacion) //(01112024)
  {
    $where = " WHERE idDetalleEvaluacion is not null ";
    if ($idItemEvaluacion != '') {
      $where =  $where . " and idItemEvaluacion = " . $idItemEvaluacion;
    }
    $query = "SELECT 
                  *
              FROM
                  taeho_v2.evaluacion_detalle
              $where
              ORDER BY 2 , 3";
   // echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getIdObjetivo($idArea, $idNivel) //()
  {
    $where = " WHERE activo = 1 ";

      $where =  $where . " and idAreaObjetivo = " . $idArea . " and nivelObjetivo =".$idNivel;

    $query = "SELECT idObjetivoHeader FROM objetivo_header $where";
    //echo $query; die;
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

  
  public function getGrafEvaAnt($idHeaderEvaluacion) //(01112024)
  {
    $responseCode= array();

    $queryIdEvaAnt="SELECT eh.idHeaderEvaluacionAnterior
                      FROM
                          evaluacion_header AS eh
                              INNER JOIN
                          evaluacion_item AS ei ON eh.idHeaderEvaluacion = ei.idHeaderEvaluacion
                      WHERE
                          eh.idHeaderEvaluacion = $idHeaderEvaluacion
                      ORDER BY ei.edadCronologica";

    $idEvaAnt= parent::ObtenerDatos($queryIdEvaAnt);
    
    //AQUI UBICA LA EVALUACIUON ANTERIOR
    if (count($idEvaAnt) === 1) {
      // si existe una evaluacion anterior 
      $idHeaderEvaluacionAnterior = $idEvaAnt[0]['idHeaderEvaluacionAnterior'];

      $responseCode[] = array(
        'EvaAnt' => array(
            'idHeaderEvaluacionAnterior' => $idHeaderEvaluacionAnterior
        )
      );

      $queryEdadCronologicasRegistradas="SELECT DISTINCT
                                            ei.edadCronologica
                                        FROM
                                            evaluacion_header AS eh
                                                INNER JOIN
                                            evaluacion_item AS ei ON eh.idHeaderEvaluacion = ei.idHeaderEvaluacion
                                        WHERE
                                            eh.idHeaderEvaluacion = $idHeaderEvaluacionAnterior
                                        ORDER BY ei.edadCronologica";
      //busco las edades aplicadas para esa evaluacion anterior
      $edadCronologicasRegistrada= parent::ObtenerDatos($queryEdadCronologicasRegistradas);


        //por cada edad busco los niveles
      foreach ($edadCronologicasRegistrada as $edad){
        $edadCronologica=$edad['edadCronologica'];
        

        
        $queryNivelesByEdad="SELECT DISTINCT
                                ei.idAreaEvaluacion, ea.descripcionAreaEvaluacion
                            FROM
                                evaluacion_header AS eh
                                    INNER JOIN
                                evaluacion_item AS ei ON eh.idHeaderEvaluacion = ei.idHeaderEvaluacion
                                    INNER JOIN
                                evaluacion_area AS ea ON ei.idAreaEvaluacion = ea.idAreaEvaluacion
                            WHERE
                                eh.idHeaderEvaluacion = $idHeaderEvaluacionAnterior
                                 and ei.edadCronologica = $edadCronologica
                            ORDER BY ea.idAreaEvaluacion";

        $arrayNivelesByEdad= parent::ObtenerDatos($queryNivelesByEdad);

        //por cada nivel totalizo la cantidad de evaluaciones , la cantdad de SA y las que son AP,NA
        foreach($arrayNivelesByEdad as $niveles){
          
           $nivelid=$niveles['idAreaEvaluacion'];
           $niveldestalle=$niveles['descripcionAreaEvaluacion'];
          // $edadCronologica
          //   $niveles
          //     $totales

          $queryResultados="SELECT 
                              ed.*
                            FROM
                                evaluacion_header AS eh
                                    INNER JOIN
                                evaluacion_item AS ei ON eh.idHeaderEvaluacion = ei.idHeaderEvaluacion
                                    INNER JOIN
                                evaluacion_area AS ea ON ei.idAreaEvaluacion = ea.idAreaEvaluacion
                                INNER JOIN 
                                evaluacion_detalle AS ed ON ei.idItemEvaluacion = ed.idItemEvaluacion
                            WHERE
                                eh.idHeaderEvaluacion = $idHeaderEvaluacionAnterior
                                 and ei.edadCronologica = $edadCronologica
                                and ei.idAreaEvaluacion = $nivelid"     ;
echo $queryResultados; die;
          $Resultados= parent::ObtenerDatos($queryNivelesByEdad);

          $responseCode[] = array(
            'EvaAnt' => array(
                'idHeaderEvaluacionAnterior' => $idHeaderEvaluacionAnterior,
                'resultados' => array(
                    'edadCronologica' => $edadCronologica,
                    'resultados' => $Resultados
                )
            )
        );

        }
        
      }
      



      echo json_encode($responseCode, JSON_PRETTY_PRINT); die;        
      

    } else {
        throw new Exception('Se esperaba un único resultado, pero se encontraron ' . count($idEvaAnt));
    }


    
    return parent::ObtenerDatos($idEvaAnt);
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
    
    $flag=false;
    
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);
    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {

        if (
          (!isset($datos['fechaCreacion'])) 
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idHeaderEvaluacion             = @$datos['idHeaderEvaluacion'];
          $this->idAprendiz                     = @$datos['idAprendiz'];
          $this->idSede                         = @$datos['idSede'];        
          $this->fechaUltimaEvaluacion          = @$datos['fechaUltimaEvaluacion'];
          $this->fechaEvaluacion                = @$datos['fechaCreacion'];
          $this->conclucionesRecomendaciones    = @$datos['conclucionesRecomendaciones'];
          $this->idHeaderEvaluacionAnterior     = @$datos['idHeaderEvaluacionAnterior'];
          $this->activo                         = @$datos['activo'];
          $this->observacion                    = @$datos['observacion'];
          $this->creadoPor                      = @$datos['creadoPor'];


          //print("<pre>".print_r(($datos),true)."</pre>");die;
          $this->idEvaluadoPor = isset($datos['idEvaluadoPor']) ? implode(',', $datos['idEvaluadoPor']) : '';

          if($datos['mod']==1){//creacion del header y los items
            $resp = $this->InsertarHeader();
            $flag=true;

          }elseif($datos['mod']==2){
            $resp=$this->idHeaderEvaluacion;
            $updateHeaderResult = $this->UpdateHeader();
            if(@$datos['detalleEvalaacion']!=''){
              $this->edadCronologica                     = @$datos['edadCronologica'];
              $this->idNivelEvaluacion                   = @$datos['idNivelEvaluacion'];
              $this->idAreaEvaluacion                    = @$datos['idAreaEvaluacion'];
  
              $idItmes = $this->updateItems();
                if($idItmes){
                  $this->idItemEvaluacion                     = @$idItmes;
                  $this->detalleEvalaacion                   = @$datos['detalleEvalaacion'];
                  $this->evaluacion_detalle                    = @$datos['evaluacion_detalle'];
              
                $insertDetail = $this->insertDetail();
                $flag=true;
              }

            }else{
              if($updateHeaderResult){
                $flag=true;
              }
            }

          }

          //echo $resp; die;

          if ($flag) {
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
  private function updateItems()//()
  {
    /*cuando es mod=2 en la tabla items debo validar que no existe el siguiente 
    idHeaderEvaluacion - edadCronologica - idNivelEvaluacion - idAreaEvaluacion,*/
    $flag=true;
    $queryValidateString = "SELECT * 
              FROM $this->tablaItems 
              WHERE 
                idHeaderEvaluacion = $this->idHeaderEvaluacion and 
                edadCronologica = $this->edadCronologica and 
                idNivelEvaluacion = $this->idNivelEvaluacion and 
                idAreaEvaluacion = $this->idAreaEvaluacion";
    $queryValidate = parent::nonQuery($queryValidateString);

    if($queryValidate==0){
      $query = 'insert Into ' . $this->tablaItems . "
              ( `idHeaderEvaluacion`,
                `edadCronologica`,
                `idNivelEvaluacion`,
                `idAreaEvaluacion`)
          value
          (
              '$this->idHeaderEvaluacion',
              '$this->edadCronologica',
              '$this->idNivelEvaluacion',
              '$this->idAreaEvaluacion'
              )";
        $Insertar = parent::nonQueryId($query);
    }else{
      $flag=false;
      $queryIdItmes = parent::ObtenerDatos($queryValidateString);
    }
    
      if ($flag) {
        return $Insertar; // retorna el id del item creado 
      } else {
        return $queryIdItmes[0]['idItemEvaluacion']; //retorna el id Encontado
      }


    //$this->idHeaderEvaluacion , $this->conclucionesRecomendaciones , $this->activo, $this->observacion 
     $query = 'update ' . $this->tablaHeader . "
                           set
                           conclucionesRecomendaciones='$this->conclucionesRecomendaciones',
                           activo='$this->activo',
                           observacion='$this->observacion'
                       WHERE idHeaderEvaluacion = $this->idHeaderEvaluacion";
    // echo  $query; die;
    $update = parent::nonQuery($query);

     if ($update >= 1) {
       return $update;
     } else {
       return 0;
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

  private function insertItems($idHeader, $jerarquia, $id_padre, $descripcion,$activo,$versionObjetivo)
  {
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


  private function padreJerarquia($idHeader, $jerarquia, $versionObjetivo)
  {


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
  
  private function insertDetail()//()
  {
    $query = 'insert Into ' . $this->tablaDetalle . "
              ( `idItemEvaluacion`,
                `detalleEvalaacion`,
                `evaluacion_detalle`)
          value
          (
              '$this->idItemEvaluacion',
              '$this->detalleEvalaacion',
              '$this->evaluacion_detalle'
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

  private function InsertarHeader()//()
  {
    $query = 'insert Into ' . $this->tablaHeader . "
              ( `idAprendiz`,
                `idSede`,
                `idEvaluadoPor`,
                `fechaUltimaEvaluacion`,
                `fechaEvaluacion`,
                `conclucionesRecomendaciones`,
                `idHeaderEvaluacionAnterior`,
                `activo`,
                `observacion`,
                `creadoPor`)
          value
          (
              '$this->idAprendiz',
              '$this->idSede',
              '$this->idEvaluadoPor',
              '$this->fechaUltimaEvaluacion',
              '$this->fechaEvaluacion',
              '$this->conclucionesRecomendaciones',
              '$this->idHeaderEvaluacionAnterior',
              '$this->activo',
              '$this->observacion',
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
    //$this->idHeaderEvaluacion , $this->conclucionesRecomendaciones , $this->activo, $this->observacion 
     $query = 'update ' . $this->tablaHeader . "
                           set
                           conclucionesRecomendaciones='$this->conclucionesRecomendaciones',
                           activo='$this->activo',
                           observacion='$this->observacion'
                       WHERE idHeaderEvaluacion = $this->idHeaderEvaluacion";
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
    
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);


    // actualizar la tabla evaluacion_item
    $queryEvaluacion_item = "
          Update taeho_v2.evaluacion_item
          set edadCronologica = ".@$datos['edadCronologica'].",
          idNivelEvaluacion=".@$datos['idNivelEvaluacion'].",
          idAreaEvaluacion=".@$datos['idAreaEvaluacion']."
          where 
            idItemEvaluacion=(
                                select idItemEvaluacion 
                                from evaluacion_detalle 
                                where idDetalleEvaluacion=".@$datos['idDetalleEvaluacion']." )
                            ";
    //echo $queryEvaluacion_item; die;                        
    $update = parent::nonQuery($queryEvaluacion_item);

      // actualizar la tabla evaluacion_detalle
      $queryEvaluacion_detalle = "
      UPDATE evaluacion_detalle
       SET
       detalleEvalaacion = '".@$datos['detalleEvalaacion']."',
       evaluacion_detalle = '".@$datos['evaluacion_detalle']."'
       WHERE idDetalleEvaluacion=".@$datos['idDetalleEvaluacion'];

                         
    $update = parent::nonQuery($queryEvaluacion_detalle);

    return 1;
  }


  public function delete($json)//()
  {
   // echo $json; die;
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

      // actualizar la tabla evaluacion_detalle
      $queryEvaluacion_detalle = "
      DELETE FROM  evaluacion_detalle
       WHERE idDetalleEvaluacion=".@$datos['idDetalleEvaluacion'];
      //echo $queryEvaluacion_detalle; die;             
    $update = parent::nonQuery($queryEvaluacion_detalle);

    return 1;
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
