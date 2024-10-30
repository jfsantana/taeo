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
//print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;
if($_SESSION['ponderacion']<40)
  $disabled='';
else
  $disabled='disabled';

  
if ($_POST['mod'] == 1) {
  $accion = "Crear";
  $flagImagen = 0;
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

  $fechaEventoDateTime = new DateTime($fechaEvento);
  $fechaActualDateTime = new DateTime();
  if ($fechaEventoDateTime > $fechaActualDateTime) {
    $enableBottonEnvioCorreo = '';
} else {
    $enableBottonEnvioCorreo = 'disabled';
}
 
  if ($urlImagen != null) {
    $flagImagen = 1;
    $flayerImgAux=@$arrayEvent[0]['flayerImg'];
    $flayerNameAux=@$arrayEvent[0]['flayerName'];
    $flayerTipoAux=@$arrayEvent[0]['flayerTipo'];
    
  } else {
    $flagImagen = 0;
  }

    // Convertir la fecha al formato deseado
    $fechaEventoObj = new DateTime($fechaEvento);
    $fechaEventoFormateada = $fechaEventoObj->format('m/d/Y g:i A');
  
  if ($arrayEvent[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;
}
/*******************************
 * SEDES API
 */
$UrlSede= "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1";
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
  <input type="hidden" name="flagImagen" value="<?php echo @$flagImagen ?>"> <!--//si es 1 es porque ya tiene imagen -->
  <?php   if (@$flagImagen == 1) {  ?>
    <input type="hidden" name="flayerImgAux" value="<?php echo @$flayerImgAux ?>"> <!--//si es 1 es porque ya tiene imagen -->
    <input type="hidden" name="flayerNameAux" value="<?php echo @$flayerNameAux ?>"> <!--//si es 1 es porque ya tiene imagen -->
    <input type="hidden" name="flayerTipoAux" value="<?php echo @$flayerTipoAux ?>"> <!--//si es 1 es porque ya tiene imagen -->
  <?php }   ?>
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0"><?php echo $accion; ?> Eventos</h3>
          <?php if ($_SESSION['ponderacion'] < 40) { //Solo Administradores    ?>
          <?php if ($_POST['mod'] == 2) { ?>
            <button type="button" class="btn btn-warning ml-auto" id="sendEmailButton" <?php echo $enableBottonEnvioCorreo; ?> >Envio de Email para evento</button>
          <?php } ?>
          <?php } ?>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nombreAprendiz">Nombre del Evento</label>
                  <input type="text" class="form-control" name="nombreEvento" id="nombreEvento" placeholder="Nombre del Evento" value="<?php echo @$nombreEvento; ?>" required <?php echo $disabled; ?>>
                </div>

                <div class="col-sm-3">
                    <label>Fecha de Evento:</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="fechaEvento" id="fechaEvento"  value="<?php echo @$fechaEventoFormateada; ?>" required <?php echo $disabled; ?>/>
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-3">
                  <label for="organizadoPor">Organizadora del Evento</label>
                  <input type="text" class="form-control" name="organizadoPor" id="organizadoPor" placeholder="Nombre de la Organizadora" value="<?php echo @$organizadoPor; ?>" required <?php echo $disabled; ?>>
                </div>



                <div class="col-sm-6">
                    <label for="descripcionEvento">Descripción  del Evento</label>
                    <?php if($_SESSION['ponderacion']<40){?>
                      <textarea  id="eventDesciption" name="descripcionEvento" required <?php echo $disabled; ?>><?php echo @$descripcionEvento; ?></textarea>
                    <?php }else {
                       echo @$descripcionEvento;
                    }?>
                    
                </div>
                
                <div class="col-sm-6">
                    <label for="ponentes">Ponentes  del Evento</label>
                    <?php if($_SESSION['ponderacion']<40){?>
                      <textarea  id="ponentes" name="ponentes" required><?php echo @$ponentes; ?></textarea>
                    <?php }else {
                       echo @$ponentes;
                    }?>
                    
                </div>

                <div class="col-sm-2">
                  <label>Sede</label>
                  <div class="form-group">
                    <?php 
                        // Asegurarse de que $idSede sea un array
                    if (!is_array(@$idSede)) {
                      @$idSede = explode(',', @$idSede);
                    }
                    foreach ($arraySede as $sede) { ?>
                      <div class="custom-control custom-checkbox">
                        <input  type="checkbox" 
                                class="custom-control-input"
                                id="sede_<?php echo $sede['idSede']; ?>" 
                                name="idSede[]" 
                                value="<?php echo $sede['idSede']; ?>" 
                                <?php echo $disabled; ?>
                                <?php if (in_array($sede['idSede'], (array)@$idSede)) { echo 'checked'; } ?>
                          >
                        <label class="custom-control-label" for="sede_<?php echo $sede['idSede']; ?>"><?php echo $sede['nombreSede']; ?></label>
                      </div>
                    <?php } ?>
                  </div>
                </div>

                <div class="col-sm-2">
                  <label for="envioCorreo">Desea Enviar por Correo</label>
                  <select class="form-control" name="envioCorreo" id="envioCorreo" <?php echo $disabled; ?>>
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
                    <input type="file" name="afiche" id="afiche" accept=".jpg, .jpeg, .png"  <?php echo $disabled; ?>/>
                </div>

                <div class="col-sm-2">
                  <label>Activo</label>
                  <select class="form-control" name="activo" id="activo" <?php echo $disabled; ?>>
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
                  <select class="form-control" name="tipoEvento" id="tipoEvento" <?php echo $disabled; ?>>
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
                    <?php if($_SESSION['ponderacion']<40){?>
                      <textarea  id="direcion" name="lugarEvento"><?php echo @$lugarEvento; ?></textarea>
                    <?php }else {
                       echo @$lugarEvento;
                    }?>
                    
                </div>

                <?php 
                if(  (isset($urlImagen))&&($urlImagen!=null) ){?>
                  <div class="col-sm-12">
                      <label>Imagen Actual</label>
                      <img src="<?php echo @$urlImagen; ?>" class="img-fluid" alt="Responsive image">
                </div>
                <?php }?>

              </div>

            </div>

            
            <div class="card-footer">
              <?php if ($_SESSION['ponderacion'] < 40) { //Solo Administradores    ?>
                <button type="submit" class="btn btn-primary" ><?php echo $accion; ?></button>
              <?php }?>

              <button type="button" class="btn btn-primary" onclick="enviarParametros('event/eventList.php')">Volver</button>
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
    var apiUrl = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/funciones/wsdl/event?type=3&idEvento=' + idEvento;
  alert("Enviando correo esto podra tardar unos minutos. Espere el mensaje de confirmaación antes de salir de esta pagina.");
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

