

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>


<!-- /************************** */ -->
<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">



<!-- /************************** */ -->
<script src="../plugins/fullcalendar/main.js"></script>


<!-- /************************** */ -->
<!-- Bootstrap 4-->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS-->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline-->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap-->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart-->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker-->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4-->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote-->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars-->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App
<script src="../dist/js/adminlte.js"></script>-->

<!-- AdminLTE dashboard demo (This is only for demo purposes)-->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- /****************************** */ -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../../plugins/summernote/summernote-bs4.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- ICONOS  -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<!-- /**************CALENDARIO ***************************** */ -->

<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- /************************************************ */ -->
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="./../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="./../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script>
  function validarSesion() {
    if (!isset($_SESSION['id_user'])) {
      header("Location: https://www.google.com");
      exit();
    }
  }

  $(function() {

     // Summernote
     $('#summernote').summernote({
      height: 200
     })

     $('#observacion').summernote({
      height: 100
     })

     $('#direcion').summernote({
      height: 100
     })
     $('#eventDesciption').summernote({
      height: 200
     })

     $('#ponentes').summernote({
      height: 200
     })

     $("#event").DataTable({
      "responsive": true,
      "order": [
        [3, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#event_wrapper .col-md-6:eq(0)');

    $("#example1").DataTable({
      "responsive": true,
      "order": [
        [0, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#resumenRepresentante").DataTable({
      "responsive": true,
      "order": [
        [0, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,

    }).buttons().container().appendTo('#resumenRepresentante_wrapper .col-md-6:eq(0)');



    $("#Aprobacion").DataTable({
      "responsive": true,
      "order": [
        [1, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#Aprobacion_wrapper .col-md-6:eq(0)');

    $("#tablaModalBase").DataTable({
      "responsive": true,
      "order": [
        [2, "asc"]
      ],
      "searching": false,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": [{
          extend: 'excel',
          text: 'Excel',
          filename: $('#Consultor').val(),
          customize: function(xlsx) {
            var sheet = xlsx.xl.worksheets['sheet1.xml'];
            var fechaActividad = $('#fechaActividad').val();
            var currentDate = fechaActividad; //moment().format('DD/MM/YYYY');
            var firstDayOfMonth = moment(currentDate, 'DD/MM/YYYY').startOf('month').format('DD/MM/YYYY');
            var lastDayOfMonth = moment(currentDate, 'DD/MM/YYYY').endOf('month').format('DD/MM/YYYY');
            var headerRow = $('row', sheet).eq(0);
            var newHeaderRow = headerRow.clone();
            newHeaderRow.find('c').eq(0).find('t').text('Formato de Horas  \n  (Desde:' + fechaActividad + ' al ' + lastDayOfMonth + ' )');
            headerRow.after(newHeaderRow);
          }
        },
        "csv", "pdf", "print", "colvis"
      ]
    }).buttons().container().appendTo('#tablaModalBase_wrapper .col-md-6:eq(0)');

    $("#tablaExcel").DataTable({
      "responsive": true,
      "order": [
        [2, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv",
        {
          extend: 'excel',
          text: 'Excel',
          filename: $('#nameProyecto').val()
        }, "pdf", "print", "colvis"
      ],
    }).buttons().container().appendTo('#tablaExcel_wrapper .col-md-6:eq(0)');

    $("#registro").DataTable({
      "responsive": true,
      "order": [
        [2, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#registro_wrapper .col-md-6:eq(0)');

    $("#tablaModal").DataTable({
      "responsive": true,
      "order": [
        [1, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#tablaModal_wrapper .col-md-6:eq(0)');


    $("#cargas22").DataTable({
      "responsive": true,
      "order": [
        [1, "desc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"],
    }).buttons().container().appendTo('#cargas22_wrapper .col-md-6:eq(0)');

    $("#cargas11").DataTable({
      "responsive": true,
      "order": [
        [1, "desc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"],
    }).buttons().container().appendTo('#cargas11_wrapper .col-md-6:eq(0)');
//
    $("#reporte").DataTable({
      "responsive": true,
      "order": [
        [1, "asc"]
      ],
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#Reporte_wrapper .col-md-6:eq(0)');


    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('.select2').select2();

  });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //Date picker
  $('#reservationdate').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  //Date picker
  $('#reservationdateFin').datetimepicker({
    format: 'YYYY-MM-DD'
  });

  function enviarParametros(page) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);
    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosCRUD(page) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '../../vistas/home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosGetsionUpdate2(page, mod, id) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '../../vistas/home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosGetsionCreate(page, mod) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviar4ParametrosGet(page, mod, id, select) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'select';
    parametro1.value = select;
    form.appendChild(parametro1);
    //alert(parametro1);
    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosGetsionUpdate(page, mod, id) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosAprobacionDetalleProyecto(page, mod, id, idProyecto) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'idProyecto';
    parametro1.value = idProyecto;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosReportFi2(page, mod, mes) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosReportFi3(page, mes, consultora, proyecto) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mes';
    parametro1.value = mes;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'consultora';
    parametro1.value = consultora;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'proyecto';
    parametro1.value = proyecto;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosGetsionUpdate2(page, mod, id) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '../../vistas/home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarParametrosEvaluacion(page, mod, id, idNivelEvaluacion, edadCronologica, idAreaEvaluacion) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '../../vistas/home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'idNivelEvaluacion';
    parametro1.value = idNivelEvaluacion;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'edadCronologica';
    parametro1.value = edadCronologica;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'idAreaEvaluacion';
    parametro1.value = idAreaEvaluacion;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviar3Parametror (page, mod, id, idItem) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'mod';
    parametro1.value = mod;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'id';
    parametro1.value = id;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'idItem';
    parametro1.value = idItem;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }

  function enviarRegistoTiempo(page, corteActual, corteSelect) {

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'home.php';

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'page';
    parametro1.value = page;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'corteActual';
    parametro1.value = corteActual;
    form.appendChild(parametro1);

    var parametro1 = document.createElement('input');
    parametro1.type = 'hidden';
    parametro1.name = 'corteSelect';
    parametro1.value = corteSelect;
    form.appendChild(parametro1);

    document.body.appendChild(form);
    form.submit();
  }
</script>
