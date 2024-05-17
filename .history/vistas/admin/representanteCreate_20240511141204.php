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


//Lista de Sedes de taeo
$token = $_SESSION['token'];
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1";
$rs         = API::GET($URL1, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);


if ($_POST['mod'] == 1) {
  $accion = "Crear";
} else {
  $accion = "Editar";

  //datos Representante
  $idRepresentante = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/representante?type=1&idRepresentante=$idRepresentante";
  $rs         = API::GET($URL, $token);
  $arrayUsuario  = API::JSON_TO_ARRAY($rs);

  $nombreRepresentante = $arrayUsuario[0]['nombreRepresentante'];
  $apellidoRepresentante = $arrayUsuario[0]['apellidoRepresentante'];
  $cedulaRepresentante = $arrayUsuario[0]['cedulaRepresentante'];
  $profesionRepresentante = $arrayUsuario[0]['profesionRepresentante'];
  $lugarTrabajoRepresentante = $arrayUsuario[0]['lugarTrabajoRepresentante'];
  $correoRepresentante = $arrayUsuario[0]['correoRepresentante'];
  $telefonoRepresentante = $arrayUsuario[0]['telefonoRepresentante'];
  $parentescoRepresentante = $arrayUsuario[0]['parentescoRepresentante'];
  $retirarAprendiz = $arrayUsuario[0]['retirarAprendiz'];
  $razonSocialRepresentante = $arrayUsuario[0]['razonSocialRepresentante'];
  $rifRepresentante = $arrayUsuario[0]['rifRepresentante'];
  $direccionFiscalRepresentante = $arrayUsuario[0]['direccionFiscalRepresentante'];
  $activoRepresentante = $arrayUsuario[0]['activoRepresentante'];
  $creadoPor = $arrayUsuario[0]['creadoPor'];
  $fechaCreacion = $arrayUsuario[0]['fechaCreacion'];


  if ($arrayUsuario[0]['activoRepresentante'] == 1)
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
        <h1 class="m-0">Padres o Representantes</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_usuario.model.php" method="post" name="Usuario" id="Usuario">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idRepresentante" value="<?php echo @$idRepresentante ?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Representante</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <label for="nombreRepresentante">Nombre</label>
                  <input type="text" class="form-control" name="nombreRepresentante" id="nombreRepresentante" placeholder="Nombre(s)" value="<?php echo @$nombreRepresentante; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="apellidoRepresentante">Apellido</label>
                  <input type="text" class="form-control" name="apellidoRepresentante" id="apellidoRepresentante" placeholder="Apellido(s)" value="<?php echo @$apellidoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="cedulaRepresentante">Cedula</label>
                  <input type="text" class="form-control" name="cedulaRepresentante" id="cedulaRepresentante" placeholder="Cedula" value="<?php echo @$cedulaRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="profesionRepresentante">Profesion Representante</label>
                  <input type="text" class="form-control" name="profesionRepresentante" id="profesionRepresentante" placeholder="profesionRepresentante" value="<?php echo @$profesionRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="lugarTrabajoRepresentante">Telefono Emergencia</label>
                  <input type="text" class="form-control" name="lugarTrabajoRepresentante" id="lugarTrabajoRepresentante" placeholder="lugarTrabajoRepresentante" value="<?php echo @$lugarTrabajoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="correoRepresentante">Email</label>
                  <input type="email" class="form-control" name="correoRepresentante" id="correoRepresentante" placeholder="correoRepresentante" value="<?php echo @$correoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="telefonoRepresentante">telefonoRepresentante</label>
                  <input type="text" class="form-control" name="telefonoRepresentante" id="telefonoRepresentante" placeholder="telefonoRepresentante" value="<?php echo @$telefonoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="parentescoRepresentante">parentescoRepresentante</label>
                  <input type="text" class="form-control" name="parentescoRepresentante" id="parentescoRepresentante" placeholder="parentescoRepresentante" value="<?php echo @$parentescoRepresentante; ?>">
                </div>



                <div class="col-sm-4">
                  <label>retirarAprendiz</label>
                  <select class="form-control select2" name="retirarAprendiz" style="width: 100%;">
                      <option value='1' <?php if (@$retirarAprendiz == 1) { echo 'selected';} ?>>Si</option>
                      <option value='0' <?php if (@$retirarAprendiz == 0) { echo 'selected';} ?>>No</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <label for="razonSocialRepresentante">razonSocialRepresentante</label>
                  <input type="text" class="form-control" name="razonSocialRepresentante" id="razonSocialRepresentante" placeholder="razonSocialRepresentante" value="<?php echo @$razonSocialRepresentante; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="rifRepresentante">rifRepresentante</label>
                  <input type="text" class="form-control" name="rifRepresentante" id="rifRepresentante" placeholder="rifRepresentante" value="<?php echo @$rifRepresentante; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="direccionFiscalRepresentante">direccionFiscalRepresentante</label>
                  <input type="text" class="form-control" name="direccionFiscalRepresentante" id="direccionFiscalRepresentante" placeholder="direccionFiscalRepresentante" value="<?php echo @$direccionFiscalRepresentante; ?>">
                </div>


                <div class="col-sm-3">
                  <label for="nombreCliente">Contraseña</label>
                  <input type="text" class="form-control" name="passUsuario" id="passUsuario" placeholder="Clave inicial para  APP" value="<?php echo @$passUsuario; ?>">
                </div>

                <div class="col-sm-2">
                  <label>Activo</label>
                  <select class="form-control" name="activoRepresentante" id="activoRepresentante">
                    <option <?php if (@$activoRepresentante == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$activoRepresentante == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                  </select>
                </div>
              </div>



            </div>

            <div class="card-footer">
              <button type="button" class="btn btn-primary" onclick="validarCheckbox()"><?php echo $accion; ?></button>
              <button type="button" class="btn btn-primary" onclick="enviarParametros('admin/representanteList.php')">Volver</button>
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

<script>
  function validarCheckbox() {
    var checkboxes = document.getElementsByName('sede[]');
    var seleccionado = false;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            seleccionado = true;
            break;
        }
    }

    if (!seleccionado) {
        alert('Debes seleccionar al menos una sede.');
        return false;
    }else{
      document.Usuario.submit();
    }
}
</script>