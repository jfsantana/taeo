<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item menu-close">
      <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-cogs "></i>
        <p>
          Configuracion
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/rolesList.php')" class="nav-link">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p>Roles</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/SedeList.php')" class="nav-link ">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p>Sedes</p> <!--Activar o Desactivar Envio de Correos (cumple, Evento, notificaiocnes especiales) -->
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/usuarioList.php')" class="nav-link ">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p>Facilitadores</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/aprendizList.php')" class="nav-link ">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p>Aprendices</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/representanteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p>Representantes</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/usuarioList.php')" class="nav-link ">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p>Configuracion de Correos</p> <!--Activar o Desactivar Envio de Correos (cumple, Evento, notificaiocnes especiales) -->
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
            <i class="nav-icon fas fa-id-card text-warning"></i>
            <p>Consultar Objetivos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('time/cargaTimeResumenAprobList.php')" class="nav-link">
            <i class="nav-icon fas fa-edit text-warning"></i>
            <p>
              Aprobacion (Prog)
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-calendar  text-programas"></i>
            <p>Horarios de Trabajo</p>
          </a>
        </li>


      </ul>
    </li>
    <!-- ****************************** -->
    <li class="nav-item menu-close">
      <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Planificacion
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-id-card  text-programas"></i>
            <p>Creacion de Planificacion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/empresaConsultoraList.php')" class="nav-link">
            <i class="nav-icon fas fa-edit  text-programas"></i>
            <p>Evaluacion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('time/cargaTimeResumenAprobList.php')" class="nav-link">
            <i class="nav-icon fas fa-edit text-warning"></i>
            <p>
              Aprobacion (Prog)
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-calendar  text-programas"></i>
            <p>Horarios de Trabajo</p>
          </a>
        </li>


      </ul>
    </li>
    <!-- ****************************** -->
    <li class="nav-item menu-close">
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
    </li>
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
          <a href="#" onclick="enviarParametros('admin/clienteList.php')" class="nav-link ">
            <i class="nav-icon fas fa-plus"></i>

            <p>Creacion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" onclick="enviarParametros('admin/empresaConsultoraList.php')" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p>Consulta</p>
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
              <p>Reporte por Sesion</p>
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
      <a href="../manual/Documentacion del Sisterma de Tiempo de MCS.docx" class="nav-link ">
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
