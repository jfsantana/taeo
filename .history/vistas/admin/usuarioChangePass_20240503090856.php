<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';
$token = $_SESSION['token'];
print("<pre>".print_r(($_SESSION) ,true)."</pre>"); //die;

//verificar que rol tiene el usuario
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?rol";
$rs         = API::GET($URL, $token);
$arrayRoles  = API::JSON_TO_ARRAY($rs);
//var_dump($arrayRoles[0]['id_rol']);
// print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); //die;


  $accion = "Editar - Cambio de Clave";

  $id = @$_SESSION['id_user'];
  $token = $_SESSION['token'];

  //datos del facilitador
  $URL = 'http://' . $_SERVER['HTTP_HOST'] . '/funciones/wsdl/empleados?token=' . $_SESSION['token'];
  $rs         = API::GET($URL, $token);
  $arrayUsuario  = API::JSON_TO_ARRAY($rs);


  //Listado Clientes
  //$idEmpresaConsultora =""
  $token = $_SESSION['token'];
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/consultora?idEmpresaConsultora=";
  $rs         = API::GET($URL1, $token);
  $arrayCconsultora  = API::JSON_TO_ARRAY($rs);


  $nom_usu = $arrayUsuario[0]['nombreUsuario'];
  $ape_usu = $arrayUsuario[0]['apellidoUsuario'];
  $log_usu = $arrayUsuario[0]['loginUsuario'];
  $pass_usu = $arrayUsuario[0]['passUsuario'];
  $act_usu = $arrayUsuario[0]['activoUsuario'];
  $tel_usu = $arrayUsuario[0]['telefonoUsuario'];
  $ced_usu = $arrayUsuario[0]['cedulaUsuario'];
  $car_usu = $arrayUsuario[0]['cargoUsuario'];
  $cor_usu = $arrayUsuario[0]['emailUsuario'];
  $rol_usu = $arrayUsuario[0]['rolUsuario'];
  $des_rol = $arrayUsuario[0]['descripcionRol'];
  $estado =   $act_usu ;


?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Consultores</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_usuarioPass.model.php" method="post" name="Reporte24H" id="Reporte24H">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idEmpleado" value="<?php echo @$_SESSION['id_user']; ?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Consultor</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <label for="nombreCliente">Nombre</label>
                  <input type="text" class="form-control" name="readonly" id="readonly" readonly placeholder="Nombre(s)" value="<?php echo @$nom_usu; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="nombreCliente">Apellido</label>
                  <input type="text" class="form-control" name="readonly" id="readonly" readonly placeholder="Apellido(s)" value="<?php echo @$ape_usu; ?>">
                </div>

                <div class="col-sm-4">
                  <label for="nombreCliente">Cedula</label>
                  <input type="text" class="form-control" name="readonly" id="readonly" readonly placeholder="Cedula del Personal" value="<?php echo @$ced_usu; ?>">
                </div>

                <div class="col-sm-4">
                  <label for="nombreCliente">Telefono</label>
                  <input type="text" class="form-control" name="tel_usu" id="tel_usu" placeholder="Telefono del Personal" value="<?php echo @$tel_usu; ?>">
                </div>

                <div class="col-sm-4">
                  <label for="nombreCliente">Email</label>
                  <input type="mail" class="form-control" name="readonly" id="readonly" readonly placeholder="Cargo del Personal" value="<?php echo @$cor_usu; ?>">
                </div>


                <div class="col-sm-4">
                  <label>Consultora</label>
                  <select class="form-control select2" disabled name="Cliente" style="width: 100%;">
                    <option>Seleccione</option>
                    <?php
                    foreach ($arrayCconsultora  as $consultora) {
                       ?>
                      <option value='<?php echo $consultora['idEmpresaConsultora']; ?>' <?php if (@$idConsultoraContratante == @$consultora['idEmpresaConsultora']) {
                                                                            echo 'selected';
                                                                          } ?>>
                        <?php echo $consultora['nombreEmpresaConsultora'];?>
                      </option>
                    <?php } ?>
                    <!-- <option selected="selected">Alabama</option> -->

                  </select>
                </div>

                <div class="col-sm-4">
                  <label for="nombreCliente">Usuario para la aplicacion</label>
                  <input type="text" class="form-control" name="readonly" id="readonly" readonly placeholder="Usuario APP" value="<?php echo @$log_usu; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="nombreCliente">Contraseña</label>
                  <input type="text" class="form-control" name="pass_usu" id="pass_usu" placeholder="Clave inicial para  APP" value="<?php echo @$pass_usu; ?>">
                </div>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><?php echo $accion; ?></button>
            </div>
          </form>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
</form>
