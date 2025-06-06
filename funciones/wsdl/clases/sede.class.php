<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE SEDE
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 * 'clases/SEDE.class.php';
 *************************************************************/

require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class sede extends conexion
{
  // Tabla Principal de sede
  private $tabla = 'sede';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idSede ='';
  private $nombreSede ='';
  private $paisSede ='';
  private $ciudadSede ='';
  private $direccionSede ='';
  private $rifSede ='';
  private $telefonoSede ='';
  private $emailSede ='';
  private $activo = '';
  private $fechaCreacion = '1900-01-01'; //date('Y-m-d');
  private $creador = '';
  private $token = '';

  /**
   * Listado de Sedes
   * http://taeo/funciones/wsdl/sede?idSede
   */
  public function getSede($idSede)//(revisado)
  {
    $where = " WHERE idSede <> '' ";
    if ($idSede != '') {
      $where =  $where . " and idSede = " . $idSede;
    }
    $query = "select *, CASE WHEN activo = 1 THEN 'Activo' ELSE 'Desactivado' END AS estado  from $this->tabla $where order by nombreSede";
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

  
  public function getSedeByEmpleadString($idUsuario)//(revisado)
  {
    $where = " WHERE sede.idSede <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and usuario_sede.idUsuario = " . $idUsuario;
    }

    $query = "SELECT sede.*
              FROM usuario_sede
                inner join sede on usuario_sede.idSede=sede.idSede
              $where";
  $arraySedes = parent::ObtenerDatos($query);
    $sedesId='';
    foreach ($arraySedes as $sedes) {
      $sedesId = $sedesId.','.$sedes['idSede'];
    }
    $sedesId = ltrim($sedesId, ',');
    //echo $query; die;
    return $sedesId;
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
          (!isset($datos['nombreSede'])) ||
          (!isset($datos['paisSede'])) ||
          (!isset($datos['ciudadSede'])) ||
          (!isset($datos['direccionSede'])) ||
          (!isset($datos['rifSede'])) ||
          (!isset($datos['emailSede']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idSede =@$datos['idSede'];
          $this->nombreSede =@$datos['nombreSede'];
          $this->paisSede =@$datos['paisSede'];
          $this->ciudadSede =@$datos['ciudadSede'];
          $this->direccionSede =@$datos['direccionSede'];
          $this->rifSede =@$datos['rifSede'];
          $this->telefonoSede =@$datos['telefonoSede'];
          $this->emailSede =@$datos['emailSede'];
          $this->activo =@$datos['activo'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creador = @$_SESSION['usuario'];




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
              nombreSede ,
              paisSede ,
              ciudadSede ,
              direccionSede ,
              rifSede ,
              telefonoSede ,
              emailSede ,
              fechaCreacion ,
              activo ,
              creadoPor
                )
        value
        (
            '$this->nombreSede',
            '$this->paisSede',
            '$this->ciudadSede',
            '$this->direccionSede',
            '$this->rifSede',
            '$this->telefonoSede',
            '$this->emailSede',
            '$this->fechaCreacion',
            '$this->activo',
            '$this->creador'
            )";

    $Insertar = parent::nonQueryId($query);

    // print_r ($Insertar);die;
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }

  //Actualizar una Sede
  public function put($json)//(revisado)
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
          (!isset($datos['idSede'])) ||
          (!isset($datos['nombreSede'])) ||
          (!isset($datos['paisSede'])) ||
          (!isset($datos['ciudadSede'])) ||
          (!isset($datos['direccionSede'])) ||
          (!isset($datos['rifSede'])) ||
          (!isset($datos['emailSede']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idSede =@$datos['idSede'];
          $this->nombreSede =@$datos['nombreSede'];
          $this->paisSede =@$datos['paisSede'];
          $this->ciudadSede =@$datos['ciudadSede'];
          $this->direccionSede =@$datos['direccionSede'];
          $this->rifSede =@$datos['rifSede'];
          $this->telefonoSede =@$datos['telefonoSede'];
          $this->emailSede =@$datos['emailSede'];
          $this->activo =@$datos['activo'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creador = @$_SESSION['usuario'];

          $resp = $this->Update();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se Actualizo Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'No se realizo ningun cambio sobre la Sede'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }
  private function Update()//(revisado)
  {
    $query = 'update ' . $this->tabla . "
                        set
                        nombreSede  ='$this->nombreSede',
                        paisSede  ='$this->paisSede',
                        ciudadSede  ='$this->ciudadSede',
                        direccionSede  ='$this->direccionSede',
                        rifSede  ='$this->rifSede',
                        telefonoSede  ='$this->telefonoSede',
                        emailSede  ='$this->emailSede',
                        fechaCreacion  ='$this->fechaCreacion',
                        activo  ='$this->activo',
                        creadoPor  ='$this->creador'

                    WHERE idSede = $this->idSede";
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  //Desactivar una Sede
  public function del($json)//(revisado)
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
          (!isset($datos['idSede']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idSede =@$datos['idSede'];
          $resp = $this->delete();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'Se Desactivo Correctamente'
            ];
          } else {
            $respuesta = $_respuestas->response;
            $respuesta['status'] = 'ERROR';
            $respuesta['result'] = [
              'idHeaderNew' => $resp,
              'mensaje' => 'No se realizo ningun cambio sobre la Sede'
            ];
          }
          return $respuesta;
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }
  public function delete()//(revisado)
  {
    $query = 'update ' . $this->tabla . "
                        set
                        activo  ='0'
                    WHERE idSede = $this->idSede";

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
