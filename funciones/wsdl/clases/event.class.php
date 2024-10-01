<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE SEDE
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 * 'clases/SEDE.class.php';
 *************************************************************/

require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class event extends conexion
{
  // Tabla Principal de sede
  private $tabla = 'evento';

  private $idEvento =0;
  private $nombreEvento ='';
  private $idSede = 0;
  private $descripcionEvento = ''; //date('Y-m-d');
  private $lugarEvento ='';
  private $fechaEvento = '1900-01-01';
  private $envioCorreo = '';
  private $fechaCreacion = '1900-01-01';
  private $activo = '';
  private $creadoPor = '';
  private $flayerImg = '';
  private $organizadoPor = '';
  private $ponentes = '';
  private $flayerName = '';
  private $flayerTipo = '';
  private $flayerSize = '';
  private $rutaFichero = '';
  private $token = '';


  public function getEvent($idEvento)//(fino)
  {
    $where = " WHERE idEvento <> '' ";
    if ($idEvento != '') {
      $where =  $where . " and idEvento = " . $idEvento;
    }
    $query = "select * from $this->tabla $where order by fechaEvento desc";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;

  }

  public function getAllEvent()//(fino)
  {
    $query = "SELECT evento.*, sede.nombreSede FROM taeho_v2.evento 
                inner join sede on evento.idSede=sede.idSede

                order by fechaEvento desc  LIMIT 100";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;
  }

  //Crear una Evento
  public function post($json)//(actualizar)
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
          (!isset($datos['descripcionEvento'])) ||
          (!isset($datos['idSede'])) ||
          (!isset($datos['fechaEvento'])) ||
          (!isset($datos['organizadoPor'])) ||
          (!isset($datos['ponentes'])) 
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idEvento  = @$datos['idEvento'];
          $this->nombreEvento  = @$datos['nombreEvento'];
          $this->idSede  = @$datos['idSede'];
          $this->descripcionEvento  =@$datos['descripcionEvento'];
          $this->lugarEvento  = @$datos['lugarEvento'];
          
          // Convertir fechaEvento al formato adecuado
          $fechaEventoOriginal = @$datos['fechaEvento'];
          if ($fechaEventoOriginal == '') {
            $fechaEventoOriginal = getdate();
          }else{
            $fechaEventoDateTime = DateTime::createFromFormat('m/d/Y h:i A', $fechaEventoOriginal);
            $this->fechaEvento = $fechaEventoDateTime->format('Y-m-d H:i:s');
          }

          $this->envioCorreo  = @$datos['envioCorreo'];
          $this->fechaCreacion  == date('Y-m-d');
          $this->activo  =@$datos['activo'];
          $this->creadoPor  =@$_SESSION['usuario'];
          
          $this->organizadoPor  =@$datos['organizadoPor'];
          $this->ponentes =@$datos['ponentes'];
          
          $this->flayerName  =@$datos['imagen']['nombreFichero'];
          $this->flayerSize  =@$datos['imagen']['tamanoArchivo'];
          $this->flayerTipo  =@$datos['imagen']['tipoArchivo'];
          $this->rutaFichero  =@$datos['imagen']['rutaImagen'];



         if($datos['mod']==1){
          $resp = $this->Insertar();
         }else{
          $resp = $this->Update();
         }

          


            
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

  private function Insertar()//(actualizar)
  {

    // $nombreFichero = $this->rutaFichero;         
    // $archivoObjetivo=fopen($nombreFichero, "r");    //guarsa el archivo en una variable
    // $contenido = fread($archivoObjetivo, $this->flayerSize); //lee el archivo
    // fclose($archivoObjetivo); //cierra el archivo

    $query = 'insert Into ' . $this->tabla . "
            (
              nombreEvento ,
              idSede ,
              descripcionEvento ,
              lugarEvento,
              fechaEvento,
              envioCorreo,
              fechaCreacion,
              activo,
              creadoPor,
              flayerImg,
              organizadoPor,
              ponentes,
              flayerName,
              flayerTipo
                )
        value
        (
            '$this->nombreEvento',
            '$this->idSede',
            '$this->descripcionEvento',
            '$this->lugarEvento',
            '$this->fechaEvento',
            '$this->envioCorreo',
            '$this->fechaCreacion',
            '$this->activo',
            '$this->creadoPor',
            '$this->rutaFichero',
            '$this->organizadoPor',
            '$this->ponentes',
            '$this->flayerName',
            '$this->flayerTipo'
            )";
    // print_r ($query);die;
    $Insertar = parent::nonQueryId($query);
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }

  //Actualizar una Evento
  public function put($json)//(actualizar)
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
          (!isset($datos['descripcionEvento'])) ||
          (!isset($datos['idSede'])) ||
          (!isset($datos['fechaEvento'])) ||
          (!isset($datos['organizadoPor'])) ||
          (!isset($datos['ponentes'])) 
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idEvento  = @$datos['idEvento'];
          $this->nombreEvento  = @$datos['nombreEvento'];
          $this->idSede  = @$datos['idSede'];
          $this->descripcionEvento  =@$datos['descripcionEvento'];
          $this->lugarEvento  = @$datos['lugarEvento'];

          // Convertir fechaEvento al formato adecuado
          $fechaEventoOriginal = @$datos['fechaEvento'];
          if ($fechaEventoOriginal == '') {
            $fechaEventoOriginal = getdate();
          }else{
            $fechaEventoDateTime = DateTime::createFromFormat('m/d/Y h:i A', $fechaEventoOriginal);
            $this->fechaEvento = $fechaEventoDateTime->format('Y-m-d H:i:s');
          }
          

          $this->envioCorreo  = @$datos['envioCorreo'];
          $this->fechaCreacion  == date('Y-m-d');
          $this->activo  =@$datos['activo'];
          $this->creadoPor  =@$datos['creadoPor'];
          
          $this->organizadoPor  =@$datos['organizadoPor'];
          $this->ponentes =@$datos['ponentes'];

          $this->flayerName  =@$datos['imagen']['nombreFichero'];
          $this->flayerSize  =@$datos['imagen']['tamanoArchivo'];
          $this->flayerTipo  =@$datos['imagen']['tipoArchivo'];
          $this->rutaFichero  =@$datos['imagen']['rutaImagen'];


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



  private function Update()//(actualizar)
  {
    $query = 'update ' . $this->tabla . " set
                                            nombreEvento  ='$this->nombreEvento',
                                            idSede  =$this->idSede,
                                            descripcionEvento  ='$this->descripcionEvento',

                                            lugarEvento  ='$this->lugarEvento',
                                            fechaEvento  ='$this->fechaEvento',
                                            envioCorreo  ='$this->envioCorreo',
                                            fechaCreacion  ='$this->fechaCreacion',
                                            activo  ='$this->activo',
                                            creadoPor  ='$this->creadoPor',
                                            flayerImg  ='$this->rutaFichero',
                                            organizadoPor  ='$this->organizadoPor',
                                            ponentes  ='$this->ponentes',
                                            flayerName  ='$this->flayerName',
                                            flayerTipo  ='$this->flayerTipo'
                                        WHERE idEvento = $this->idEvento";
    //  print_r($query);    die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  private function buscarToken()//(actualizar)
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

  private function actualizarToken($tokenId) //(actualizar)
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
