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

  //datos facilitador o empleado
  $idAprendiz = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/aprendiz?type=1&idAprendiz=$idAprendiz";
  $rs         = API::GET($URL, $token);
  $arrayUsuario  = API::JSON_TO_ARRAY($rs);

  $nombreAprendiz = $arrayUsuario[0]['nombreAprendiz'];
  $apellidoAprendiz = $arrayUsuario[0]['apellidoAprendiz'];
  $cedulaAprendiz = $arrayUsuario[0]['cedulaAprendiz'];
  $fechaNacimientoAprendiz = $arrayUsuario[0]['fechaNacimientoAprendiz'];
  $colegioAprendiz = $arrayUsuario[0]['colegioAprendiz'];
  $gradoAprendiz = $arrayUsuario[0]['gradoAprendiz'];
  $escolaridadAprendiz = $arrayUsuario[0]['escolaridadAprendiz'];
  $direccionAprendiz = $arrayUsuario[0]['direccionAprendiz'];
  $paisAprendiz = $arrayUsuario[0]['paisAprendiz'];
  $ciudadAprendiz = $arrayUsuario[0]['ciudadAprendiz'];
  $coordinadoraAprendiz = $arrayUsuario[0]['coordinadoraAprendiz'];
  $facilitadoraAprendiz = $arrayUsuario[0]['facilitadoraAprendiz'];
  $activoAprendiz = $arrayUsuario[0]['activoAprendiz'];
  $creadoPor = $arrayUsuario[0]['creadoPor'];
  $fechaCreacion = $arrayUsuario[0]['fechaCreacion'];


//Lista de Representantes Activos  del Aprendiz
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/aprendiz?type=2&idAprendiz=$idAprendiz";//$idAprendiz
$rs         = API::GET($URL1, $token);
$arrayRepresentanteByAprendiz  = API::JSON_TO_ARRAY($rs);


  //Lista de Representantes Activos  del Aprendiz
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/aprendiz?type=2&idAprendiz=$idAprendiz";//$idAprendiz
  $rs         = API::GET($URL1, $token);
  $arrayRepresentanteByAprendizActivos  = API::JSON_TO_ARRAY($rs);
  $representanteByAprendizActivos='';

  foreach ($arrayRepresentanteByAprendizActivos  as $representanteByAprendizActivosDato) {
    $representanteByAprendizActivos=$representanteByAprendizActivos.$representanteByAprendizActivosDato['idRepresentante'].',';
  }
  //representantes activos
  $representanteByAprendizActivos = substr($representanteByAprendizActivos, 0, strlen($representanteByAprendizActivos) - 1);

  if ($arrayUsuario[0]['activoAprendiz'] == 1)
    $estado = 1;
  else
    $estado = 0;


   //var_dump($representanteByAprendizActivos);

}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Aprendiz</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_aprendiz.model.php" method="post" name="Usuario" id="Usuario">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idAprendiz" value="<?php echo @$idAprendiz ?>">
  <input type="hidden" name="creadoPor" value="<?php echo @$creadoPor ?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Aprendiz</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <label for="nombreAprendiz">Nombre</label>
                  <input type="text" class="form-control" name="nombreAprendiz" id="nombreAprendiz" placeholder="Nombre(s)" value="<?php echo @$nombreAprendiz; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="apellidoAprendiz">Apellido</label>
                  <input type="text" class="form-control" name="apellidoAprendiz" id="apellidoAprendiz" placeholder="Apellido(s)" value="<?php echo @$apellidoAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="cedulaAprendiz">Cedula</label>
                  <input type="text" class="form-control" name="cedulaAprendiz" id="cedulaAprendiz" placeholder="Cedula del Personal" value="<?php echo @$cedulaAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="fechaNacimientoAprendiz">Fecha de Nacimiento</label>
                  <input type="text" class="form-control" name="fechaNacimientoAprendiz" id="fechaNacimientoAprendiz" placeholder="Fecha de Nacimiento" value="<?php echo @$fechaNacimientoAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="colegioAprendiz">Colegio</label>
                  <input type="text" class="form-control" name="colegioAprendiz" id="colegioAprendiz" placeholder="Colegio (si aplica)" value="<?php echo @$colegioAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="gradoAprendiz">Grado de escolaridad cuando se ingreso</label>
                  <input type="text" class="form-control" name="gradoAprendiz" id="gradoAprendiz" placeholder="Grado de escolaridad" value="<?php echo @$gradoAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="escolaridadAprendiz">Escolaridad</label>
                  <select class="form-control" name="escolaridadAprendiz" id="escolaridadAprendiz">
                    <option <?php if (@$escolaridadAprendiz == 1) {
                              echo 'selected';
                            } ?> value=1>Si</option>
                    <option <?php if (@$escolaridadAprendiz == 0) {
                              echo 'selected';
                            } ?> value=0>No</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <label for="direccionAprendiz">direccionAprendiz</label>
                  <input type="text" class="form-control" name="direccionAprendiz" id="direccionAprendiz" placeholder="direccion Aprendiz" value="<?php echo @$direccionAprendiz; ?>">
                </div>


                <div class="col-sm-3">
                  <label for="paisAprendiz">paisAprendiz</label>
                  <select class="form-control" name="paisAprendiz" id="paisAprendiz">
                    <option <?php if (@$paisAprendiz == 1) {
                              echo 'selected';
                            } ?> value='Chile'>Chile</option>
                    <option <?php if (@$paisAprendiz == 0) {
                              echo 'selected';
                            } ?> value='Venezuela'>Venezuela</option>
                  </select>
                </div>



                <div class="col-sm-3">
                  <label for="ciudadAprendiz">ciudadAprendiz</label>
                  <input type="text" class="form-control" name="ciudadAprendiz" id="ciudadAprendiz" placeholder="ciudad Aprendiz" value="<?php echo @$ciudadAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="coordinadoraAprendiz">coordinadoraAprendiz</label>
                  <input type="text" class="form-control" name="coordinadoraAprendiz" id="coordinadoraAprendiz" placeholder="coordinadora Aprendiz" value="<?php echo @$coordinadoraAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="facilitadoraAprendiz">facilitadoraAprendiz</label>
                  <input type="text" class="form-control" name="facilitadoraAprendiz" id="facilitadoraAprendiz" placeholder="facilitadora Aprendiz" value="<?php echo @$facilitadoraAprendiz; ?>">
                </div>



                <div class="col-sm-2">
                  <label>Activo</label>
                  <select class="form-control" name="activoAprendiz" id="activoAprendiz">
                    <option <?php if (@$estado == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$estado == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                  </select>
                </div>
              </div>

              <?php
               $sedeActiva=0;
               if(isset($representanteByAprendizActivos)){
               //echo 'valor:'.@$SedeFacilitador;
               $representanteByAprendizActivos_ = explode(",", @$representanteByAprendizActivos);
              }
              // $arrayRepresentanteByAprendiz  = API::JSON_TO_ARRAY($rs);
              // representanteByAprendizActivos
              ?>


              <div class="row">
                <div class="col-sm-2">
                    <label>Representantes</label><br>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>

                          <th>Nombre Aprendiz</th>
                          <th>Fecha de Nacimiento</th>
                          <th>Activo</th>

                        </tr>
                      </thead>
                      <tbody>
                    <?php
                      foreach ($arrayRepresentanteByAprendiz  as $Representante) {   //checked
                    ?>

<tr>
                            <td><a href="#" onclick="enviarParametrosGetsionUpdate('admin/aprendizCreate.php',2,'<?php echo $Clinete['idAprendiz']; ?>')" class="nav-link "><?php echo $Clinete['apellidoAprendiz'].', '.$Clinete['nombreAprendiz']; ?></a></td>
                            <?php
                            $fecha_nacimiento = $Clinete['fechaNacimientoAprendiz'];
                            $fecha_actual = date("Y-m-d H:i:s");

                            $timestamp_nacimiento = strtotime($fecha_nacimiento);
                            $timestamp_actual = strtotime($fecha_actual);

                            $diferencia = abs($timestamp_actual - $timestamp_nacimiento);

                            $anios = floor($diferencia / (365 * 60 * 60 * 24));
                            $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));


                            ?>
                            <td><?php echo $anios . " años, " . $meses . " meses"; ?></td>
                            <td><?php echo $Clinete['estado']; ?></td>
                          </tr>




                        <input type="checkbox" id="tarea<?php echo $Representante['idRepresentante']; ?>" name="Representante[]" value="<?php echo $Representante['idRepresentante']; ?>"
                        <?php
                             if (($_POST['mod'] == 2)&&(in_array($Representante['idRepresentante'], $representanteByAprendizActivos_))) {
                               echo "checked";
                             }
                        ?>

                        >
                        <label for="tarea<?php echo $Representante['idRepresentante']; ?>"><?php echo $Representante['nombreRepresentante']; ?></label><br>
                    <?php } ?>
                    </tbody>
                      <tfoot>
                        <tr>

                        <th>Nombre Aprendiz</th>
                          <th>Fecha de Nacimiento</th>
                          <th>Activo</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>

            </div>

            <div class="card-footer">
              <button type="button" class="btn btn-primary" onclick="validarCheckbox()"><?php echo $accion; ?></button>
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
