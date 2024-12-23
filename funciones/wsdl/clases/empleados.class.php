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
class empleados extends conexion
{
  // Tabla Principal de Empleados
  private $tabla = 'usuario';

  // se debe crear atributos para las tablas que se van a validar en la funcion "post"
  private $idUsuario = '';
  private $loginUsuario = '';
  private $passUsuario = '';
  private $rolUsuario = '';
  private $nombreUsuario = '';
  private $apellidoUsuario = '';
  private $cargoUsuario = '';
  private $cedulaUsuario = '';
  private $emailUsuario = '';
  private $telefonoUsuario = '';
  private $TelefonoEmergencia = '';
  private $activoUsuario = '';
  private $creadoPor = '';
  private $fechaCreacion = '1900-01-01';
  private $fechaNacimiento = '1900-01-01';


  // Activaciond e token
  private $token = ''; // b43bbfc8bcf8625eed413d91186e8534


  public function getEmpleado($idUsuario) //(revisado)
  {
    $where = " WHERE usuario.idUsuario <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and usuario.idUsuario = " . $idUsuario;
    }
      $query = "SELECT usuario.*, rol.descripcionRol, case when usuario.activoUsuario = 1 Then 'Activo' else 'Desactivado' end estado,
      usuario_sede.idSede, sede.nombreSede, cargo.descripcionCargo
      FROM usuario
      INNER JOIN rol ON usuario.rolUsuario = rol.idRol
      LEFT JOIN usuario_sede on usuario_sede.idUsuario=usuario.idUsuario
      LEFT JOIN sede on sede.idSede=usuario_sede.idSede
      INNER join cargo on cargo.idcargos=usuario.cargoUsuario $where  group by usuario.idUsuario";

    return parent::ObtenerDatos($query);
  }

  
  public function getSedeByEvaluador($idUsuario) //(revisado)
  {
   
      $query = "SELECT * 
                FROM taeho_v2.usuario_sede 
                      inner join sede on usuario_sede.idSede=sede.idSede 
                where usuario_sede.idUsuario = $idUsuario";

    return parent::ObtenerDatos($query);
  }

  public function getCargos($idUsuario) //(revisado)
  {
    $where = " WHERE cargo.idcargos <> '' ";
    if ($idUsuario != '') {
      $where =  $where . " and cargo.idUsuario = " . $idUsuario;
    }
      $query = "SELECT * FROM cargo". " $where ";

    return parent::ObtenerDatos($query);
  }

  public function getFacilitadorByCargos($rolUsuario) //(revisado)
  {
    $where = " WHERE usuario.idUsuario <> '' ";
    if ($rolUsuario != '') {
      $where =  $where . " and usuario.rolUsuario = " . $rolUsuario;
    }
      $query = "SELECT * FROM usuario". " $where ";

    return parent::ObtenerDatos($query);
  }

  public function getFacilitadorBySede($idSede) //(revisado)
  {
    $where = " WHERE u.rolUsuario=3 ";  // solo facilitadores
    if ($idSede != '') {
      $where =  $where . " and us.idSede = " . $idSede;
    }
    $query = "SELECT us.*, concat(u.apellidoUsuario,', ',u.nombreUsuario) as facilitador
      FROM usuario_sede as us
      inner join usuario as u ON us.idUsuario=u.idUsuario  $where ";

    return parent::ObtenerDatos($query);
  }

  public function getEvaluadorBySede($idSede) //(revisado)
  {
    $where = " WHERE u.rolUsuario<>'' ";  // solo facilitadores
    if ($idSede != '') {
      $where =  $where . " and us.idSede = " . $idSede;
    }
    $query = "SELECT 
                  us.*,
                  u.cargoUsuario,
                  c.descripcionCargo,
                  CONCAT(u.apellidoUsuario, ', ', u.nombreUsuario) AS facilitador
              FROM
                  usuario_sede AS us
                      INNER JOIN
                  usuario AS u ON us.idUsuario = u.idUsuario
                      INNER JOIN
                  cargo AS c ON c.idcargos = u.cargoUsuario  $where order by facilitador";
      //echo $query; die;
    return parent::ObtenerDatos($query);
  }

  public function obtenerEmpleadoToken($token)  //(revisado)
  {

    $query = "SELECT
              usuario.*,
              rol.descripcionRol,
              rol.orderRol
              FROM
              usuario_token
              INNER JOIN usuario ON usuario_token.loginUsuario = usuario.loginUsuario
              left JOIN rol ON usuario.rolUsuario = rol.idRol

              WHERE
              usuario_token.token =  '$token'";
         // echo $query ; die;
    return parent::ObtenerDatos($query);
  }

  public function post($json)  //(revisado)
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
          (!isset($datos['loginUsuario'])) ||
          (!isset($datos['passUsuario'])) ||
          (!isset($datos['rolUsuario'])) ||
          (!isset($datos['nombreUsuario'])) ||
          (!isset($datos['apellidoUsuario'])) ||
          (!isset($datos['cargoUsuario'])) ||
          (!isset($datos['cedulaUsuario'])) ||
          (!isset($datos['emailUsuario'])) ||
          (!isset($datos['telefonoUsuario']))
        ) {
          // en caso de que la validacion no se cumpla se arroja un error
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {

          $this->idUsuario = @$datos['idUsuario'];
          $this->loginUsuario = @$datos['loginUsuario'];
          $this->passUsuario = @$datos['passUsuario'];
          $this->rolUsuario = @$datos['rolUsuario'];
          $this->nombreUsuario = @$datos['nombreUsuario'];
          $this->apellidoUsuario = @$datos['apellidoUsuario'];
          $this->cargoUsuario = @$datos['cargoUsuario'];
          $this->cedulaUsuario = @$datos['cedulaUsuario'];
          $this->emailUsuario = @$datos['emailUsuario'];
          $this->telefonoUsuario = @$datos['telefonoUsuario'];
          $this->TelefonoEmergencia = @$datos['TelefonoEmergencia'];
          $this->activoUsuario = @$datos['activoUsuario'];
          $this->fechaCreacion = date('Y-m-d');
          $this->creadoPor = @$datos['creadoPor'];

          $this->fechaNacimiento = @$datos['fechaNacimiento'];


          if(@$datos['mod']==1){
            //inserta nuevo facilitador
            $resp = $this->Insertar();
            $this->idUsuario  = @$resp;
            // inserta sedes del facilitador nuevo
            $resp1 = $this->InsertarSede($datos['sede']);


          }else{

            //$resp=2;
            //actualiza los datos del facilitador
            $resp1 = $this->Update();
            // Actualiza las sedes del facilitador
            $resp1 = $this->UpdateSede($datos['sede']);
            $resp=2;
          }


            if ($resp) {
              $respuesta = $_respuestas->response;
              $respuesta['status'] = 'OK';
              $respuesta['result'] = [
                'idHeaderNew' => $resp,
                'mensaje' => 'Operacion correcta con  el Facilitador'
              ];
            } else {
              $respuesta = $_respuestas->response;
              $respuesta['status'] = 'ERROR';
              $respuesta['result'] = [
                'idHeaderNew' => $resp,
                'mensaje' => 'ERROR - Con el Facilitador'
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
                loginUsuario,
                passUsuario,
                rolUsuario,
                nombreUsuario,
                apellidoUsuario,
                cargoUsuario,
                cedulaUsuario,
                emailUsuario,
                telefonoUsuario,
                TelefonoEmergencia,
                activoUsuario,
                fechaCreacion,
                creadoPor,
                fechaNacimiento
                  )
          value
          (
              '$this->loginUsuario',
              '$this->passUsuario',
              '$this->rolUsuario',
              '$this->nombreUsuario',
              '$this->apellidoUsuario',
              '$this->cargoUsuario',
              '$this->cedulaUsuario',
              '$this->emailUsuario',
              '$this->telefonoUsuario',
              '$this->TelefonoEmergencia',
              '$this->activoUsuario',
              '$this->fechaCreacion',
              '$this->creadoPor',
              '$this->fechaNacimiento'

              )";


    $Insertar = parent::nonQueryId($query);

    // print_r ($Insertar);die;
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }

  private function InsertarSede($arraySede)//(revisado)
  {
    $query=" INSERT INTO usuario_sede (idUsuario, idSede) VALUES ";
    foreach ($arraySede  as $sede) {
      $query= $query . '(' .$this->idUsuario.','.$sede.'),';
    }

    $query = substr($query, 0, strlen($query) - 1);
    //echo  $query; die;echo  $query; die;
    $Insertar = parent::nonQuery($query);

    return $Insertar;

    // print_r ($Insertar);die;
    if ($Insertar) {
      return $Insertar;
    } else {
      return 0;
    }
  }
  public function put($json)  //(revisado)
  {
            $respuesta = '';
            $respuesta['status'] = 'OK';
            $respuesta['result'] = [
              'idHeaderNew' => 'n/a',
              'mensaje' => 'No se ejecuto ningun cambio en el Facilitador'
            ];
  }

  private function Update()//(revisado)
  {
    $query = 'update ' . $this->tabla . "
                          set
                          passUsuario='$this->passUsuario',
                          rolUsuario='$this->rolUsuario',
                          nombreUsuario='$this->nombreUsuario',
                          apellidoUsuario='$this->apellidoUsuario',
                          cargoUsuario='$this->cargoUsuario',
                          emailUsuario='$this->emailUsuario',
                          telefonoUsuario='$this->telefonoUsuario',
                          TelefonoEmergencia='$this->TelefonoEmergencia',
                          activoUsuario='$this->activoUsuario',
                          fechaCreacion='$this->fechaCreacion',
                          creadoPor='$this->creadoPor',
                          fechaNacimiento='$this->fechaNacimiento'
                      WHERE idUsuario = $this->idUsuario";

                      //echo  $query; die;echo  $query; die;
    $update = parent::nonQuery($query);

    if ($update >= 1) {
      return $update;
    } else {
      return 0;
    }
  }

  private function UpdateSede($arraySede)//(revisado)
  {
    $queryDel="DELETE FROM usuario_sede WHERE idUsuario = $this->idUsuario";
    $update = parent::nonQuery($queryDel);

    if(!empty($arraySede)){

      $query=" INSERT INTO usuario_sede (idUsuario, idSede) VALUES ";
      foreach ($arraySede  as $sede) {
        $query= $query . '(' .$this->idUsuario.','.$sede.'),';
      }

      $query = substr($query, 0, strlen($query) - 1);
      //echo  $query; die;echo  $query; die;
      $update = parent::nonQuery($query);
    }
      return $update;

  }
  
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
        if (
          !isset($datos['idUsuario'])
        ) {
          $datosArray = $_respuestas->error_400();
          echo json_encode($datosArray);
        } else {
          $this->idUsuario = $datos['idUsuario'];

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

  private function EliminarEmpleados()//(revisado)
  {
    $query = "delete from $this->tabla
        WHERE idUsuario = $this->idUsuario";
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
