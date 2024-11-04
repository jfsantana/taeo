<div class="col-lg-12 col-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Resumen Evaluación <?php echo @$nombreAprendizAux;?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" id="HeaderTable">
                  <i class="fas fa-minus"></i>
                </button>
                
              </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <label for="Aprendiz">Aprendiz</label>
                    <select class="form-control" name="idAprendiz" id="Aprendiz" <?php echo $disabled;?> onchange="fetchNiveles(this.value,<?php echo $_POST['mod'];?>)" required>
                      <option  value=''>Seleccione</option>
                      <?php foreach($arrayAprendices as $dataAprendices ){?>
                        <option <?php if ($dataAprendices['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $dataAprendices['idAprendiz']; ?>><?php echo strtoupper($dataAprendices['apellidoAprendiz'].', '. $dataAprendices['nombreAprendiz']);?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="idHeaderEvaluacionAnteriorl">Evaluación previa</label>
                    <select class="form-control" name="idHeaderEvaluacionAnterior" id="idHeaderEvaluacionAnterior" <?php echo $disabled;?>  <?php if ($_POST['mod']==1){echo 'disabled';}?>>

                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="sede">Sede:</label>
                    <select class="form-control" name="idSede" id="idSede"  <?php echo $disabled;?>  onchange="fetchMediadores(this.value,'')"  required>
                      <option value=''>Seleccione</option>
                      <?php foreach($arraySede as $sede ){?>
                        <option <?php if ($sede['idSede'] == @$idSede) {echo 'selected';} ?> value=<?php echo $sede['idSede']; ?>><?php echo $sede['nombreSede']; ?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label for="aprendiz">Evaluadores:</label>
                    <div id="idFacilitadorContainer">
                      <!-- Checkboxes will be populated here by fetchMediadores -->
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <label>Activo</label>
                    <select class="form-control" name="activo" id="activo"  required>
                      <option <?php if (@$activo == 1) {
                                echo 'selected';
                              } ?> value=1>Activo</option>
                      <option <?php if (@$activo == 0) {
                                echo 'selected';
                              } ?> value=0>Desactivado</option>
                      <option <?php if (@$activo == 2)  {
                                echo 'selected';
                              } ?> value=2>Cerrada</option>
                    </select>
                  </div>
                  <div class="col-sm-12">
                            </br>
                      <label for="conclucionesRecomendaciones">Conclusiones y Recomendaciones</label>
                      <textarea  id="summernote" name="conclucionesRecomendaciones"><?php echo @$conclucionesRecomendaciones; ?></textarea>
                  </div>
                  <div class="col-sm-12">
                    <label for="nombreRepresentante">Observacion Evaluación</label>
                    <textarea  id="observacion" name="observacion"><?php echo @$observacion; ?></textarea>
                  </div>
                  <div class="col-sm-4">
                    <label for="cedulaRepresentante">Fecha Creación de la Evaluacion</label>
                    <input type="text" class="form-control" readonly name="fechaCreacion" id="fechaCreacion" placeholder="fechaCreacion" value="<?php echo @$fechaEvaluacion; ?>">
                  </div>

                  <div class="col-sm-4">
                    <label for="telefonoRepresentante">Creado Por</label>
                    <input type="text" class="form-control" name="creadoPor" id="creadoPor" placeholder="creadoPor" readonly value="<?php echo @$creadoPor; ?>">
                  </div>

                </div>
              </div>
              <div class="card-body">
                <div class="card-header">
                    <h3 class="card-title">Resumen  de Evaluaciones </h3>
                </div>
                <div class="col-lg-12 col-12">
                  <div class="card-body table-responsive p-0">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          </thead>
                          <tbody>
                            <?php 
                            $currentNivel = '';
                            $currentEdad = '';
                            $areas = [];
                            $dataByNivelAndEdad = [];
                            foreach ($arrayResumen as $datoResumen) {
                              $nivel = $datoResumen['nombreNivelEvaluacion'];
                              $edad = $datoResumen['edadCronologica'];
                              $area = $datoResumen['nombreAreaEvaluacion'];
                          
                              if (!isset($dataByNivelAndEdad[$nivel])) {
                                $dataByNivelAndEdad[$nivel] = [];
                              }
                              if (!isset($dataByNivelAndEdad[$nivel][$edad])) {
                                $dataByNivelAndEdad[$nivel][$edad] = [];
                              }
                              if (!isset($dataByNivelAndEdad[$nivel][$edad][$area])) {
                                $dataByNivelAndEdad[$nivel][$edad][$area] = [];
                              }
                          
                              $dataByNivelAndEdad[$nivel][$edad][$area][] = $datoResumen;
                          
                              if (!in_array($area, $areas)) {
                                $areas[] = $area;
                              }
                            }
                          
                            $numAreas = count($areas)*2;

                            // Print data

                            $modalsData = []; // Array para almacenar los datos de los modales


                            foreach ($dataByNivelAndEdad as $nivel => $edades) {
                              echo "<tr class='bg-danger'><td colspan='$numAreas'><strong>Nivel: " . strtoupper($nivel) . "</strong></td></tr>";
                              ksort($edades); // Sort edades by key (edad) in ascending order
                              foreach ($edades as $edad => $areasData) {
                                echo "<tr><td class='bg-info' colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
                                echo "<tr>";
                                $columnIndex = 1;
                                foreach ($areas as $area) {
                                  $class = "gradient-blue-$columnIndex";
                                  echo "<th class='$class'>" . strtoupper($area) . "</th>";
                                  echo "<th class='$class'>eva.</th>";
                                  $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                }
                                echo "</tr>";
                                $maxRows = max(array_map('count', $areasData));
                                for ($i = 0; $i < $maxRows; $i++) {
                                  echo "<tr>";
                                  $columnIndex = 1;
                                  foreach ($areas as $area) {
                                    $class = "gradient-blue-$columnIndex";
                                    if (isset($areasData[$area][$i])) {
                                      $detalle = $areasData[$area][$i]['detalleEvalaacion'];
                                      $evaluacion = $areasData[$area][$i]['evaluacion_detalle'];
                                      $id = isset($areasData[$area][$i]['idDetalleEvaluacion']) ? $areasData[$area][$i]['idDetalleEvaluacion'] : ''; // Verificar si 'idDetalleEvaluacion' existe
                                      
                                      switch ($evaluacion) {
                                        case 'AT':
                                          $icon = 'X';
                                          $class = 'Atotal';
                                          break;
                                        case 'AP':
                                          $icon = 'P';
                                          $class = 'AParcial';
                                          break;
                                        case 'SA':
                                          $icon = '√';
                                          break;
                                      }

                                      // Generar un ID único para el modal
                                      $modalId = "editModal_$id";

                                      echo "<td class='$class'><a href='#' class='edit-link' data-toggle='modal' data-target='#$modalId' data-id='$id' data-idHeaderEvaluacion='$idHeaderEvaluacion' data-nivel='$nivel' data-edad='$edad' data-area='$area' data-descripcion='$detalle' data-evaluacion='$evaluacion'>$detalle</a></td><td class='$class'> $icon ($evaluacion)</td>";

                                      // Almacenar los datos del modal en el array
                                      $modalsData[] = [
                                        'modalId' => $modalId,
                                        'id' => $id,
                                        'nivel' => $nivel,
                                        'idNivelEvaluacion' => $areasData[$area][$i]['idNivelEvaluacion'],
                                        'edad' => $edad,
                                        'edadCronologica' => $areasData[$area][$i]['edadCronologica'],
                                        'area' => $area,
                                        'idAreaEvaluacion' => $areasData[$area][$i]['idAreaEvaluacion'],
                                        'descripcion' => $detalle,
                                        'evaluacion' => $evaluacion,
                                        'idHeaderEvaluacion'=>$idHeaderEvaluacion
                                      ];
                                    } else {
                                      echo "<td class='$class'></td><td class='$class'></td>";
                                    }
                                    $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                  }
                                  echo "</tr>";
                                }
                              }
                            }
                            ?>
                          </tbody>                        
                          <tfoot>
                            <tr>
                            </tr>
                          </tfoot>
                        </table>
                  </div>
                    
                </div>
              </div>
            </form>
          </div>
        </div>