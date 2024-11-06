<table class="table table-hover">
    <tbody>

      <?php

        //busca cuantos padres tiene el objetivo
        $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/objetivo?type=2&idHeader=$idObjetivoHeader&maxVersion=$maxVersion";
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
          echo'<tr data-widget="expandable-table" aria-expanded="false"><td>';

          $variable=$datosNodoPadre['id'].'-'. @$idObjetivoHeader;

          if(count($arrayhijos)>0){//imprime el botonpara desplegar los hijos
                echo '<button type="button" class="btn btn-primary p-0"><i class="expandable-table-caret fas fa-caret-right fa-fw"></i></button>';}
          echo ' '.$datosNodoPadre['jerarquia'].' - '.$datosNodoPadre['descripcion'].'
              (
                <a href="#"
                onclick="enviarParametrosGetsionUpdate(\'objetivo/itemCreate.php\',2,\''.$variable.'\')"
                ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>

              )</td></tr>';



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
                                        $variable=$datosArrayhijos['id'].'-'. @$idObjetivoHeader;

                                        if(count($arrayhijosN1)<1)
                                        {
                                          //No tiene Hijos?>
                                          <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>
                                              <?php echo ' '.$datosArrayhijos['jerarquia'].' - '.$datosArrayhijos['descripcion'].'
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
                                                <?php echo ' '.$datosArrayhijos['jerarquia'].' - '.$datosArrayhijos['descripcion'].'
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
                                          // nivel($datosArrayhijos,3,$token)
                                            $arrayhijosN2  = hijos($datosArrayhijos['id'], $token);
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
                                                                          $arrayhijosN3  = hijos($datosArrayhijosN3['id'], $token);
                                                                          $variable=$datosArrayhijosN3['id'].'-'. @$idObjetivoHeader;

                                                                          if(count($arrayhijosN3)<1)
                                                                          {
                                                                            //No tiene Hijos?>
                                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                              <td>
                                                                                <?php echo ' '.$datosArrayhijosN3['jerarquia'].' - '.$datosArrayhijosN3['descripcion'].'
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
                                                                                  <?php echo ' '.$datosArrayhijosN3['jerarquia'].' - '.$datosArrayhijosN3['descripcion'].'
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

                                                                              $arrayhijosNexLevel  = hijos($datosArrayhijosN3['id'], $token);
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
                                                                                                              $arrayhijosN1  = hijos($datosArrayhijosNexLevel['id'], $token);
                                                                                                              $variable=$datosArrayhijosNexLevel['id'].'-'. @$idObjetivoHeader;

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
