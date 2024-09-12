<table class="table table-hover">
    <tbody>

      <?php
        function  hijos ($idPlanificacionHeader,$jerarquia,$token){
          $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/planning?type=6&idPlanificacionHeader=$idPlanificacionHeader&jerarquia=$jerarquia";

                    $rs         = API::GET($URL, $token);
                    $arrayhijos  = API::JSON_TO_ARRAY($rs);

                    $banderaNodoPadre=false;
                    return $arrayhijos;
        }

        function  nivel($nodoPadre,$level,$token,$idObjetivoHeader){
//print_r($nodoPadre); die;

          $arrayhijosNexLevel  = hijos($nodoPadre['idPlanificacionHeader'], $nodoPadre['jerarquia'], $token);
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
                                          $arrayhijosN1  = hijos($nodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                          $variable=$datosArrayhijosNexLevel['idItems'].'-'. @$idObjetivoHeader;

                                          if(count($arrayhijosN1)<1)
                                          {
                                          //No tiene Hijos?>
                                          <tr data-widget="expandable-table" aria-expanded="false">
                                              <td>
                                              <?php echo ' '.$datosArrayhijosNexLevel['jerarquia'].' - '.$datosArrayhijosNexLevel['descripcion'];?>
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
                                                  <?php echo ' '.$datosArrayhijosNexLevel['jerarquia'].' - '.$datosArrayhijosNexLevel['descripcion'];?>
                                              </td>
                                          </tr>
                                          <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                          <?php


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

        //busca cuantos padres tiene el objetivo
        $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/planning?type=5&idPlanificacionHeader=$idObjetivoHeader";
        $rs         = API::GET($URL, $token);
        $arrayNodoPadre  = API::JSON_TO_ARRAY($rs);
        $banderaNodoPadre=false;



        //recorre los padres uno a uno
        //************************ INICIO DEL RECORRIDO NIVEL 1 (padre) ********************/
        foreach($arrayNodoPadre as $datosNodoPadre)
        {

          //BUSCA LOS HIJOS DEL PRIMER PADRE

          $arrayhijos  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosNodoPadre['jerarquia'], $token);


          //print_r($arrayhijos); die;
          //imprime el Primer NODO padre
          echo'<tr data-widget="expandable-table" aria-expanded="false"><td>';

          $variable=$datosNodoPadre['idItems'].'-'. @$idObjetivoHeader;

          if(count($arrayhijos)>0){//imprime el botonpara desplegar los hijos
                echo '<button type="button" class="btn btn-primary p-0"><i class="expandable-table-caret fas fa-caret-right fa-fw"></i></button>';}
          echo ' '.$datosNodoPadre['jerarquia'].' - '.$datosNodoPadre['descripcion'].'</td></tr>';



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
                                        $arrayhijosN1  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijos['jerarquia'], $token); //hijos($datosArrayhijos['idItems'],'01.01', $token);
                                        $variable=$datosArrayhijos['idItems'].'-'. @$idObjetivoHeader;

                                        if(count($arrayhijosN1)<1)
                                        {
                                          //No tiene Hijos?>
                                          <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>
                                              <?php echo ' '.$datosArrayhijos['jerarquia'].' - '.$datosArrayhijos['descripcion'];?>
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
                                                <?php echo ' '.$datosArrayhijos['jerarquia'].' - '.$datosArrayhijos['descripcion'];?>
                                            </td>
                                          </tr>
                                          <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                          <?php
                                          // nivel($datosArrayhijos,3,$token)
                                            //$arrayhijosN2  = hijos($datosArrayhijos['id'], $token);
                                            $arrayhijosN2  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijos['jerarquia'], $token);
                                            if(count($arrayhijosN2)>0)
                                            {?>
                                              <tr class="expandable-body">
                                                <td>
                                                    <div class="p-0">
                                                          <table class="table table-hover">
                                                            <tbody>
                                                              <?php
                                                              //************************ INICIO DEL RECORRIDO NIVEL 3 ********************/
                                                              foreach($arrayhijosN2 as $datosArrayhijosN3)
                                                              {?>
                                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                                  <td>
                                                                    <div class="p-0">
                                                                      <table class="table table-hover">
                                                                        <tbody>
                                                                          <?php
                                                                          //$arrayhijosN3  = hijos($datosArrayhijosN3['id'], $token);
                                                                          $arrayhijosN3  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosN3['jerarquia'], $token);
                                                                          $variable=$datosArrayhijosN3['idItems'].'-'. @$idObjetivoHeader;


                                                                          if(count($arrayhijosN3)<1)
                                                                          {
                                                                            //No tiene Hijos?>
                                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                              <td>
                                                                                <?php echo ' '.$datosArrayhijosN3['jerarquia'].' - '.$datosArrayhijosN3['descripcion'];?>
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
                                                                                  <?php echo ' '.$datosArrayhijosN3['jerarquia'].' - '.$datosArrayhijosN3['descripcion'];?>
                                                                              </td>
                                                                            </tr>
                                                                            <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                            <?php

                                                                              $arrayhijosNexLevel  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosN3['jerarquia'], $token);
                                                                              if(count($arrayhijosNexLevel)>0)
                                                                              {?>
                                                                                  <tr class="expandable-body">
                                                                                  <td>
                                                                                      <div class="p-0">
                                                                                              <table class="table table-hover">
                                                                                              <tbody>
                                                                                                  <?php
                                                                                                  //************************ INICIO DEL RECORRIDO NIVEL 4 ********************/
                                                                                                  foreach($arrayhijosNexLevel as $datosArrayhijosNexLevel)
                                                                                                  {?>
                                                                                                  <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                      <td>
                                                                                                      <div class="p-0">
                                                                                                          <table class="table table-hover">
                                                                                                          <tbody>
                                                                                                              <?php
                                                                                                              $arrayhijosN1  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                              $variable=$datosArrayhijosNexLevel['idItems'].'-'. @$idObjetivoHeader;

                                                                                                              if(count($arrayhijosN1)<1)
                                                                                                              {
                                                                                                              //No tiene Hijos?>
                                                                                                              <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                  <td>
                                                                                                                  <?php echo ' '.$datosArrayhijosNexLevel['jerarquia'].' - '.$datosArrayhijosNexLevel['descripcion'].'
                                                                                                                  (
                                                                                                                    <a href="#"
                                                                                                                    onclick="enviarParametrosGetsionUpdate(\'objetivo/itemCreate.php\',2,\''.$variable.'\')"
                                                                                                                    ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>

                                                                                                                  )
                                                                                                                  ';?>
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
                                                                                                                      <?php echo ' '.$datosArrayhijosNexLevel['jerarquia'].' - '.$datosArrayhijosNexLevel['descripcion'].'
                                                                                                                  (
                                                                                                                    <a href="#"
                                                                                                                    onclick="enviarParametrosGetsionUpdate(\'objetivo/itemCreate.php\',2,\''.$variable.'\')"
                                                                                                                    ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>

                                                                                                                  )
                                                                                                                  ';?>
                                                                                                                  </td>
                                                                                                              </tr>
                                                                                                              <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                                              <?php
                                                                                                              nivel($datosArrayhijosNexLevel,5,$token,$idObjetivoHeader);

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
