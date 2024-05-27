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
                  <input type="text" class="form-control" name="nombreNivelAreaObjetivo" id="nombreNivelAreaObjetivo" placeholder="Nombre(s)" value="<?php echo @$nombreNivelAreaObjetivo; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="descripcionNivelAreaObjetivo">Descripcion del Nivel</label>
                  <input type="text" class="form-control" name="descripcionNivelAreaObjetivo" id="descripcionNivelAreaObjetivo" placeholder="Descripcion del Nivel " value="<?php echo @$descripcionNivelAreaObjetivo; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="cedulaRepresentante">Cedula</label>
                  <input type="text" class="form-control" name="cedulaRepresentante" id="cedulaRepresentante" placeholder="Cedula" value="<?php echo @$cedulaRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="telefonoRepresentante">Telefono</label>
                  <input type="text" class="form-control" name="telefonoRepresentante" id="telefonoRepresentante" placeholder="telefonoRepresentante" value="<?php echo @$telefonoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="parentescoRepresentante">Parentesco</label>
                  <select class="form-control " name="parentescoRepresentante" style="width: 100%;">
                      <option value='Madre' <?php if (@$parentescoRepresentante == 'Madre') { echo 'selected';} ?>>Madre</option>
                      <option value='Padre' <?php if (@$parentescoRepresentante == 'Padre') { echo 'selected';} ?>>Padre</option>
                      <option value='Hermano(a)' <?php if (@$parentescoRepresentante == 'Hermano(a)') { echo 'selected';} ?>>Hermano(a)</option>
                      <option value='Tio(a)' <?php if (@$parentescoRepresentante == 'Tio(a)') { echo 'selected';} ?>>Tio(a)</option>
                      <option value='Cuidador(a)' <?php if (@$parentescoRepresentante == 'Cuidador(a)') { echo 'selected';} ?>>Cuidador(a)</option>
                      <option value='Transporte' <?php if (@$parentescoRepresentante == 'Transporte') { echo 'selected';} ?>>Transporte</option>
                      <option value='Abuelo(a)' <?php if (@$parentescoRepresentante == 'Abuelo(a)') { echo 'selected';} ?>>Abuelo(a)</option>
                      <option value='Padrino(a)' <?php if (@$parentescoRepresentante == 'Padrino(a)') { echo 'selected';} ?>>Padrino(a)</option>
                      <option value='Sobrino(a)' <?php if (@$parentescoRepresentante == 'Sobrino(a)') { echo 'selected';} ?>>Sobrino(a)</option>
                      <option value='Vecino(a)' <?php if (@$parentescoRepresentante == 'Vecino(a)') { echo 'selected';} ?>>Vecino(a)</option>
                  </select>

                </div>

                <div class="col-sm-3">
                  <label for="profesionRepresentante">Profesion Representante</label>
                  <input type="text" class="form-control" name="profesionRepresentante" id="profesionRepresentante" placeholder="profesionRepresentante" value="<?php echo @$profesionRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="lugarTrabajoRepresentante">Lugar de Trabajo</label>
                  <input type="text" class="form-control" name="lugarTrabajoRepresentante" id="lugarTrabajoRepresentante" placeholder="lugarTrabajoRepresentante" value="<?php echo @$lugarTrabajoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="correoRepresentante">Email</label>
                  <input type="email" class="form-control" name="correoRepresentante" id="correoRepresentante" placeholder="correoRepresentante" value="<?php echo @$correoRepresentante; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="razonSocialRepresentante">Razon Social</label>
                  <input type="text" class="form-control" name="razonSocialRepresentante" id="razonSocialRepresentante" placeholder="razonSocialRepresentante" value="<?php echo @$razonSocialRepresentante; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="rifRepresentante">Rif</label>
                  <input type="text" class="form-control" name="rifRepresentante" id="rifRepresentante" placeholder="rifRepresentante" value="<?php echo @$rifRepresentante; ?>">
                </div>
                <div class="col-sm-6">
                  <label for="direccionFiscalRepresentante">Direccion Fiscal</label>
                  <input type="text" class="form-control" name="direccionFiscalRepresentante" id="direccionFiscalRepresentante" placeholder="direccionFiscalRepresentante" value="<?php echo @$direccionFiscalRepresentante; ?>">
                </div>

                <div class="col-sm-2">
                  <label>Puede Retirar a su Representante</label>
                  <select class="form-control " name="retirarAprendiz" style="width: 100%;">
                      <option value='1' <?php if (@$retirarAprendiz == 1) { echo 'selected';} ?>>Si</option>
                      <option value='0' <?php if (@$retirarAprendiz == 0) { echo 'selected';} ?>>No</option>
                  </select>
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


