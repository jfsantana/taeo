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

        function  nivel4($nodoPadre,$level,$token,$idObjetivoHeader){

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
                                              <?php 
                                                $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'].'
                                                                                                                  (
                                                                                                                    <a href="#"
                                                                                                                    onclick="enviarParametrosGetsionUpdate(\'evaluacion/evaluacionItemCreate.php\',1,\''.$variable.'\')"
                                                                                                                    ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>
                                                                                                                  )
                                                                                                                  ';
                                              ?>
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
                                                  <?php 
                                                    $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                    echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                  ?>
                                              </td>
                                          </tr>
                                          <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                          <?php
                    /* tengo que agregar el codigo para DOS NIVELES MAS ABAJO ESO FALTA*/ 

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

        function  nivel($nodoPadre,$level,$token,$idObjetivoHeader){

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
                                              <?php 
                                                $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                              ?>
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
                                                  <?php 
                                                    $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                    echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                  ?>
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

        //busca todos los nodos padres registrados en la planificaicon
        $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/planning?type=5&idPlanificacionHeader=$idObjetivoHeader";
        $rs         = API::GET($URL, $token);
        $arrayNodoPadre  = API::JSON_TO_ARRAY($rs);        
        //print("<pre>".print_r(($arrayNodoPadre),true)."</pre>");die;
        $banderaNodoPadre=false;



        //recorre los padres uno a uno
        //************************ INICIO DEL RECORRIDO NIVEL 1 (padre) ********************/
        foreach($arrayNodoPadre as $datosNodoPadre)
        {
          //print("<pre>".print_r(($datosNodoPadre),true)."</pre>");
          //BUSCA LOS HIJOS DEL PRIMER PADRE
          $arrayhijos  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosNodoPadre['jerarquia'], $token);
          //print("<pre>".print_r(($arrayhijos),true)."</pre>");die;

          
          //imprime el Primer NODO padre
          echo'<tr data-widget="expandable-table" aria-expanded="false"><td>';
          $variable=$datosNodoPadre['idItems'].'-'. @$idObjetivoHeader;
  
          if(count($arrayhijos)>0){//imprime el botonpara desplegar los hijos
            echo '<button type="button" class="btn btn-primary p-0"><i class="expandable-table-caret fas fa-caret-right fa-fw"></i></button>';
          }
          //se elimino la jerarquia
          echo ' '.$datosNodoPadre['descripcion'].'</td></tr>';

          if(count($arrayhijos)>0)
          {?>
            <tr class="expandable-body">
              <td>
                  <div class="p-0">
                        <table class="table table-hover">
                          <tbody>
                            <?php
                            //************************ INICIO DEL RECORRIDO NIVEL 1 ********************/
                            foreach($arrayhijos as $datosArrayhijos)
                            {
                             // print("<pre>".print_r(($datosArrayhijos),true)."</pre>");die;
                             ?>
                              <tr data-widget="expandable-table" aria-expanded="false">
                                <td>
                                  <div class="p-0">
                                    <table class="table table-hover">
                                      <tbody>
                                        <?php
                                        $arrayhijosN1  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijos['jerarquia'], $token); //hijos($datosArrayhijos['idItems'],'01.01', $token);
                                        //print("<pre>".print_r(($arrayhijosN1),true)."</pre>");die;
                                        $variable=$datosArrayhijos['idItems'].'-'. @$idObjetivoHeader;

                                        if(count($arrayhijosN1)<1)
                                        {
                                          //CUANDO NO  TIENE NODOS HIJOS?>
                                          <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>
                                              <?php 
                                                $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijos['jerarquia']);
                                                echo ' ' . $jerarquia . ' - ' . $datosArrayhijos['descripcion'].'
                                                                                                                  (
                                                                                                                    <a href="#"
                                                                                                                    onclick="enviarParametrosGetsionUpdate(\'evaluacion/evaluacionItemCreate.php\',1,\''.$variable.'\')"
                                                                                                                    ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>
                                                                                                                  )
                                                                                                                  ';
                                              ?>
                                            </td>
                                          </tr>
                                          <?php
                                        }else
                                        {
                                          // CUANDO SI TIENE HIJOS
                                          ?>
                                          <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>
                                                <button type="button" class="btn btn-primary p-0">
                                                  <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                </button>
                                                <?php 
                                                  $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijos['jerarquia']);
                                                  echo ' ' . $jerarquia . ' - ' . $datosArrayhijos['descripcion'];
                                                ?>
                                            </td>
                                          </tr>
                                          
                                          <?php
                                            $arrayhijosN2  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijos['jerarquia'], $token);
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
                                                                          //$arrayhijosN3  = hijos($datosArrayhijosN3['id'], $token);
                                                                          $arrayhijosN2  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosN3['jerarquia'], $token);
                                                                          $variable=$datosArrayhijosN3['idItems'].'-'. @$idObjetivoHeader;

                                                                          if(count($arrayhijosN2)<1)
                                                                          {
                                                                            //No tiene Hijos?>
                                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                              <td>
                                                                                <?php 
                                                                                  $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosN3['jerarquia']);
                                                                                  echo ' ' . $jerarquia . ' - ' . $datosArrayhijosN3['descripcion'].'
                                                                                                                  (
                                                                                                                    <a href="#"
                                                                                                                    onclick="enviarParametrosGetsionUpdate(\'evaluacion/evaluacionItemCreate.php\',1,\''.$variable.'\')"
                                                                                                                    ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>
                                                                                                                  )
                                                                                                                  ';
                                                                                //echo ' '.$datosArrayhijosN3['jerarquia'].' - '.$datosArrayhijosN3['descripcion'];
                                                                                ?>
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
                                                                                  <?php 
                                                                                   $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosN3['jerarquia']);
                                                                                   echo ' ' . $jerarquia . ' - ' . $datosArrayhijosN3['descripcion'];
                                                                                  //echo ' '.$datosArrayhijosN3['jerarquia'].' - '.$datosArrayhijosN3['descripcion'];
                                                                                  ?>
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
                                                                                                  //************************ INICIO DEL RECORRIDO NIVEL 3 ********************/
                                                                                                  foreach($arrayhijosNexLevel as $datosArrayhijosNexLevel)
                                                                                                  {?>
                                                                                                  <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                      <td>
                                                                                                      <div class="p-0">
                                                                                                          <table class="table table-hover">
                                                                                                          <tbody>
                                                                                                              <?php
                                                                                                              $arrayhijosN3  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                              $variable=$datosArrayhijosNexLevel['idItems'].'-'. @$idObjetivoHeader;

                                                                                                              if(count($arrayhijosN3)<1)
                                                                                                              {
                                                                                                              //No tiene Hijos?>
                                                                                                              <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                  <td>
                                                                                                                  <?php 
                                                                                                                   $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                   echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'].'
                                                                                                                  (
                                                                                                                    <a href="#"
                                                                                                                    onclick="enviarParametrosGetsionUpdate(\'evaluacion/evaluacionItemCreate.php\',1,\''.$variable.'\')"
                                                                                                                    ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>
                                                                                                                  )
                                                                                                                  ';?>
                                                                                                                  </td>
                                                                                                              </tr>
                                                                                                              <?php
                                                                                                              }else
                                                                                                              {// si tiene Hijo?>
                                                                                                              <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                  <td>
                                                                                                                      <button type="button" class="btn btn-primary p-0">
                                                                                                                      <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                                                                                      </button>
                                                                                                                      <?php 
                                                                                                                        $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                        echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];?>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                                               <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                                              <?php

                                                                                                                $arrayhijosNexLevel  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
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
                                                                                                                                                $arrayhijosN3  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                                                                $variable=$datosArrayhijosNexLevel['idItems'].'-'. @$idObjetivoHeader;

                                                                                                                                                if(count($arrayhijosN3)<1)
                                                                                                                                                {
                                                                                                                                                //No tiene Hijos?>
                                                                                                                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                                                    <td>
                                                                                                                                                    <?php 
                                                                                                                                                    $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                                                    echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'].'
                                                                                                                                                    (
                                                                                                                                                      <a href="#"
                                                                                                                                                      onclick="enviarParametrosGetsionUpdate(\'evaluacion/evaluacionItemCreate.php\',1,\''.$variable.'\')"
                                                                                                                                                      ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>
                                                                                                                                                    )
                                                                                                                                                    ';?>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                                <?php
                                                                                                                                                }else
                                                                                                                                                {// si tiene Hijo?>
                                                                                                                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                                                    <td>
                                                                                                                                                        <button type="button" class="btn btn-primary p-0">
                                                                                                                                                        <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                                                                                                                        </button>
                                                                                                                                                        <?php 
                                                                                                                                                          $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                                                          echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];?>
                                                                                                                                                      </td>
                                                                                                                                                  </tr>
                                                                                                                                                  <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                                                                                  <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                                                                                  <?php

                                                                                                                                                    $arrayhijosNexLevel  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                                                                    if(count($arrayhijosNexLevel)>0)
                                                                                                                                                    {?>
                                                                                                                                                        <tr class="expandable-body">
                                                                                                                                                        <td>
                                                                                                                                                            <div class="p-0">
                                                                                                                                                                    <table class="table table-hover">
                                                                                                                                                                    <tbody>
                                                                                                                                                                        <?php
                                                                                                                                                                        //************************ INICIO DEL RECORRIDO NIVEL 5 ********************/
                                                                                                                                                                        foreach($arrayhijosNexLevel as $datosArrayhijosNexLevel5)
                                                                                                                                                                        {?>
                                                                                                                                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                                                                            <td>
                                                                                                                                                                            <div class="p-0">
                                                                                                                                                                                <table class="table table-hover">
                                                                                                                                                                                <tbody>
                                                                                                                                                                                    <?php
                                                                                                                                                                                    $arrayhijosN3  = hijos($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel5['jerarquia'], $token);
                                                                                                                                                                                    $variable=$datosArrayhijosNexLevel5['idItems'].'-'. @$idObjetivoHeader;

                                                                                                                                                                                    if(count($arrayhijosN3)<1)
                                                                                                                                                                                    {
                                                                                                                                                                                    //No tiene Hijos?>
                                                                                                                                                                                    <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                                                                                        <td>
                                                                                                                                                                                        <?php 
                                                                                                                                                                                        $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel5['jerarquia']);
                                                                                                                                                                                        echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel5['descripcion'].'
                                                                                                                                                                                        (
                                                                                                                                                                                          <a href="#"
                                                                                                                                                                                          onclick="enviarParametrosGetsionUpdate(\'evaluacion/evaluacionItemCreate.php\',1,\''.$variable.'\')"
                                                                                                                                                                                          ><i class="fas fa-edit"  style="color: #228A13;"></i></ a>
                                                                                                                                                                                        )
                                                                                                                                                                                        ';?>
                                                                                                                                                                                        </td>
                                                                                                                                                                                    </tr>
                                                                                                                                                                                    <?php
                                                                                                                                                                                    }else
                                                                                                                                                                                    {// si tiene Hijo?>
                                                                                                                                                                                    <tr data-widget="expandable-table" aria-expanded="false">
                                                                                                                                                                                        <td>
                                                                                                                                                                                            <button type="button" class="btn btn-primary p-0">
                                                                                                                                                                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                                                                                                                                                            </button>
                                                                                                                                                                                            <?php 
                                                                                                                                                                                              $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel5['jerarquia']);
                                                                                                                                                                                              echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel5['descripcion'];?>
                                                                                                                                                                                          </td>
                                                                                                                                                                                      </tr>
                                                                                                                                                                                      <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                                                                                                                                                                      <?php
                                                                                                                                                                                        nivel4($datosArrayhijosNexLevel5,5,$token,$idObjetivoHeader);
                                                                                                                                                                                        
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
