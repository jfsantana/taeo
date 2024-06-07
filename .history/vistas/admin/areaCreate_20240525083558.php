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



if ($_POST['mod'] == 1) {
  $accion = "Crear";
} else {
  $accion = "Editar";

  //datos del area seleccioada
  $idArea = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/area?type=1&idArea=$idArea";
  $rs         = API::GET($URL, $token);
  $arrayArea  = API::JSON_TO_ARRAY($rs);

  $nombreArea = $arrayArea[0]['nombreArea'];
  $descripcionArea = $arrayArea[0]['descripcionArea'];

  //Lista de Niveles del &Aacute;rea Seleccioanda
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/area?type=2&idArea=$idArea";//$idArea
  $rs         = API::GET($URL1, $token);
  $arrayNivelesArea  = API::JSON_TO_ARRAY($rs);

  if ($arrayArea[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;
}
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Aprendiz</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_aprendiz.model.php" method="post" name="Usuario" id="Usuario">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idArea" value="<?php echo @$idArea ?>">
  <input type="hidden" name="creadoPor" value="<?php echo @$creadoPor ?>">
  <input type="hidden" name="accion" value="<?php echo @$accion ?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> &Aacute;rea de Desarrollo</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <label for="nombreArea">Nombre</label>
                  <input type="text" class="form-control" name="nombreArea" id="nombreArea" placeholder="Nombre(s)" value="<?php echo @$nombreArea; ?>">
                </div>

                <div class="col-sm-2">
                  <label>Activo</label>
                  <select class="form-control" name="activo" id="activo">
                    <option <?php if (@$estado == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$estado == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                  </select>
                </div>

                <div class="col-sm-12">
                    <label for="descripcionArea">Descripción</label>
                    <textarea  id="summernote" name="descripcionArea"><?php echo @$descripcionArea; ?></textarea>
                </div>


              </div>

              <?php
                if ($_POST['mod'] == 2) {
                    $sedeActiva=0;
                    ?>
                    </br>
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Nivel
                          <a class="btn btn-app" onclick="enviarParametrosGetsionUpdate('admin/nivelAreaCreate.php','1','<?php echo @$idArea ; ?>')" >
                            <i class="fas fa-plus"></i>Crear nuevo Nivel
                          </a></h3>


                      </div>
                      <div class="card-header">


                      </div>

                        <div class="card-body p-0">
                          <div class="col-sm-12">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>

                                    <th with=5%>Activo</th>
                                    <th>Nombre Represenatnte</th>
                                    <th>Cedula</th>
                                    <th>Parentesco</th>
                                    <th>Telefono</th>
                                    <th>Puede Retirar</th>

                                  </tr>
                                </thead>
                                <tbody>
                              <?php
                                foreach (@$idAreaarrayNivelesArea  as $Representante) {   //checked
                              ?>

                                    <tr>
                                      <td>
                                      <input type="checkbox" id="tarea<?php echo @$Representante['idRepresentante']; ?>" name="Representante[]" value="<?php echo @$Representante['idRepresentante']; ?>"
                                      <?php
                                      if (($_POST['mod'] == 2)&&(in_array(@$Representante['idRepresentante'], $representanteByAprendizActivos_))) {
                                        echo "checked";
                                      } ?>
                                      >
                                      </td>
                                      <td><a href="#" onclick="enviarParametrosGetsionUpdate('admin/RepresentanteCreate.php',2,'<?php echo @$Representante['idRepresentante']; ?>')" class="nav-link ">
                                          <?php echo @$Representante['apellidoRepresentante'].', '.@$Representante['nombreRepresentante']; ?></a></td>
                                      <td><?php echo @$Representante['parentescoRepresentante']; ?></td>
                                      <td><?php echo @$Representante['cedulaRepresentante']; ?></td>
                                      <td><?php echo @$Representante['telefonoRepresentante']; ?></td>
                                      <td ><?php if(@$Representante['retirarAprendiz']=='1'){echo '<span class="badge bg-success">Si</span>';}else {echo '<span class="badge bg-danger">No</span>';} ?></td>
                                    </tr>
                              <?php } ?>
                              </tbody>
                                <tfoot>
                                  <tr>
                                  <th>Activo</th>
                                    <th>Nombre Represenatnte</th>
                                    <th>Cedula</th>
                                    <th>Parentesco</th>
                                    <th>Telefono</th>
                                    <th>Puede Retirar</th>

                                  </tr>
                                </tfoot>
                              </table>
                          </div>
                        </div>
                      </div>
                    </div>
              <?php } ?>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary" ><?php echo $accion; ?></button>
              <button type="button" class="btn btn-primary" onclick="enviarParametros('admin/aprendizList.php')">Volver</button>
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

