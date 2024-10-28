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

if ($_POST['mod'] == 1) {
  $accion = "Crear";
} else {
  $accion = "Editar";

  //datos facilitador o empleado
  $idEvento = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=2&idEvento=$idEvento";
  $rs         = API::GET($URL, $token);
  $arrayEvent  = API::JSON_TO_ARRAY($rs);

  $nombreEvento = @$arrayEvent[0]['nombreEvento'];
  $idSede = @$arrayEvent[0]['idSede'];
  $descripcionEvento = @$arrayEvent[0]['descripcionEvento'];
  $lugarEvento = @$arrayEvent[0]['lugarEvento'];
  $fechaEvento = @$arrayEvent[0]['fechaEvento'];
  $envioCorreo = @$arrayEvent[0]['envioCorreo'];
  $fechaCreacion = @$arrayEvent[0]['fechaCreacion'];
  $activo = @$arrayEvent[0]['activo'];
  $creadoPor = @$arrayEvent[0]['creadoPor'];
  $flayer = @$arrayEvent[0]['flayer'];
  $organizadoPor = @$arrayEvent[0]['organizadoPor'];
  $ponentes = @$arrayEvent[0]['ponentes'];
  $tipoEvento = @$arrayEvent[0]['tipoEvento'];

  $urlImagen = @$arrayEvent[0]['flayerImg'];
  
  if ($arrayEvent[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;
}
/*******************************
 * SEDES API
 */
$UrlSede='http://taeo/funciones/wsdl/sede?type=1';
$rs         = API::GET($UrlSede, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);
//print("<pre>".print_r(($arraySede) ,true)."</pre>"); / /die;


?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Eventos</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_event.model.php" method="post" name="Usuario" id="Usuario"  enctype="multipart/form-data">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idEvento" value="<?php echo @$_POST["id"] ?>">
  <input type="hidden" name="creadoPor" value="<?php echo @$creadoPor ?>">
  <input type="hidden" name="accion" value="<?php echo @$accion ?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0"><?php echo $accion; ?> Eventos</h3>
          <?php if ($_POST['mod'] == 2) { ?>
            <button type="button" class="btn btn-warning ml-auto" id="sendEmailButton">Envio de Email para evento</button>
          <?php } ?>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nombreAprendiz">Nombre del Evento</label>
                  <input type="text" class="form-control" name="nombreEvento" id="nombreEvento" placeholder="Nombre del Evento" value="<?php echo @$nombreEvento; ?>">
                </div>

                <div class="col-sm-3">
                    <label>Fecha de Evento:</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="fechaEvento" id="fechaEvento"  value="<?php echo @$fechaEvento; ?>" />
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-3">
                  <label for="organizadoPor">Organizadora del Evento</label>
                  <input type="text" class="form-control" name="organizadoPor" id="organizadoPor" placeholder="Nombre de la Organizadora" value="<?php echo @$organizadoPor; ?>">
                </div>



                <div class="col-sm-6">
                    <label for="descripcionEvento">Descripción  del Evento</label>
                    <textarea  id="eventDesciption" name="descripcionEvento"><?php echo @$descripcionEvento; ?></textarea>
                </div>
                
                <div class="col-sm-6">
                    <label for="ponentes">Ponentes  del Evento</label>
                    <textarea  id="ponentes" name="ponentes"><?php echo @$ponentes; ?></textarea>
                </div>

                <div class="col-sm-2">
                  <label>Sede</label>
                  <select class="form-control" name="idSede" id="idSede">
                  <option >Seleccione</option>
                    <?php foreach ($arraySede as $sede) { ?>
                      <option <?php if (@$idSede == $sede['idSede']) {
                                echo 'selected';
                              } ?> value="<?php echo $sede['idSede']; ?>"><?php echo $sede['nombreSede']; ?></option>
                    <?php } ?>
 
                  </select>
                </div>

                <div class="col-sm-2">
                  <label for="envioCorreo">Desea Enviar por Correo</label>
                  <select class="form-control" name="envioCorreo" id="envioCorreo">
                    <option <?php if (@$envioCorreo == "SI") {
                              echo 'selected';
                            } ?> value="SI">Si</option>
                    <option <?php if (@$envioCorreo == "NO") {
                              echo 'selected';
                            } ?> value="NO">No</option>
                  </select>
                </div>

                <div class="col-sm-3">
                <label for="flayer">Flayer del Evento</label>
                    <input type="file" name="afiche" id="afiche" accept=".jpg, .jpeg, .png"  />
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

                <div class="col-sm-2">

                  <?php if (!isset($tipoEvento)){
                    @$tipoEvento = 'Administrativo';
                  }?>
                  <label>Tipo de Evento</label>
                  <select class="form-control" name="tipoEvento" id="tipoEvento">
                    <option <?php if (@$tipoEvento == 'Administrativo') {
                              echo 'selected';
                            } ?> value='Administrativo'>Administrativo</option>
                    <option <?php if (@$tipoEvento == 'Facilitadores') {
                              echo 'selected';
                            } ?> value='Facilitadores'>Facilitadores</option>
                    <option <?php if (@$tipoEvento == 'Sede') {
                              echo 'selected';
                            } ?> value='Sede'>Sede</option>
                  </select>
                </div>

                

                <div class="col-sm-12">
                    <label for="nombreCliente">Direccion  del Evento</label>
                    <textarea  id="direcion" name="lugarEvento"><?php echo @$lugarEvento; ?></textarea>
                </div>

                <?php 
                if(  isset($urlImagen) ){?>
                  <div class="col-sm-12">
                      <label>Imagen Actual</label>
                      <img src="<?php echo @$urlImagen; ?>" class="img-fluid" alt="Responsive image">
                </div>
                <?php }?>

              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary" ><?php echo $accion; ?></button>
              <button type="button" class="btn btn-primary" onclick="enviarParametros('event/eventList.php')">Volver</button>
              <?php if ($_POST['mod'] == 2) { ?>
                  <button type="button" class="btn btn-warning" id="sendEmailButton" >Envio de Email para evento</button>
                  <?php  } ?>
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
document.getElementById('sendEmailButton').addEventListener('click', function() {
    var idEvento = <?php echo  $idEvento ; ?>; // Reemplaza con el ID del evento correspondiente
    var apiUrl = 'http://taeo/funciones/wsdl/event?type=3&idEvento=' + idEvento;
  alert('Enviando correo...');
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'OK') {
                alert('Correo enviado exitosamente.');
            } else {
                alert('Error al enviar el correo.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar el correo.');
        });
});
</script>

