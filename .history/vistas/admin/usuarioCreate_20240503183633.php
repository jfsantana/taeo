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

// print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); //die;


//Lista de Cargos
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?type=2";
$rs         = API::GET($URL, $token);
$arrayCargos  = API::JSON_TO_ARRAY($rs);

//Lista de Roles
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/rol?type=1";
$rs         = API::GET($URL, $token);
$arrayRoles  = API::JSON_TO_ARRAY($rs);


//Lista de Sedes
$token = $_SESSION['token'];
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1";
$rs         = API::GET($URL1, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);


if ($_POST['mod'] == 1) {
  $accion = "Crear";
} else {
  $accion = "Editar";

  //datos facilitador o empleado
  $idUsuario = @$_POST["idUsuario"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?type=1&idUsuario=$idUsuario";
  $rs         = API::GET($URL, $token);
  $arrayUsuario  = API::JSON_TO_ARRAY($rs);
  //var_dump($arrayUsuario);

  $loginUsuario = $arrayUsuario[0]['loginUsuario'];
  $passUsuario = $arrayUsuario[0]['passUsuario'];
  $rolUsuario = $arrayUsuario[0]['rolUsuario'];
  $nombreUsuario = $arrayUsuario[0]['nombreUsuario'];
  $apellidoUsuario = $arrayUsuario[0]['apellidoUsuario'];
  $cargoUsuario = $arrayUsuario[0]['cargoUsuario'];
  $cedulaUsuario = $arrayUsuario[0]['cedulaUsuario'];
  $emailUsuario = $arrayUsuario[0]['emailUsuario'];
  $telefonoUsuario = $arrayUsuario[0]['telefonoUsuario'];
  $TelefonoEmergencia = $arrayUsuario[0]['TelefonoEmergencia'];
  $activoUsuario = $arrayUsuario[0]['activoUsuario'];
  $creadoPor = $arrayUsuario[0]['creadoPor'];
  $fechaCreacion = $arrayUsuario[0]['fechaCreacion'];
  $descripcionRol = $arrayUsuario[0]['descripcionRol'];
  $estado = $arrayUsuario[0]['estado'];
  $idSede = $arrayUsuario[0]['idSede'];
  $nombreSede = $arrayUsuario[0]['nombreSede'];




  //var_dump($act_usu);


  if ($arrayUsuario[0]['act_usu'] == 1)
    $estado = 1;
  else
    $estado = 0;


  // var_dump($arrayClientes[0]['estado'] );

}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Usuarios</h1>
        <h4 class="m-0">(Facilitadores/Coordinadores)</h4>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_usuario.model.php" method="post" name="Usuario" id="Usuario">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idUsuario" value="<?php echo @$_POST['idUsuario'] ?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Usuario</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <label for="nombreCliente">Nombre</label>
                  <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" placeholder="Nombre(s)" value="<?php echo @$nombreUsuario; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="nombreCliente">Apellido</label>
                  <input type="text" class="form-control" name="apellidoUsuario" id="apellidoUsuario" placeholder="Apellido(s)" value="<?php echo @$apellidoUsuario; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="nombreCliente">Cedula</label>
                  <input type="text" class="form-control" name="cedulaUsuario" id="cedulaUsuario" placeholder="Cedula del Personal" value="<?php echo @$cedulaUsuario; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="nombreCliente">Email</label>
                  <input type="email" class="form-control" name="emailUsuario" id="emailUsuario" placeholder="Cargo del Personal" value="<?php echo @$emailUsuario; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="nombreCliente">Telefono Personal</label>
                  <input type="text" class="form-control" name="telefonoUsuario" id="telefonoUsuario" placeholder="Telefono del Personal" value="<?php echo @$telefonoUsuario; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="nombreCliente">Telefono Emergencia</label>
                  <input type="mail" class="form-control" name="TelefonoEmergencia" id="TelefonoEmergencia" placeholder="Cargo del Personal" value="<?php echo @$TelefonoEmergencia; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="nombreCliente">Cargo</label>
                  <input type="mail" class="form-control" name="cargoUsuario" id="cargoUsuario" placeholder="Cargo del Personal" value="<?php echo @$cargoUsuario; ?>">
                </div>

                <div class="col-sm-3">
                  <label>Cargo</label>
                  <select class="form-control select2" name="idConsultoraContratante" style="width: 100%;">
                    <option>Seleccione</option>
                    <?php
                    foreach ($arrayCargos  as $cargo) {
                    ?>
                      <option value='<?php echo $cargo['idcargos']; ?>' <?php if (@$idConsultoraContratante == @$cargo['idcargos']) {
                                                                                          echo 'selected';
                                                                                        } ?>>
                        <?php echo $cargo['descripcionCargo']; ?>
                      </option>
                    <?php } ?>
                    <!-- <option selected="selected">Alabama</option>  -->

                  </select>
                </div>



                <div class="col-sm-3">
                  <label for="nombreCliente">Ubicacion Residencia</label>
                  <input type="text" class="form-control" name="ubicacionResidencia" id="ubicacionResidencia" placeholder="Direccion de Residencia" value="<?php echo @$ubicacionResidencia; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="nombreCliente">Ident.</label>
                  <input type="text" class="form-control" name="ident" id="ident" placeholder="Identificador" value="<?php echo @$ident; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="nombreCliente">Frente Asignado</label>
                  <input type="text" class="form-control" name="frenteAsignado" id="frenteAsignado" placeholder="Frente Asignado" value="<?php echo @$frenteAsignado; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="nombreCliente">Carnetizacion</label>
                  <input type="text" class="form-control" name="carnetizacion" id="carnetizacion" placeholder="Carnetizacion" value="<?php echo @$carnetizacion; ?>">
                </div>

                <div class="col-sm-4">
                  <label for="nombreCliente">Usuario para la aplicacion</label>
                  <input type="text" class="form-control" name="log_usu" id="log_usu" placeholder="Usuario APP" value="<?php echo @$log_usu; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="nombreCliente">Contraseña</label>
                  <input type="text" class="form-control" name="pass_usu" id="pass_usu" placeholder="Clave inicial para  APP" value="<?php echo @$pass_usu; ?>">
                </div>

                <div class="col-sm-5">
                  <label>Rol</label>
                  <select class="form-control " name="rol_usu" style="width: 100%;">
                    <option>Seleccione</option>
                    <?php

                    foreach ($arrayRoles as $rol) {

                    ?>
                      <option value='<?php echo $rol['id_rol']; ?>' <?php if (@$rol_usu == $rol['id_rol']) {
                                                                      echo 'selected';
                                                                    } ?>>
                        <?php echo $rol['des_rol']; ?> <?php $rol['id_rol']; ?>
                      </option>
                    <?php } ?>
                    <!-- <option selected="selected">Alabama</option> -->

                  </select>
                </div>

                <div class="col-sm-5">
                  <label for="nombreCliente">Cargo</label>
                  <input type="text" class="form-control" name="car_usu" id="car_usu" placeholder="Cargo del Personal" value="<?php echo @$car_usu; ?>">
                </div>

                <div class="col-sm-2">
                  <label>Estado del Consultor </label>
                  <select class="form-control" name="act_usu" id="act_usu">
                    <option <?php if (@$estado == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$estado == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                  </select>
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
