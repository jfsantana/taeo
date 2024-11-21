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
class evaluacion extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'planificacion_evaluacion';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idItems ='';
  private $idPlanificacionHeader ='';
  private $idEvaluacion=0;
  private $fechaEvaluacion ='';
  private $tipo='';
  private $idValorEvaluacion='';
  private $observacionEvaluacion = '';
  private $creadoPor='';
  private $evaluadoPor='';
  private $fechaCreacion = '1900-01-01';
  private $activo='';
  private $aprobadoPor='';

  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getPlanningHeadere($idPlanificacion, $idsede, $idFacilitador) //(LISTO PARA EVALUACIONES)
  {
    $where = " WHERE planificacion_header.idPlanificacion <> '' ";
    if ($idPlanificacion != '') {
      $where =  $where . " and planificacion_header.idPlanificacion = " . $idPlanificacion;
    }

    if ($idsede != '') {
      $where =  $where . " and planificacion_header.idSede in (" . $idsede.")";
    }

    if ($idFacilitador != '') {
      $where =  $where . " and planificacion_header.idFacilitador =" . $idFacilitador;
    }
    $query = "select
            planificacion_header.*
            ,case when planificacion_header.activo = 1 Then 'Activo' else 'Desactivado' end estado
            ,areasobjetivos.nombreArea
            ,sede.nombreSede
              ,concat(usuario.nombreUsuario,', ',usuario.apellidoUsuario) as facilitador
              ,concat(aprendiz.nombreAprendiz,', ',aprendiz.apellidoAprendiz) as aprendiz
          from planificacion_header
            inner join areasobjetivos on areasobjetivos.idArea =planificacion_header.idArea
            inner join sede on sede.idSede =planificacion_header.idSede
              inner join usuario on usuario.idUsuario =planificacion_header.idFacilitador
              inner join aprendiz on aprendiz.idAprendiz =planificacion_header.idAprendiz 
               $where
              order by aprendiz.nombreAprendiz";

    return parent::ObtenerDatos($query);
  }

  
  public function getPlanningHeadereActivoByidAprendiz($idAprendiz) //(LISTO PARA EVALUACIONES)
  {
    $where = " WHERE planificacion_header.activo = 1 ";
    if ($idAprendiz != '') {
      $where =  $where . " and planificacion_header.idAprendiz = " . $idAprendiz;
    }

    $query = "select
            planificacion_header.*
            ,case when planificacion_header.activo = 1 Then 'Activo' else 'Desactivado' end estado
            ,areasobjetivos.nombreArea
            ,sede.nombreSede
              ,concat(usuario.nombreUsuario,', ',usuario.apellidoUsuario) as facilitador
              ,concat(aprendiz.nombreAprendiz,', ',aprendiz.apellidoAprendiz) as aprendiz
          from planificacion_header
            inner join areasobjetivos on areasobjetivos.idArea =planificacion_header.idArea
            inner join sede on sede.idSede =planificacion_header.idSede
              inner join usuario on usuario.idUsuario =planificacion_header.idFacilitador
              inner join aprendiz on aprendiz.idAprendiz =planificacion_header.idAprendiz 
               $where
              order by aprendiz.nombreAprendiz";

    return parent::ObtenerDatos($query);
  }

  public function getPlanningHeadereActivo($idPlanificacion, $idsede, $idFacilitador) //(LISTO PARA EVALUACIONES)
  {
    $where = " WHERE planificacion_header.activo = 1 ";
    if ($idPlanificacion != '') {
      $where =  $where . " and planificacion_header.idPlanificacion = " . $idPlanificacion;
    }

    if ($idsede != '') {
      $where =  $where . " and planificacion_header.idSede in (" . $idsede.")";
    }

    if ($idFacilitador != '') {
      $where =  $where . " and planificacion_header.idFacilitador =" . $idFacilitador;
    }
    $query = "select
            planificacion_header.*
            ,case when planificacion_header.activo = 1 Then 'Activo' else 'Desactivado' end estado
            ,areasobjetivos.nombreArea
            ,sede.nombreSede
              ,concat(usuario.nombreUsuario,', ',usuario.apellidoUsuario) as facilitador
              ,concat(aprendiz.nombreAprendiz,', ',aprendiz.apellidoAprendiz) as aprendiz
          from planificacion_header
            inner join areasobjetivos on areasobjetivos.idArea =planificacion_header.idArea
            inner join sede on sede.idSede =planificacion_header.idSede
              inner join usuario on usuario.idUsuario =planificacion_header.idFacilitador
              inner join aprendiz on aprendiz.idAprendiz =planificacion_header.idAprendiz 
               $where
              order by aprendiz.nombreAprendiz";

    return parent::ObtenerDatos($query);
  }

  public function getValueEval() //(LISTO PARA EVALUACIONES)
  {
    $query = "SELECT * FROM planificacion_valorevaluaciones order by ponderacion";
    return parent::ObtenerDatos($query);
  }

  

  public function getEvaInicialByItems($idItem) //(LISTO PARA EVALUACIONES)
  {
    $query = "SELECT * FROM planificacion_evaluacion where idItems=$idItem and tipo='Inicial'";
    $result = parent::ObtenerDatos($query); 
    if (empty($result)) {
        return 0;
    }
    return $result;
  } 

  
  public function getEvalByItems($idItems) //(LISTO PARA EVALUACIONES)
  {
    $query = "SELECT * FROM planificacion_evaluacion where idItems=$idItems order by idEvaluacion";
    return parent::ObtenerDatos($query);
  } 

  public function getEvalById($idEvaluacion) //(LISTO PARA EVALUACIONES)
  {
    $query = "SELECT * FROM planificacion_evaluacion where idEvaluacion=$idEvaluacion ";
    return parent::ObtenerDatos($query);
  } 

  public function getActividadById($idItems) //(LISTO PARA EVALUACIONES)
  {
      if($idItems==0){
        $response = [[
          'result' => '1'
        ]];
        return $response;
      }else{
        $spName = 'ObtenerJerarquiasSuperiores';
        $query = "CALL $spName('$idItems')";
        return parent::ObtenerDatos($query);
      }


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
          (strlen($datos['idItems'])<>'')&&
          (!isset($datos['fechaEvaluacion'])) &&
          (!isset($datos['tipo'])) &&
          (!isset($datos['idValorEvaluacion'])) &&
          (!isset($datos['observacionEvaluacion'])) &&
          (!isset($datos['creadoPor']))
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
            $this->idItems  = @$datos['idItems'];
            $this->idPlanificacionHeader  = @$datos['idPlanificacionHeader'];
            $this->fechaEvaluacion  =  date('Y-m-d');//@$datos['fechaEvaluacion'];
            $this->tipo = @$datos['tipo'];
            $this->idValorEvaluacion = @$datos['idValorEvaluacion'];
            $this->observacionEvaluacion  = @$datos['observacionEvaluacion'];
            $this->evaluadoPor =  @$datos['creadoPor'];//@$_SESSION['usuario'];
            $this->fechaCreacion = date('Y-m-d');
            $this->aprobadoPor = '';
            $this->idEvaluacion = @$datos['idEvaluacion'];;

            

          if($datos['mod']==1){//creacion del header y los items
            $resp = $this->Insertar();
            $idHeader = $resp ;
          }elseif($datos['mod']==2){//uldate solo del header
            $resp = $this->Update();
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

  private function Insertar()//()
  {
    $query = 'insert Into ' . $this->tabla . "
          (
            idItems,
            tipo,
            idValorEvaluacion,
            observacionEvaluacion,
            evaluadoPor,
            fechaEvaluacion,
            aprobadoPor
              )
      value
      (
          '$this->idItems',
          '$this->tipo',
          '$this->idValorEvaluacion',
          '$this->observacionEvaluacion',
          '$this->evaluadoPor',
          '$this->fechaEvaluacion',
          '$this->aprobadoPor'
          )";
      $Insertar = parent::nonQueryId($query);
      // print_r ($Insertar);die;
      if ($Insertar) {
      return $Insertar;
      } else {
      return 0;
      }
  }

  private function Update()//()
  {
    $query = 'update ' . $this->tabla . "
                          set
                          idItems='$this->idItems',
                          tipo='$this->tipo',
                          idValorEvaluacion='$this->idValorEvaluacion',
                          observacionEvaluacion='$this->observacionEvaluacion',
                          evaluadoPor='$this->evaluadoPor',
                          fechaEvaluacion='$this->fechaEvaluacion',
                          aprobadoPor='$this->aprobadoPor'
                      WHERE idEvaluacion = $this->idEvaluacion";

                      //echo  $query; die;
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
    $query = 'update ' . $this->tabla . "
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
