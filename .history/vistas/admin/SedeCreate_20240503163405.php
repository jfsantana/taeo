<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

 //print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;
$token='';
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?aprobadores";
$rs         = API::GET($URL, $token);
$arrayAprobadores  = API::JSON_TO_ARRAY($rs);

 //print("<pre>".print_r(($arrayAprobadores) ,true)."</pre>"); //die;

if ($_POST['mod'] == 1) {
  $accion = "Crear";
} else {
  $accion = "Editar";
  //Listado Sede
  $id = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1&idSede=$id";
  $rs         = API::GET($URL, $token);
  $arrayCconsultora  = API::JSON_TO_ARRAY($rs);

  $nombreSede = $arrayCconsultora[0]['nombreSede'];
  //rifSede
  //paisSede
  //ciudadSede
  //direccionSede
  //telefonoSede
  //emailSede
  //estado
  if ($arrayCconsultora[0]['estado'] == 'Activo')
    $estado = 1;
  else
    $estado = 0;
}
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Sede</h1>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_sede.model.php" method="post" name="consultora" id="consultora">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idSede" value="<?php echo @$_POST['id'] ?>">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-12 col-12">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Sede</h3>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <label for="rifSede">Rif - Codigo Fiscal</label>
                  <input type="text" class="form-control" require name="rifSede" id="rifSede" placeholder="Rif" value="<?php echo @$rifSede; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="nombreSede">Nombre Sede</label>
                  <input type="text" class="form-control" require name="nombreSede" id="nombreSede" placeholder="Nombre de la Sede" value="<?php echo @$nombreSede; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="telefonoSede">Telefono Sede</label>
                  <input type="text" class="form-control" require name="telefonoSede" id="telefonoSede" placeholder="Nombre de la Sede" value="<?php echo @$telefonoSede; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="emailSede">Em@il</label>
                  <input type="email" class="form-control" require name="emailSede" id="emailSede" placeholder="Nombre de la Sede" value="<?php echo @$emailSede; ?>">
                </div>
                <div class="col-sm-4">
                  <label for="nombreCliente">Pais</label>
                  <select class="form-control" name="paisSede" id="paisSede" require>
                    <option >Seleccione</option>
                    <option <?php if (@$estado == 'Chile') {
                              echo 'selected';
                            } ?> value="Chile">Chile</option>
                    <option <?php if (@$paisSede == 'Venezuela') {
                              echo 'selected';
                            } ?> value="Venezuela">Venezuela</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="nombreCliente">Ciudad</label>
                  <select class="form-control" name="ciudadSede" id="ciudadSede" require>
                    <option >Seleccione</option>
                    <option <?php if (@$estado == 'Carabobo') {
                              echo 'selected';
                            } ?> value="Carabobo">Carabobo</option>
                    <option <?php if (@$paisSede == 'Santiago') {
                              echo 'selected';
                            } ?> value="Santiago">Santiago</option>
                  </select>
                </div>
                <div class="col-sm-12">
                    <label for="nombreCliente">Direccion</label>
                    <textarea id="summernote" name="direccionSede">

                    </textarea>
                </div>
                <div class="col-sm-4">
                  <label>Estado</label>
                  <select class="form-control" name="activo" id="activo" require>
                    <option >Seleccione</option>
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
        </div>


        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><?php echo $accion; ?></button>
        </div>
    </div>
  </div>
<!-- ./col -->

<!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
</form>
