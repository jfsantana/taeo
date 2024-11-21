<div class="card direct-chat direct-chat-primary">
<div class="card-header  bg-info">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Avances Registrados
                </h3>

                <div class="card-tools">
                  <button type="button"  class="btn btn-primary btn-sm" data-card-widget="collapse" id="datosAvance">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">

                <form>  
                  <?php if (count($arrayPlanificaciones) > 0) { ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Aprendiz</th>
                          <th>Sede</th>
                          <th>Área</th>
                          <th>Observación</th>
                          <th>Creado por</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if(@$arrayPlanificaciones){
                          foreach (@$arrayPlanificaciones as $planificaciones) { ?>
                          <tr>
                            <td><?php echo strtoupper($planificaciones['idPlanificacion']); ?></td>  
                            <td><?php echo $planificaciones['aprendiz']; ?></td>
                            <td><?php echo $planificaciones['nombreSede']; ?></td>
                            <td><a href="#" onclick="enviarParametrosGetsionUpdate('evaluacion/evaluacionCreate.php',2,'<?php echo $planificaciones['idPlanificacion']; ?>')" class="nav-link "><?php echo $planificaciones['nombreArea']; ?></a></td>
                            <td><?php echo substr($planificaciones['observacion'], 0, 1000); ?></td>
                            <td><?php echo $planificaciones['creadoPor']; ?></td>
                            <td><?php echo $planificaciones['estado']; ?></td>
                          </tr>
                        <?php } 
                        }?>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Codigo</th>   
                          <th>Aprendiz</th>
                          <th>Sede</th>
                          <th>Área</th>
                          <th>Observación</th>
                          <th>Creado por</th>
                          <th>Status</th>
                        </tr>
                      </tfoot>
                    </table>
                  <?php } else {?>

                    <h3 class="text-center">No se han registrado avances</h3>

                    <?php } ?>
               

                </form>
              </div>
          </div>
