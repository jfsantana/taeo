<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE EMPLEADOS
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 *
 * 'clases/empleados.class.php';
 *************************************************************/
require_once '../wsdl/clases/consumoApi.class.php';
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

// hereda de la clase conexion
class planningItems extends conexion
{
  private $tabla = 'planificacion_items';
  private $idItems ='';
  private $idPlanificacionHeader ='';
  private $jerarquia ='';
  private $idPadre = '';
  private $descripcion='';
  private $tipo ='';
  private $fechaCreacion='1980-01-01';
  private $creadoPor='';
  private $idAreaObjetivo=0;
  private $nivelObjetivo=0;
  private $nivelPadre='';
  private $nivel1='';
  private $nivel2='';
  private $nivel3='';
  private $nivel4='';
  private $nivel5='';
  private $nivel6='';
  private $nivel0PlanEstructura='';
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534

  public function getExistePadre($idPlanificacionHeader, $jerarquia, $idNivel) //()
  {
    $where = " WHERE idPlanificacionHeader <> '' ";
    if ($idPlanificacionHeader != '') {
      $where =  $where . " and idNivel=".$idNivel." and jerarquia = '".$jerarquia."' and idPlanificacionHeader = " . $idPlanificacionHeader ;
    }
    $query = "select * from " . $this->tabla . " $where ";
    //echo   $query; die;
    return parent::ObtenerDatos($query);
  }

  public function getDetailItemsObjetyivo($idPlanificacionHeader) //()
  {
    $where = " WHERE idPlanificacionHeader <> '' ";
    if ($idPlanificacionHeader != '') {
      $where =  $where . " and idPlanificacionHeader = " . $idPlanificacionHeader;
    }
    $query = "select * from " . $this->tabla . " $where order by jerarquia";
    //echo   $query; die;
    return parent::ObtenerDatos($query);
  }

  public function almacenarPlanificacion($token, $idObjetivoHeader,$nodoNivel,$nodo)
  {
    $existeN1=$this->getExistePadre($this->idPlanificacionHeader, $nodoNivel,$this->nivelObjetivo  );
    if (empty($existeN1)) {
      $this->jerarquia = $nodoNivel;
      $URL='http://taeo/funciones/wsdl/objetivoItem?type=2&idHeader='.$idObjetivoHeader.'&jerarquia='. $nodo;
      $rs = API::GET($URL, $token, $_POST);
      $rs = API::JSON_TO_ARRAY($rs);
      $this->descripcion = @$rs[0]['descripcion'];
      $resp = $this->InsertarItems(
      );
    }
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
          (!isset($datos['idObjetivoHeader'])) &&
          (!isset($datos['nivelObjetivo'])) &&
          (isset($datos['actividad']) && !empty($datos['actividad']))&&
          (!isset($datos['tipo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior



           $this->idItems = @$datos['idItems'];
           $this->idPlanificacionHeader = @$datos['idObjetivoHeader'];

           $this->idPadre =  @$datos['idPadre'];
           $this->descripcion = @$datos['descripcion'];
           $this->tipo = @$datos['tipo'];
           $this->fechaCreacion = date('Y-m-d');
           $this->creadoPor =  @$datos['creadoPor'];//@$_SESSION['usuario'];

           $this->idAreaObjetivo =  @$datos['idAreaObjetivo'];

           

           $this->nivelObjetivo =  @$datos['nivelObjetivo'];

           //este es el nuverl del objetivo que debe ser el primero de a estructrua
           $this->nivel0PlanEstructura = str_pad(@$datos['nivelObjetivo'], 2, '0', STR_PAD_LEFT);
           
           $this->nivelPadre =  @$datos['nivelPadre'];
           $this->nivel1 =  @$datos['nivel1'];
           $this->nivel2 =  @$datos['nivel2'];
           $this->nivel3 =  @$datos['nivel3'];
           $this->nivel4 =  @$datos['nivel4'];
           $this->nivel5 =  @$datos['nivel5'];
           $this->nivel6 =  @$datos['nivel6'];

           /** esto es una prueba para agregar en el primer nivel la estructura del nivel de la planificacion           */
          $this->nivel6 =  $this->nivel0PlanEstructura.'.'.$this->nivel5;
          $this->nivel6 =  $this->nivel0PlanEstructura.'.'.$this->nivel5;
          $this->nivel5 =  $this->nivel0PlanEstructura.'.'.$this->nivel4;
          $this->nivel4 =  $this->nivel0PlanEstructura.'.'.$this->nivel3;
          $this->nivel3 =  $this->nivel0PlanEstructura.'.'.$this->nivel2;
          $this->nivel2 =  $this->nivel0PlanEstructura.'.'.$this->nivel1;
          $this->nivel1 =  $this->nivel0PlanEstructura.'.'.$this->nivelPadre;
          $this->nivelPadre =  $this->nivel0PlanEstructura;


          //con el valor de  nivelObjetivo  y el area que esta en la cabecera de la planificacion necesito el id del objetivoid para poder obtener la descripcion
          $token= $this->token ;
          $URL='http://taeo/funciones/wsdl/objetivo?type=6&idArea='.$this->idAreaObjetivo.'&idNivel='.$this->nivelObjetivo;
          //print_r($URL); die;
          $rs = API::GET($URL, $token, $_POST);
          $rs = API::JSON_TO_ARRAY($rs);
          $idObjetivoHeader=$rs[0]['idObjetivoHeader'];


          if($datos['mod']==1){

         //******************PADRE     OK
           //validar que solo no esta repetido el padre en la planificacion en  curso
           $existePadre=$this->getExistePadre($this->idPlanificacionHeader, $this->nivelPadre,$this->nivelObjetivo  );
        //  print_r($this->nivelPadre); die;
           if (empty($existePadre)) {
            $this->jerarquia = $this->nivelPadre;

            /* se cambio para que el nivel del objetivo fuese el primer nivel*/ 
            $URL='http://taeo/funciones/wsdl/area?type=3&idNivelAreaObjetivo='.$this->jerarquia;
            
            $rs = API::GET($URL, $token, $_POST);
            $rs = API::JSON_TO_ARRAY($rs);
            $this->descripcion = @$rs[0]['nombreNivelAreaObjetivo'];
            //inserta el nivel 0 de la jerarquia  (el nivel del objetivo)
            $resp = $this->InsertarItems();
           }
           
           //NivePadre
           $this->almacenarPlanificacion($token, $idObjetivoHeader, $this->nivel1,$datos['nivelPadre'] );
          //Nive1
          if(Isset($datos['nivel1']))
           $this->almacenarPlanificacion($token, $idObjetivoHeader, $this->nivel2,$datos['nivel1'] );
           //Nive2
          if(Isset($datos['nivel2']))
            $this->almacenarPlanificacion($token, $idObjetivoHeader, $this->nivel3,$datos['nivel2'] );
           //Nive3
          if(Isset($datos['nivel3']))
           $this->almacenarPlanificacion($token, $idObjetivoHeader, $this->nivel4,$datos['nivel3'] );
           //Nive4
          if(Isset($datos['nivel4']))
           $this->almacenarPlanificacion($token, $idObjetivoHeader, $this->nivel5,$datos['nivel4'] );
           //Nive5
          if(Isset($datos['nivel5']))
           $this->almacenarPlanificacion($token, $idObjetivoHeader, $this->nivel6,$datos['nivel5'] );


           


            //aui inserta las actividades
            if (isset($datos['actividad']) && is_array($datos['actividad'])) {
              //echo "<script>console.log('ACTIVIDADES');</script>";
              foreach ($datos['actividad'] as $jerarquia) {

                $nodoReal= $this->nivel0PlanEstructura.'.'.$jerarquia; 
                $existeactividad=$this->getExistePadre($this->idPlanificacionHeader, $nodoReal,$this->nivelObjetivo  );
                //print_r($existeactividad);
                if (empty($existeactividad)) {
                  $URL='http://taeo/funciones/wsdl/objetivoItem?type=2&idHeader='.$idObjetivoHeader.'&jerarquia='.$jerarquia;
                  $rs = API::GET($URL, $token, $_POST);
                  $rs = API::JSON_TO_ARRAY($rs);
                  $this->jerarquia = $nodoReal;
                  $this->descripcion = @$rs[0]['descripcion'];
                  $resp = $this->InsertarItems();
                  $this->descripcion='';  //valida que no se repita la misma herarquia dos veces
                }


              }
          }

         // die;



          }elseif($datos['mod']==2){
            $resp = $this->UpdateItems();
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

  private function InsertarItems()//()
  {
     $query = 'insert into ' . $this->tabla . "
               (
                 idPlanificacionHeader,
                 idNivel,
                 jerarquia,
                 idPadre,
                 descripcion,
                 tipo,
                 fechaCreacion,
                 creadoPor
                   )
           value
           (
               '$this->idPlanificacionHeader',
                '$this->nivelObjetivo',
               '$this->jerarquia',
               '$this->idPadre',
               '$this->descripcion',
               '$this->tipo',
               '$this->fechaCreacion',
               '$this->creadoPor'
            )";

    //echo $query; die;
     $Insertar = parent::nonQueryId($query);


     if ($Insertar) {
         return $Insertar;
    } else {
       return 0;
     }
  }

  private function UpdateItems()//()
  {
    // $query = 'update ' . $this->tabla . "
    //                       set
    //                       idHeader='$this->idHeader',
    //                       jerarquia='$this->jerarquia',";
    // if($this->id_padre=='')
    //       $query =$query .'id_padre=null, ';
    // else
    //       $query =$query ."id_padre='".$this->id_padre."', ";
    // $query =$query . "
    //                     descripcion='$this->descripcion',
    //                     activo='$this->activo',
    //                     versionObjetivo='$this->versionObjetivo'
    //                   WHERE id = $this->id";

    //                   //echo  $query; die;
    // $update = parent::nonQuery($query);

    // if ($update >= 1) {
    //   return $update;
    // } else {
    //   return 0;
    // }
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
