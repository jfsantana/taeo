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

 print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;


if ($_POST['mod'] == 1) {
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idAprendiz=$_POST['id'];  //signifia que la creacion esta asociada a un aprendiz
  }
} else {
  $accion = "Editar";

  //datos Representante
  $idNivelAreaObjetivo = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/nivelArea?type=1&idNivelAreaObjetivo=$idNivelAreaObjetivo";
  $rs         = API::GET($URL, $token);
  $arrayNivelArea  = API::JSON_TO_ARRAY($rs);

  $nombreNivelAreaObjetivo = $arrayNivelArea[0]['nombreNivelAreaObjetivo'];
  $descripcionNivelAreaObjetivo = $arrayNivelArea[0]['descripcionNivelAreaObjetivo'];
  $idAreaObjetivo = $arrayNivelArea[0]['idAreaObjetivo'];
  $activo = $arrayNivelArea[0]['activo'];



  if ($arrayNivelArea[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;

    $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/representante?type=2&idNivelAreaObjetivo=$idNivelAreaObjetivo";
    $rs         = API::GET($URL, $token);
    $arrayAprendizByRepresentantes  = API::JSON_TO_ARRAY($rs);

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
<form action="../funciones/funcionesGenerales/XM_representante.model.php" method="post" name="representante" id="representante">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idNivelAreaObjetivo" value="<?php echo @$idNivelAreaObjetivo; ?>">
  <input type="hidden" name="idAreaObjetivo" value="<?php echo @$idAreaObjetivo; ?>">
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
                  <label for="nombreNivelAreaObjetivo">Nombre</label>
                  <input type="text" class="form-control" name="nombreNivelAreaObjetivo" id="nombreNivelAreaObjetivo" placeholder="Nombre del Nivel" value="<?php echo @$nombreNivelAreaObjetivo; ?>">
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

                
                <div class="col-sm-3">
                  <label for="descripcionNivelAreaObjetivo">Descripcion del Nivel</label>
                  <input type="text" class="form-control" name="descripcionNivelAreaObjetivo" id="descripcionNivelAreaObjetivo" placeholder="Descripcion del Nivel " value="<?php echo @$descripcionNivelAreaObjetivo; ?>">
                </div>



              </div>
              <?php if($_POST['mod'] == 2){?>
                <div class="col-sm-12">
                  <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th with=5%>Estado</th>
                                  <th>Nombre Aprendiz</th>
                                  <th>Fecha Nacimiento</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  foreach($arrayAprendizByRepresentantes as $facilitador){  ?>
                                  <td><?php if ($facilitador['activoAprendiz']==1){echo 'Activo';}else{echo 'No Activo';} ?></td>
                                  <td><?php echo $facilitador['apellidoAprendiz'].', '.$facilitador['nombreAprendiz']; ?></td>

                                  <?php
                                    $fecha_nacimiento = $facilitador['fechaNacimientoAprendiz'];
                                    $fecha_actual = date("Y-m-d H:i:s");

                                    $timestamp_nacimiento = strtotime($fecha_nacimiento);
                                    $timestamp_actual = strtotime($fecha_actual);

                                    $diferencia = abs($timestamp_actual - $timestamp_nacimiento);

                                    $anios = floor($diferencia / (365 * 60 * 60 * 24));
                                    $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));


                                    ?>
                                    <td><?php echo $anios . " años, " . $meses . " meses"; ?></td>







                                <?php } ?>
                              </tbody>
                                <tfoot>
                                  <tr>
                                    <th with=5%>Estado</th>
                                    <th>Nombre Aprendiz</th>
                                    <th>Fecha Nacimiento</th>

                                  </tr>
                                </tfoot>
                              </table>
                </div>
              <?php } ?>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary" ><?php echo $accion; ?></button>
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


