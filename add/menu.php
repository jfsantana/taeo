<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item menu-close">
      <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-cogs  text-danger"></i>
        <p>
          Configuración
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/rolesList.php')" class="nav-link">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>Roles</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/SedeList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>Sedes</p> <!--Activar o Desactivar Envio de Correos (cumple, Evento, notificaiocnes especiales) -->
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/usuarioList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>Mediador(a)</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/aprendizList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>Aprendices</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/representanteList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>Representantes</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/areaDesarrolloList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>&Aacute;rea de Desarrollo</p>
          </a>
        </li>


        <li class="nav-item">
        <a href="#" onclick="enviarParametros('admin/configList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-cog text-danger"></i>
            <p>Configuración</p> <!--Activar o Desactivar Envio de Correos (cumple, Evento, notificaiocnes especiales) -->
          </a>
        </li>
      </ul>
    </li>
    <!-- ****************************** -->
    <li class="nav-item menu-close">
      <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-book text-warning"></i>
        <p>
          Objetivos
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('objetivo/objetivoListar.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-id-card text-warning"></i>
            <p>Gestión de Objetivos</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="#" onclick="enviarParametros('time/cargaTimeResumenAprobList.php')" class="nav-link">
            <i class="nav-icon fas fa-edit text-warning"></i>
            <p>
              Aprobacion (Prog)
            </p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-calendar  text-programas"></i>
            <p>Horarios de Trabajo</p>
          </a>
        </li> -->


      </ul>
    </li>
    <!-- ****************************** -->
    <li class="nav-item menu-close">
      <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-book  text-info"></i>
        <p>
          Planificaci&oacute;n
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
      <li class="nav-item">
          <a href="#" onclick="enviarParametros('planning/planningListar.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-id-card text-info"></i>
            <p>Gestión Planificación</p>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-id-card  text-info"></i>
            <p>Creación </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/empresaConsultoraList.php')" class="nav-link">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-edit  text-info"></i>
            <p>Evaluación</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('time/cargaTimeResumenAprobList.php')" class="nav-link">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-edit  text-info"></i>
            <p>
              Aprobación (Prog)
            </p>
          </a>
        </li> -->

      </ul>
    </li>
    <!-- ****************************** -->
    <!-- <li class="nav-item menu-close">
      <a href="#" class="nav-link ">

        <i class="nav-icon fas fa-book-reader"></i>
        <p>
          Evaluaciones Niño
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-diagnoses"></i>
            <p>Mi Primera Evaluacion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/empresaConsultoraList.php')" class="nav-link">
            <i class="nav-icon fas fa-diagnoses"></i>
            <p>Re-Evaluacion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('time/cargaTimeResumenAprobList.php')" class="nav-link">
            <i class="nav-icon fas fa-edit text-warning"></i>
            <p>
              Consulta de Evaluacion
            </p>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- ****************************** -->
    <li class="nav-item menu-close">
      <a href="#" class="nav-link ">

        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
          Eventos
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" onclick="enviarParametrosGetsionCreate('event/crearEvent.php','1')" class="nav-link ">
            <i class="nav-icon fas fa-plus"></i>
            <p>Creación</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('event/eventList.php')" class="nav-link ">
            <i class="nav-icon far fa-circle text-danger"></i>

            <p>Lista de Eventos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/empresaConsultoraList.php')" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p>Calendario de Eventos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/empresaConsultoraList.php')" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p>Envio de Eventos por Emial</p>
          </a>
        </li>

      </ul>
    </li>

    <?php if ($_SESSION['id_rol'] < 40) { //elñ consultoro no ve nada
    ?>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy  text-info"></i>
          <p>
            Reportes
            <i class="fas fa-angle-left right"></i>

          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" onclick="enviarParametros('report/porConsultor.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Evaluaciones por Niño</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="enviarParametros('report/fiRealMensual.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Reporte por Sesión</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="enviarParametros('report/fiConsolidadoMensualConsultores.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Programas por Niño</p>
            </a>
          </li>

        </ul>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a href="#" class="nav-link ">
        <i class="nav-icon far fa-circle text-danger"></i>
        <p>Manual de Usuario</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="../funciones/funcionesGenerales/XM_cerrarsesion.php" class="nav-link">
        <i class="nav-icon far fa-close"></i>
        <p>
          Salir
        </p>
      </a>
    </li>
  </ul>
</nav>
