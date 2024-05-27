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
class nivelArea extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'nivelareaobjetivo';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idNivelAreaObjetivo = '';
  private $idAreaObjetivo = '';
  private $descripcionNivelAreaObjetivo = '';
  private $activo = '';
  private $nombreNivelAreaObjetivo = '';
  private $fechaCreacion = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getNivelArea($idNivelAreaObjetivo) //()
  {
    $where = " WHERE idNivelAreaObjetivo <> '' ";
    if ($idNivelAreaObjetivo != '') {
      $where =  $where . " and idNivelAreaObjetivo = " . $idNivelAreaObjetivo;
    }
    $query = "select *, case when activo = 1 Then 'Activo' else 'Bloqueado' end estado from " . $this->tabla . " $where ";
    return parent::ObtenerDatos($query);
  }

  public function getAprendizByRepresentante($idNivelAreaObjetivo) //()
  {
    $where = " WHERE aprendiz.activoAprendiz = 1 ";
    if ($idNivelAreaObjetivo != '') {
      $where =  $where . " and aprendiz_representante.idNivelAreaObjetivo = " . $idNivelAreaObjetivo;
    }
    $query = "SELECT  aprendiz.*  FROM aprendiz_representante INNER JOIN aprendiz on aprendiz.idAprendiz=aprendiz_representante.idAprendiz $where ";
    //echo $query;
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
          (!isset($datos['idAreaObjetivo'])) &&
          (!isset($datos['descripcionNivelAreaObjetivo'])) 
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          // Asignacion de datos validados su existencia en el If anterior

          $this->idNivelAreaObjetivo = @$datos['idNivelAreaObjetivo'];
          $this->idAreaObjetivo = @$datos['idAreaObjetivo'];
          $this->descripcionNivelAreaObjetivo = @$datos['descripcionNivelAreaObjetivo'];
          $this->activo = @$datos['activo'];;
          $this->nombreNivelAreaObjetivo = @$_SESSION['usuario'];

          if($datos['mod']==1){
            $resp = $this->Insertar();
          }elseif($datos['mod']==2){

            $resp = $this->Update();
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

  private function Insertar()//()
  {

        $this-> = @$datos['idAreaObjetivo'];
    $this-> = @$datos['descripcionNivelAreaObjetivo'];
    $this->activo = @$datos['activo'];;
    $this->nombreNivelAreaObjetivo = @$_SESSION['usuario'];
    $query = 'insert Into ' . $this->tabla . "
              (
                idAreaObjetivo,
                descripcionNivelAreaObjetivo,
                activo,
                nombreNivelAreaObjetivo
                  )
          value
          (
              '$this->idAreaObjetivo',
              '$this->descripcionNivelAreaObjetivo',
              '$this->activo',
              '$this->nombreNivelAreaObjetivo'
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

  private function Update()//()
  {
    $query = 'update ' . $this->tabla . "
                          set
                          idAreaObjetivo='$this->idAreaObjetivo',
                          descripcionNivelAreaObjetivo='$this->descripcionNivelAreaObjetivo',
                          cedulaRepresentante='$this->cedulaRepresentante',
                          profesionRepresentante='$this->profesionRepresentante',
                          lugarTrabajoRepresentante='$this->lugarTrabajoRepresentante',
                          correoRepresentante='$this->correoRepresentante',
                          telefonoRepresentante='$this->telefonoRepresentante',
                          parentescoRepresentante='$this->parentescoRepresentante',
                          retirarAprendiz='$this->retirarAprendiz',
                          rifRepresentante='$this->rifRepresentante',
                          direccionFiscalRepresentante='$this->direccionFiscalRepresentante',
                          activo='$this->activo',
                          fechaCreacion='$this->fechaCreacion',
                          nombreNivelAreaObjetivo='$this->nombreNivelAreaObjetivo'

                      WHERE idNivelAreaObjetivo = $this->idNivelAreaObjetivo";

                      //echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  public function del($json)//()
  {
    $_respuestas = new respuestas();
    $datos = json_decode($json, true);

    if (!isset($datos['token'])) {
      return $_respuestas->error_401();
    } else {
      $this->token = $datos['token'];
      $arrayToken = $this->buscarToken();

      if ($arrayToken) {
        if (
          !isset($datos['idNivelAreaObjetivo'])
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idNivelAreaObjetivo = $datos['idNivelAreaObjetivo'];

          $resp = $this->EliminarEmpleados();

          if ($resp) {
            $respuesta = $_respuestas->response;
            $respuesta['result'] = [
              'Msg' => "eliminado el registro $ this->id",
            ];

            return $respuesta;
          } else {
            return $_respuestas->error_500();
          }
        }
      } else {
        return $_respuestas->error_401('El Token que envio es invalido o ha caducado');
      }
    }
  }

  private function EliminarEmpleados()//()
  {
    $query = "delete from $this->tabla
        WHERE idNivelAreaObjetivo = $this->idNivelAreaObjetivo";
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
