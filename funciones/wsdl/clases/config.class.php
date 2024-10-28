<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE SEDE
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 * 'clases/SEDE.class.php';
 *************************************************************/

require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class config extends conexion
{
  // Tabla Principal de sede
  private $tabla = 'configuracion';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idConfiguracion ='';
  private $campo ='';
  private $valor ='';
  private $token = '';

  /**
   * Listado de Sedes
   * http://taeo/funciones/wsdl/sede?idSede
   */
  public function getFieldConfig($idConfiguracion)//(revisado)
  {
    $where = " WHERE idConfiguracion <> '' ";
    if ($idConfiguracion != '') {
      $where =  $where . " and idConfiguracion = " . $idConfiguracion;
    }
    $query = "select * from $this->tabla $where";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;

  }

  //detalles de configuracion pro tipo (util para los email)
  public function getFieldConfigType($tipo)//(revisado)
  {
    $where = " WHERE idConfiguracion <> '' ";
    if ($tipo != '') {
      $where =  $where . " and tipo = '" . $tipo."'";
    }
    $query = "select * from $this->tabla $where";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;

  }

  public function getEmpleadoPorSede($idSede)//(revisado)
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


  public function getSedeByEmpleado($idUsuario)//(revisado)
  {
    $where = " WHERE sede.idSede <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and usuario_sede.idUsuario = " . $idUsuario;
    }

    $query = "SELECT sede.*
              FROM usuario_sede
                inner join sede on usuario_sede.idSede=sede.idSede
              $where";

    //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  //Crear una Sede
  public function post($json)//(revisado)
  {

    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {

      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (  // valida los campos obligatorios
          (!isset($datos['campo'])) &&
          (!isset($datos['valor']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {


          $this->idConfiguracion =@$datos['idConfiguracion'];
          $this->campo =@$datos['campo'];
          $this->valor =@$datos['valor'];

          if($datos['mod']==1)
            $resp = $this->Insertar();
          else
            $resp = $this->Update();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se Creo Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'ERROR EN LA ACCION SOBRE LA SEDE'
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
              campo ,
              valor
                )
        value
        (
            '$this->campo',
            '$this->valor'
            )";

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
                        campo  ='$this->campo',
                        valor  ='$this->valor'

                    WHERE idConfiguracion = $this->idConfiguracion";


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
