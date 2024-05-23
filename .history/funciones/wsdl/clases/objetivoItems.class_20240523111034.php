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
class objetivoItems extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'objetivo_item';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $id ='';
  private $idHeader ='';
  private $jerarquia ='';
  private $id_padre = '';
  private $descripcion='';
  private $activo ='';
  private $versionObjetivo='';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getDetailItemsObjetyivo($id) //()
  {
    $where = " WHERE id <> '' ";
    if ($id != '') {
      $where =  $where . " and id = " . $id;
    }
    $query = "select * from " . $this->tabla . " $where ";
    //echo   $query; die;
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
          (!isset($datos['idHeader'])) &&
          (!isset($datos['jerarquia'])) &&
          (!isset($datos['id_padre'])) &&
          (!isset($datos['descripcion'])) &&
          (!isset($datos['activo'])) &&
          (!isset($datos['versionObjetivo']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior

           $this->id = @$datos['id'];
           $this->idHeader = @$datos['idHeader'];
           $this->jerarquia = @$datos['jerarquia'];
           $this->descripcion =  @$datos['descripcion'];
           $this->activo = @$datos['activo'];
           $this->id_padre = @$datos['id_padre'];
           $this->versionObjetivo = @$datos['versionObjetivo'];

          if($datos['mod']==1){
            $resp = $this->InsertarHeader();
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

  private function InsertarHeader()//()
  {
    // $query = 'insert Into ' . $this->tabla . "
    //           (
    //             nombreObjetivo,
    //             versionObjetivo,
    //             activo,
    //             fechaCreacion,
    //             creadoPor
    //               )
    //       value
    //       (
    //           '$this->nombreObjetivo',
    //           '$this->versionObjetivo',
    //           '$this->activo',
    //           '$this->fechaCreacion',
    //           '$this->creadoPor'
    //           )";

    // //echo $query; die;
    // $Insertar = parent::nonQueryId($query);

    // print_r ($Insertar);die;
    // if ($Insertar) {
    //   return $Insertar;
    // } else {
    //   return 0;
    // }
  }

  private function UpdateItems()//()
  {
    $query = 'update ' . $this->tabla . "
                          set
                          idHeader='$this->idHeader',
                          jerarquia='$this->jerarquia',";
    if($this->id_padre=='')
          $query =$query .'id_padre=null, ';
    else
          $query =$query ."id_padre='".$this->id_padre."', ";
    $query =$query . "
                        descripcion='$this->descripcion',
                        activo='$this->activo',
                        versionObjetivo='$this->versionObjetivo'
                      WHERE id = $this->id";

                      //echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  public function del($idHeader,$versionObjetivo){
    $where =   " WHERE activo = 1 and idHeader = " . $idHeader." and versionObjetivo=$versionObjetivo";
    $query = "delete FROM objetivo_item ". $where ;
    //echo   $query; die;
    return parent::nonQuery($query);

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

     echo  $query; die;
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
