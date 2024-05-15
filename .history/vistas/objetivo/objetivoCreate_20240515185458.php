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
 function  nivel($nodoPadre,$level,$token){

  $arrayhijosNexLevel  = hijos($nodoPadre['id'], $token);
  if(count($arrayhijosNexLevel)>0)
  {?>
      <tr class="expandable-body">
      <td>
          <div class="p-0">
                  <table class="table table-hover">
                  <tbody>
                      <?php
                      //************************ INICIO DEL RECORRIDO NIVEL 2 ********************/
                      foreach($arrayhijosNexLevel as $datosArrayhijosNexLevel)
                      {?>
                      <tr data-widget="expandable-table" aria-expanded="false">
                          <td>
                          <div class="p-0">
                              <table class="table table-hover">
                              <tbody>
                                  <?php
                                  $arrayhijosN1  = hijos($datosArrayhijosNexLevel['id'], $token);

                                  if(count($arrayhijosN1)<1)
                                  {
                                  //No tiene Hijos?>
                                  <tr data-widget="expandable-table" aria-expanded="false">
                                      <td>
                                      <?php echo 'NIVEL '.$level.'- SH'.$datosArrayhijosNexLevel['id'].'-'.$datosArrayhijosNexLevel['jerarquia'].'-'.$datosArrayhijosNexLevel['descripcion'];?>
                                      </td>
                                  </tr>
                                  <?php
                                  }else
                                  {
                                  // si tiene Hijo
                                  ?>
                                  <tr data-widget="expandable-table" aria-expanded="false">
                                      <td>
                                          <button type="button" class="btn btn-primary p-0">
                                          <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                          </button>
                                          <?php echo 'NIVEL '.$level.' - CH'.$datosArrayhijosNexLevel['id'].'-'.$datosArrayhijosNexLevel['jerarquia'].'-'.$datosArrayhijosNexLevel['descripcion'];?>
                                      </td>
                                  </tr>
                                  <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                  <?php
                                    $arrayhijosNexLevelAux  = hijos($nodoPadre['id'], $token);
                                    if ($arrayhijosNexLevelAux >0){
                                        nivel($nodoPadre,$level,$token);
                                    }else{
                                      return true;
                                    }

                                  ?>
                                  <!-- /*fin  va el codigo para el siguiente nivel*/ -->
                                  <?php
                                  }?>
                              </tbody>
                              </table>
                          </div>
                          </td>
                      </tr>
                      <?php
                      }?>
                  </tbody>
                  </table>
          </div>
          </td>
      </tr>

      <?php
  }
}



if ($_POST['mod'] == 1) {
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idAprendiz=$_POST['id'];  //signifia que la creacion esta asociada a un aprendiz
  }
} else {
  $accion = "Editar";

  //datos Representante
  $idObjetivo = @$_POST["id"];

  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=1&idObjetivoHeader=$idObjetivo";
  $rs         = API::GET($URL, $token);
  $arrayHeader  = API::JSON_TO_ARRAY($rs);

  $nombreObjetivo = $arrayHeader[0]['nombreObjetivo'];
  $versionObjetivo = $arrayHeader[0]['versionObjetivo'];
  $fechaCreacion = $arrayHeader[0]['fechaCreacion'];
  $creadoPor = $arrayHeader[0]['creadoPor'];
  $activo = $arrayHeader[0]['activo'];


  if ($arrayHeader[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;

    $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=2&idObjetivoHeader=$idObjetivo";
    $rs         = API::GET($URL, $token);
    $arrayItemByHeader  = API::JSON_TO_ARRAY($rs);

}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Objetivos</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_objetivos.model.php" method="post" name="objetivo" id="objetivo">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idObjetivo" value="<?php echo @$idObjetivo; ?>">

  <input type="hidden" name="idAprendiz" value="<?php echo @$idAprendiz;?>">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Objetivos</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nombreRepresentante">Nombre</label>
                  <input type="text" class="form-control" name="nombreObjetivo" id="nombreObjetivo" placeholder="Nombre(s)" value="<?php echo @$nombreObjetivo; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="apellidoRepresentante">versionObjetivo</label>
                  <input type="text" class="form-control" name="versionObjetivo" id="versionObjetivo" placeholder="version(s)" value="<?php echo @$versionObjetivo; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="cedulaRepresentante">fechaCreacion</label>
                  <input type="text" class="form-control" readonly name="fechaCreacion" id="fechaCreacion" placeholder="fechaCreacion" value="<?php echo @$fechaCreacion; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="telefonoRepresentante">creadoPor</label>
                  <input type="text" class="form-control" name="creadoPor" id="creadoPor" placeholder="creadoPor" value="<?php echo @$creadoPor; ?>">
                </div>


                <div class="col-sm-2">
                  <label>Activo</label>
                  <select class="form-control" name="activo" id="activo">
                    <option <?php if (@$activo == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$activo == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                  </select>
                </div>

                <div class="col-sm-12">
                <table class="table table-hover">
                  <tbody>

                    <?php

function  hijos ($padre, $token){
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=3&id_padre=".$padre;
                        $rs         = API::GET($URL, $token);
                        $arrayhijos  = API::JSON_TO_ARRAY($rs);
                        $banderaNodoPadre=false;
                        return $arrayhijos;
}


                      //busca cuantos padres tiene el objetivo
                      $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=2&idHeader=$idObjetivo";
                      $rs         = API::GET($URL, $token);
                      $arrayNodoPadre  = API::JSON_TO_ARRAY($rs);
                      $banderaNodoPadre=false;

                      //recorre los padres uno a uno
                      //************************ INICIO DEL RECORRIDO NIVEL 1 (padre) ********************/
                      foreach($arrayNodoPadre as $datosNodoPadre)
                      {

                        //BUSCA LOS HIJOS DEL PRIMER PADRE
                        $arrayhijos  = hijos($datosNodoPadre['id'], $token);

                        //imprime el Primer NODO padre
                        echo'<tr data-widget="expandable-table" aria-expanded="false"><td>NIVEL 1 - ';

                        if(count($arrayhijos)>0){//imprime el botonpara desplegar los hijos
                              echo '<button type="button" class="btn btn-primary p-0"><i class="expandable-table-caret fas fa-caret-right fa-fw"></i></button>';}
                        echo $datosNodoPadre['jerarquia'].'-'.$datosNodoPadre['descripcion'].'</td></tr>';



                        if(count($arrayhijos)>0)
                        {?>

                          <tr class="expandable-body">
                            <td>
                                <div class="p-0">
                                      <table class="table table-hover">
                                        <tbody>
                                          <?php
                                          //************************ INICIO DEL RECORRIDO NIVEL 2 ********************/
                                          foreach($arrayhijos as $datosArrayhijos)
                                          {?>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                              <td>
                                                <div class="p-0">
                                                  <table class="table table-hover">
                                                    <tbody>
                                                      <?php
                                                      $arrayhijosN1  = hijos($datosArrayhijos['id'], $token);

                                                      if(count($arrayhijosN1)<1)
                                                      {
                                                        //No tiene Hijos?>
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                          <td>
                                                            <?php echo 'NIVEL 2- SH'.$datosArrayhijos['id'].'-'.$datosArrayhijos['jerarquia'].'-'.$datosArrayhijos['descripcion'];?>
                                                          </td>
                                                        </tr>
                                                        <?php
                                                      }else
                                                      {
                                                        // si tiene Hijo
                                                        ?>
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                          <td>
                                                              <button type="button" class="btn btn-primary p-0">
                                                                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                              </button>
                                                              <?php echo 'NIVEL 2 - CH'.$datosArrayhijos['id'].'-'.$datosArrayhijos['jerarquia'].'-'.$datosArrayhijos['descripcion'];?>
                                                          </td>
                                                        </tr>
                                                        <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                        <?php
                                                          //nivel($datosArrayhijos,3,$token)
                                                          $arrayhijosN2  = hijos($datosArrayhijos['id'], $token);
                                                           if(count($arrayhijosN2)>0)
                                                           {?>
                                                             <tr class="expandable-body">
                                                               <td>
                                                                   <div class="p-0">
                                                                         <table class="table table-hover">
                                                                           <tbody>
                                                                             <?php
                                                                             //************************ INICIO DEL RECORRIDO NIVEL 2 ********************/
                                                                             foreach($arrayhijosN2 as $datosArrayhijosN3)
                                                                             {?>
                                                                               <tr data-widget="expandable-table" aria-expanded="false">
                                                                                 <td>
                                                                                   <div class="p-0">
                                                                                     <table class="table table-hover">
                                                                                       <tbody>
                                                                                         <?php
                                                                                         $arrayhijosN3  = hijos($datosArrayhijosN3['id'], $token);

                                                                                         if(count($arrayhijosN3)<1)
                                                                                         {
                                                                                           //No tiene Hijos?>
                                                                                           <tr data-widget="expandable-table" aria-expanded="false">
                                                                                             <td>
                                                                                               <?php echo 'NIVEL 3- SH'.$datosArrayhijosN3['id'].'-'.$datosArrayhijosN3['jerarquia'].'-'.$datosArrayhijosN3['descripcion'];?>
                                                                                             </td>
                                                                                           </tr>
                                                                                           <?php
                                                                                         }else
                                                                                         {
                                                                                           // si tiene Hijo
                                                                                           ?>
                                                                                           <tr data-widget="expandable-table" aria-expanded="false">
                                                                                             <td>
                                                                                                 <button type="button" class="btn btn-primary p-0">
                                                                                                   <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                                                                 </button>
                                                                                                 <?php echo 'NIVEL 3 - CH'.$datosArrayhijosN3['id'].'-'.$datosArrayhijosN3['jerarquia'].'-'.$datosArrayhijosN3['descripcion'];?>
                                                                                             </td>
                                                                                           </tr>
                                                                                           <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                           <?php

                                                                                          nivel($datosArrayhijosN3,4,$token)
                                                                                           ?>
                                                                                           <!-- /*fin  va el codigo para el siguiente nivel*/ -->
                                                                                           <?php
                                                                                         }?>
                                                                                       </tbody>
                                                                                     </table>
                                                                                   </div>
                                                                                 </td>
                                                                               </tr>
                                                                               <?php
                                                                             }?>
                                                                           </tbody>
                                                                         </table>
                                                                   </div>
                                                                 </td>
                                                             </tr>

                                                             <?php
                                                           }
                                                        ?>
                                                        <!-- /*fin  va el codigo para el siguiente nivel*/ -->
                                                        <?php
                                                      }?>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </td>
                                            </tr>
                                            <?php
                                          }?>
                                        </tbody>
                                      </table>
                                </div>
                              </td>
                          </tr>

                          <?php
                        }
                      } ?>





                  </tbody>
                  </table>
                </div>
              </div>

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


