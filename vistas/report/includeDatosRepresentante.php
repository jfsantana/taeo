            <div class="card direct-chat direct-chat-primary">
              <div class="card-header  bg-info">
                <h3 class="card-title">
                  Datos del Representante
                </h3>

                <div class="card-tools">
                  <button type="button"  class="btn btn-primary btn-sm" data-card-widget="collapse" id="datosRepresentantes">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form>
                <table id="resumenRepresentante" class="table table-bordered table-striped">
                                <thead>
                                  <tr>

                                    <th>Nombre Represenatnte</th>
                                    <th>Cédula/Rut</th>
                                    <th>Parentesco</th>
                                    <th>Teléfono</th>
                                    <th>Puede Retirar</th>

                                  </tr>
                                </thead>
                                <tbody>
                              <?php
                                foreach (@$arrayRepresentanteByAprendiz  as $Representante) { 
                                  
                                  //print_r($arrayRepresentanteByAprendiz); die;
                              ?>

                                    <tr>

                                      <td><?php echo @$Representante['apellidoRepresentante'].', '.@$Representante['nombreRepresentante']; ?><</td>
                                      <td><?php echo @$Representante['parentescoRepresentante']; ?></td>
                                      <td><?php echo @$Representante['cedulaRepresentante']; ?></td>
                                      <td><?php echo @$Representante['telefonoRepresentante']; ?></td>
                                      <td ><?php if(@$Representante['retirarAprendiz']=='1'){echo '<span class="badge bg-success">Si</span>';}else {echo '<span class="badge bg-danger">No</span>';} ?></td>
                                    </tr>
                              <?php } ?>
                              </tbody>

                              </table>
                </form>
              </div>
          </div>
        