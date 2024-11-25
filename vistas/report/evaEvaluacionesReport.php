<div class="col-sm-12">
                <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #235382;">ESCALA DE ESTIMACIÓN EVOLUTIVA TAEO 8.0 (E.E.E)</label>
              </div>

              <!-- ITEMS  -->
              <div class="col-lg-12 col-12">
                <div class="card card-primary">

                    <div class="card-body">
                        <div class="col-lg-12 col-12">
                          <div class="card">
                            <div class="table-responsive">
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
                                    echo "<tr ><td colspan='$numAreas'><strong>Nivel: " . strtoupper($nivel) . "</strong></td></tr>";
                                    ksort($edades); // Sort edades by key (edad) in ascending order
                                    foreach ($edades as $edad => $areasData) {
                                      echo "<tr><td colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
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

                                            echo "<td class='$class'>$detalle</td>
                                                  <td class='$class'> $icon ($evaluacion)</td>";

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
                    </div>

                  </div>
              </div>