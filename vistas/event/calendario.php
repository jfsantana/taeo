<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

?>
<div class="wrapper">
  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content --> 
  <div >


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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins//bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var calendarEl = document.getElementById('calendar');
    var containerEl = document.getElementById('external-events');

    // Initialize Draggable


    // Function to fetch events from the service
    function fetchEvents() {
      return $.ajax({
        url: "http://<?php echo $_SERVER['HTTP_HOST']; ?>/funciones/wsdl/event?type=4",
        method: 'GET',
        dataType: 'json'
      });
    }

    


    // Initialize the calendar after fetching events
    fetchEvents().done(function(data) {
      var events = data.map(function(event) {
        return {
          title: event.title,
          start: event.start,
          end: event.end,
          backgroundColor: event.backgroundColor,
          borderColor: event.borderColor,
          allDay: "false"
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
        events: events,
        editable  : false,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });

      calendar.render();
    });

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

