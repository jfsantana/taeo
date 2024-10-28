<?php

/************************************************************
 * Diseñado por Jesus Santana
 * CLASE SEDE
 * Metodo servidor: $_GET, $_POST, $_PUT, $_DELETE
 * 'clases/SEDE.class.php';
 *************************************************************/

require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../../vendor/autoload.php';  // Asegúrate de que la ruta sea correcta
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
  private $tipoEvento = '';


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

  public function getSendEventById($idEvento)//(fino)
  {

    $_respuestas = new respuestas();
    $respuesta = $_respuestas->response;

    $idEvento = $_GET['idEvento'];
    
    if (!isset($idEvento)) {
        echo 'No se ha proporcionado un ID de evento.';
        exit;
    }
    
    $apiUrl = "http://taeo/funciones/wsdl/event?type=2&idEvento=" . $idEvento;
    $response = file_get_contents($apiUrl);
    $eventData = json_decode($response, true);
    

    //print("<pre>".print_r(($eventData[0]['tipoEvento']),true)."</pre>");  die;


    if (empty($eventData)) {
        echo 'No se encontraron datos para el evento con ID ' . $idEvento;
        exit;
    }
    
    $apiUrl = "http://taeo/funciones/wsdl/config?type=2&tipo=email";
    $response = file_get_contents($apiUrl);
    $mailData = json_decode($response, true);
    
    $mail = new PHPMailer(true);
    //print("<pre>".print_r(($mailData),true)."</pre>");  die;
    try {
    /**************HASTA AQUI PARA EL REQUIRE_ONCE ****************************************
        /******************
     * hay que hacer un endpoint que retorne los datos del envio de los correos esos ta estan en la BD
     * esta seccion se puede mejorar colocadolo en un archivo y haciendo un require_once
     */
    
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $mailData[7]['valor'];//'mail.organizaciontaeo.com'; // Reemplaza con tu servidor SMTP
        $mail->SMTPAuth = $mailData[6]['valor'];  //true;
        $mail->Username = $mailData[1]['valor']; // 'info@organizaciontaeo.com'; // Reemplaza con tu correo
        $mail->Password = $mailData[2]['valor']; // '_9H)GfPp(~w_'; // Reemplaza con tu contraseña
        $mail->SMTPSecure = $mailData[4]['valor']; // 'tls';
        $mail->Port = $mailData[3]['valor'];// 587;
        $mail->Helo = $mailData[5]['valor'];//  'organizaciontaeo.com'; // Configura el nombre HELO
        $mail->SMTPDebug = 0; // Puedes usar 2 para obtener información detallada
        $mail->Debugoutput = 'html'; // Mostrar la salida de depuración en formato HTML
        $mail->CharSet = 'UTF-8';
    
    /**************HASTA AQUI PARA EL REQUIRE_ONCE *****************************************/
    
        // Destinatarios
        $mail->setFrom('info@organizaciontaeo.com', 'Organización TAEo'); // Usa una dirección permitida por el servidor SMTP

        //dependeindo del tipo de evento se envia a diferentes correos

        if($eventData[0]['tipoEvento']=='Sede'){
            //tipo SEDE: se envia atodos los representantes de la sede
            $query = "SELECT r.correoRepresentante
                      FROM taeho_v2.planificacion_header ph
                        JOIN taeho_v2.aprendiz a ON ph.idAprendiz = a.idAprendiz
                        JOIN taeho_v2.aprendiz_representante ar ON a.idAprendiz = ar.idAprendiz
                        JOIN taeho_v2.representantes r ON ar.idRepresentante = r.idRepresentante
                      WHERE  a.activoAprendiz = 1 and r.activoRepresentante=1 AND r.correoRepresentante IS NOT NULL and ph.idSede = ".$eventData[0]['idSede'];
            $datos = parent::ObtenerDatos($query);
            foreach ($datos as $key => $value) {
                $mail->addAddress($value['email']);
            }
        }elseif($eventData[0]['tipoEvento']=='Facilitadores'){ //(OK)
            //tipo facilitador: se envia a todos los facilitadores
            $query = "SELECT emailUsuario FROM taeho_v2.usuario
                        inner join rol on usuario.rolUsuario=rol.idRol
                       where rol.idRol = 3  and usuario.emailUsuario is not null";
            $datos = parent::ObtenerDatos($query);
            foreach ($datos as $key => $value) {
                $mail->addAddress($value['emailUsuario']);
            }
        }elseif($eventData[0]['tipoEvento']=='Administrativo'){
            //tipo administrativo se envia a todos los administrativos
            $query = "SELECT emailUsuario FROM taeho_v2.usuario
            inner join rol on usuario.rolUsuario=rol.idRol
           where usuario.activoUsuario = 1 and usuario.emailUsuario is not null";
            $datos = parent::ObtenerDatos($query);
            foreach ($datos as $key => $value) {
                $mail->addAddress($value['email']);
            }
        }
        //$mail->addAddress('anagabrielagutierrez1@gmail.com');
    
        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = "Detalles del Evento: " . $eventData[0]['nombreEvento'];
        $mail->Body    = "
        <html>
        <head>
        <title>Detalles del Evento</title>
        </head>
        <body>
        <p>Nombre del Evento: " . $eventData[0]['nombreEvento'] . "</p>
        <p>Descripción: " . $eventData[0]['descripcionEvento'] . "</p>
        <p>Lugar: " . $eventData[0]['lugarEvento'] . "</p>
        <p>Fecha: " . $eventData[0]['fechaEvento'] . "</p>
        <p>Organizado por: " . $eventData[0]['organizadoPor'] . "</p>
        <img src='" . $eventData[0]['flayerImg'] . "' alt='" . $eventData[0]['flayerName'] . "' />
        </body>
        </html>
        ";
    
        $mail->send();

        $respuesta['status'] = 'OK';
        $respuesta['result'] = [
          'mensaje' => "Se envio Correctamente el correo del evento {id=$idEvento}"
        ];
        return $respuesta;
    } catch (Exception $e) {

      $respuesta['status'] = 'ERROR';
      $respuesta['result'] = [
        'mensaje' =>  "Error al enviar el correo: {$mail->ErrorInfo}"
      ];
      return $respuesta;

      
    }

  }

  
  public function getEventCalendar()//(fino)
  {
//trate todos los eventos un mes por dealnte u yno por detas solo los activios
    $query = "SELECT 
              LEFT(nombreEvento, 15) AS title,
              fechaEvento AS start,
              fechaEvento AS end,
              CASE 
                  WHEN fechaEvento < CURDATE() THEN '#6C757D' -- Color gris si la fecha es anterior a hoy
                  WHEN evento.tipoEvento = 'Sede' THEN '#235382'
                  WHEN evento.tipoEvento = 'Facilitadores' THEN '#FDCC45'
                  WHEN evento.tipoEvento = 'Administrativo' THEN '#F19123'
              END AS backgroundColor,
              CASE 
                  WHEN fechaEvento < CURDATE() THEN '#6C757D' -- Color gris si la fecha es anterior a hoy
                  WHEN evento.tipoEvento = 'Sede' THEN '#235382'
                  WHEN evento.tipoEvento = 'Facilitadores' THEN '#FDCC45'
                  WHEN evento.tipoEvento = 'Administrativo' THEN '#F19123'
              END AS borderColor,
              'false' AS allDay
          FROM 
              taeho_v2.evento
          WHERE 
              fechaEvento >= DATE_SUB(CURDATE(), INTERVAL (DAY(CURDATE()) - 1) + 1 MONTH) -- Primer día del mes anterior
              AND fechaEvento < DATE_ADD(LAST_DAY(CURDATE()), INTERVAL 2 MONTH) -- Primer día del mes después del próximo
              AND evento.activo = 1;
          ";
    //echo $query; die;
    $datos = parent::ObtenerDatos($query);
    return $datos;

  }

  public function getAllEvent($estatus)//(fino)
  {  //Planificados, Cerrados Todos
    if ($estatus=='Planificados') {
      $where =' WHERE evento.activo = 1 AND evento.fechaEvento >= CURDATE() order by fechaEvento LIMIT 30';
    }elseif($estatus=='Cerrados'){
      $where = ' WHERE evento.activo <> 1 order by fechaEvento desc LIMIT 30';
    }elseif($estatus=='Todos'){
      $where = '  order by fechaEvento desc Limit 50';
    }elseif($estatus=='Ejecutados'){
      $where = ' WHERE evento.activo = 1 AND evento.fechaEvento < CURDATE() order by fechaEvento LIMIT 30';
    }else{
      $where = ' WHERE evento.activo = 1 AND evento.fechaEvento >= CURDATE() order by fechaEvento LIMIT 30';
    }

    $query = "SELECT evento.*, sede.nombreSede FROM taeho_v2.evento 
                inner join sede on evento.idSede=sede.idSede $where";
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

          $this->tipoEvento  = @$datos['tipoEvento'];
          
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
              flayerTipo,
              tipoEvento
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
            '$this->flayerTipo',
            '$this->tipoEvento'
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
                                            flayerTipo  ='$this->flayerTipo',
                                            tipoEvento = '$this->tipoEvento'
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
