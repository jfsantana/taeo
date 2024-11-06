<?php 
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}

  include_once('../add/script.php');
  require_once '../funciones/wsdl/clases/consumoApi.class.php';


  $idEvento = @$_POST["id"];
  $token = $_SESSION['token'];
  $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/event?type=4";
  $rs         = API::GET($URL, $token);
  $arrayEvent  = API::JSON_TO_ARRAY($rs);
  //print("<pre>".print_r(($arrayEvent) ,true)."</pre>"); die;
  ?>



  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content -->
  
    <div class="small-box">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid ">
          <div class="row">
          <div class="col-md-2">
              <div class="sticky-top mb-3 ">
                <div class="card ">
                  <div class="card-header">
                    <h4 class="card-title">Tipos de Eventos</h4>
                  </div>
                  <div class="card-body">
                    <!-- the events -->
                    <div id="external-events">
                      <div class="external-event bg-success">Sede</div>
                      <div class="external-event bg-warning">Facilitadores</div>
                      <div class="external-event bg-info">Administrativo</div>
                      <div class="external-event bg-gray">No Disponibles</div>

                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>

              </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-10 connectedSortable">
              <div class="card card-primary">
                <div class="card-body">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  

<!-- ./wrapper -->




<!-- ***************** -->

  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.css">

<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.js"></script>



<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>


<!-- ***************** -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
      var Calendar = FullCalendar.Calendar;
      var calendarEl = document.getElementById('calendar');

      // Pasar los datos de PHP a JavaScript
      var events = <?php echo json_encode($arrayEvent); ?>;

      // Mapear los datos para el calendario
      var mappedEvents = events.map(function(event) {
        return {
          title: event.title,
          start: event.start,
          end: event.end,
          backgroundColor: event.backgroundColor,
          borderColor: event.borderColor,
          allDay: event.allDay === "true"
        };
      });

      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek'
        },
        themeSystem: 'bootstrap',
        locale: 'ES',
        events: mappedEvents,
        editable  : false,
        droppable : true // this allows things to be dropped onto the calendar !!!
      });

      calendar.render();
    });
  </script>

