<?php

if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

 print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;

 //print("<pre>".print_r(($arrayAprobadores) ,true)."</pre>"); //die;

if (@$_POST['mod'] == 1) {
  $accion = "Crear";
} elseif(@$_POST['mod'] == 2) {
  $accion = "Editar";
  //Listado Sede
  $id = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivoItem?type=1&idItem=$id";
  $rs         = API::GET($URL, $token);
  $arrayItems  = API::JSON_TO_ARRAY($rs);

  $id = $arrayItems[0]['id'];

  $idHeader = $arrayItems[0]['idHeader'];
  $jerarquia = $arrayItems[0]['jerarquia'];
  $id_padre = $arrayItems[0]['id_padre'];
  $descripcion = $arrayItems[0]['descripcion'];
  $activo = $arrayItems[0]['activo'];

  if ($arrayItems[0]['activo'] == 'Activo')
    $estado = 1;
  else
    $estado = 0;
}else{
  $accion = "Crear";
  @$_POST['mod'] = 1;
}
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Objetivo (Items) </h1>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_item.model.php" method="post" name="consultora" id="consultora">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <!-- //id de la tabla items -->
  <input type="hidden" name="id" value="<?php echo @$_POST['id'] ?>">

  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-12 col-12">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Objetivos - Items</h3>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <label for="rifSede">Descripcion</label>
                  <input type="text" class="form-control" require name="descripcion" id="descripcion" placeholder="Rif" value="<?php echo @$descripcion; ?>">
                </div>
                <div class="col-sm-4">
                  <label>Estado</label>
                  <select class="form-control" name="activo" id="activo" required>
                    <option >Seleccione</option>
                    <option <?php if (@$activo  == 1) {
                              echo 'selected';
                            } ?> value="1">Activo</option>
                    <option <?php if (@$activo == 0) {
                              echo 'selected';
                            } ?> value="0">Desactivado</option>
                  </select>
                </div>
              </div>
          </div>
        </div>


        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><?php echo $accion; ?></button>
          <button type="button" class="btn btn-primary" onclick="enviarParametros('admin/objetivoListar.php')">Volver</button>
        </div>
    </div>
  </div>
<!-- ./col -->

<!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
</form>
