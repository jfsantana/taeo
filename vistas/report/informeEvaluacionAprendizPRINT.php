<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}

//print("<pre>".print_r(json_encode($_POST),true)."</pre>");die;
//echo $_POST['idHeaderEvaluacion']; die;
$_GET['idEvaluacion'] = $_POST['idHeaderEvaluacion'];
@$_POST["idEvaluacion"]= $_POST['idHeaderEvaluacion'];

require '../../vendor/autoload.php';
require_once '../../funciones/wsdl/clases/consumoApi.class.php';

//require('../../plugins/html2pdf/html2pdf.php'); // Asegúrate de que la ruta sea correcta

$token ="2900097efc7e0508fdd6784d363ae6dd";



 //print_r($_GET);
ob_start();

  require('../../plugins/fpdf/fpdf.php');


  //FUNCIONES GENERALES
function impresion($texto){
  if($texto==null){
    return "-";
  }
  return  mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');;
}

function edadAprendiz($fechaNacimiento){
  $fecha_nacimiento = @$fechaNacimiento;
  $fecha_actual = date("Y-m-d H:i:s");
  if (!$fecha_nacimiento) {
    return 0;
  }
  $timestamp_nacimiento = strtotime(@$fecha_nacimiento);
  $timestamp_actual = strtotime(@$fecha_actual);
  $diferencia = abs($timestamp_actual - $timestamp_nacimiento);
  $anios = floor($diferencia / (365 * 60 * 60 * 24));
  $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
  return  $anios;
}

function edadAprendizAux($fechaNacimiento){
  $fecha_nacimiento = $fechaNacimiento;
  $fecha_actual = date("Y-m-d H:i:s");
  $timestamp_nacimiento = strtotime($fecha_nacimiento);
  $timestamp_actual = strtotime($fecha_actual);
  $diferencia = abs($timestamp_actual - $timestamp_nacimiento);
  $anios = floor($diferencia / (365 * 60 * 60 * 24));
  $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
  return  $anios . " años, " . $meses . " meses"; 
}

function edadByEvaluacionAux($fechaNacimiento, $fechaEvaluacion){
  // Convertir las fechas a objetos DateTime
  $fechaNacimientoDateTime = new DateTime($fechaNacimiento);
  $fechaEvaluacionDateTime = new DateTime($fechaEvaluacion);
  
  // Calcular la diferencia entre las dos fechas
  $diferencia = $fechaNacimientoDateTime->diff($fechaEvaluacionDateTime);
  
  // Obtener los años y meses de la diferencia
  $anios = $diferencia->y;
  $meses = $diferencia->m;
  
  // Imprimir la edad en años y meses
  return  $anios . " años, " . $meses . " meses"; 
}


  include("evaConsultasReport.php");


    class PDF extends FPDF
    {
      // Cabecera de página
      function Header(){
        $margen=220;
          $this->SetFont('Arial','',6);        
          $this->Image('../../dist/img/logoTaeo.jpg',10,5,20,15);
          $this->Cell($margen+35,2,'',0,);
          $this->Cell(30,2,impresion('TAEO VERSIÓN 8.0  11/21',0));
          $this->ln(2);

          $this->Cell($margen+6,2,'',0,);
          $this->Cell(30,2,impresion('Elaborado para la Organización Psicoeducativa TAEO por'));
          $this->ln(2);
          $this->Cell($margen+2,2,'',0,);
          $this->Cell(30,2,impresion('DRA. MAYLUC MARTÍNEZ   /   MA. GABRIELA FERNÁNDEZ'));
          $this->ln(2);
          $this->Cell($margen-33,2,'',0,);
          $this->Cell(30,2,impresion('MSc. LECTURA Y ESCRITURA- LCDA. EDUCACIÓN ESPECIAL /     LCDA. EN PSICOLOGÍA'));
          $this->ln(2);
          $this->Cell($margen-12,2,'',0,);
          $this->Cell(30,2,impresion('ANALISTA CONDUCTUAL  MÁSTER ABA  /  MENCIÓN CLÍNICA'));
          $this->Ln(4);

          // Dibujar una línea gris clara del ancho de la página
          $this->SetDrawColor(200, 200, 200); // Color gris claro
          $this->Line(10, $this->GetY(), 290, $this->GetY()); // Línea del ancho de la página
          $this->Ln(2); // Salto de línea
  

      }
      
      // Pie de página
      function Footer(){
          // Posición: a 1,5 cm del final
          $this->SetY(-20);
          // Arial italic 8
          $this->SetFont('Arial','I',8);

          // Dibujar una línea gris clara del ancho de la página
          $this->SetDrawColor(200, 200, 200); // Color gris claro
          $this->Line(10, $this->GetY(), 290, $this->GetY()); // Línea del ancho de la página
          $this->Ln(2); // Salto de línea

          // Número de página
          //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

          $this->Cell(30,2,impresion('Telf. 0241-9954657 Cel. 0424-4086461  |  TAEO Venezuela                                                                                                                                                                              TAEO Chile        | Fono. +56 9 8274 2261/2 3211 6797'));
          $this->ln(3);
          $this->Cell(30,2,impresion('Taeovenezuela@somostaeo.com           |  www.somostaeo.com                                                                                                                                                               www.somostaeo.com | Taeochile@somostaeo.com'));
          $this->ln(3);
          $this->Cell(30,2,impresion('Urb. El Recreo                                         |  @taeovenezuela                                                                                                                                                                                @taeochile        | Cerro El Plomo 5931, oficina 1213'));
          $this->ln(3);
          $this->Cell(30,2,impresion('Valencia- Venezuela                                                                                                                                                                                                                                                                           Las Condes, Santiago de Chile'));

          $this->ln(2);

      }

      //crea TITULO 1 de la pagina
      function TituloPrincipalPage($title, $ln, $ancho){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Ln($ln);
        $this->SetTextColor(35, 83, 130);
        $this->Cell($ancho, $ln, impresion($title), 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        $this->Ln($ln);
      }

      function TituloSeccion1($title, $ln, $ancho,$margen){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Ln($ln);
        $this->SetFillColor(35, 83, 130); // Azul (RGB: 0, 0, 255)
        $this->SetTextColor(255, 255, 255);
        
        $this->Cell($ancho, $ln, impresion($title), 0, 1, 'C', true);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(255, 255, 255); // Azul (RGB: 0, 0, 255)
      }

      function TituloSeccion2($title, $ln, $ancho, $margen){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(1);
        $this->SetFillColor(35, 112, 161); // Azul (RGB: 0, 0, 255)
        $this->SetTextColor(255, 255, 255);
        //$this->Cell($margen,$ln,'',0);
        $this->SetX($margen); 
        $this->Cell($ancho, $ln, impresion($title), 0, 1, 'C', true);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(255, 255, 255); // Azul (RGB: 0, 0, 255)
      }

      function TituloSeccion2Left($title, $ln, $ancho, $margen){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(1);
        $this->SetFillColor(35, 112, 161); // Azul (RGB: 0, 0, 255)
        $this->SetTextColor(255, 255, 255);
        //$this->Cell($margen,$ln,'',0);
        $this->SetX($margen); 
        $this->Cell($ancho, $ln, impresion($title), 0, 1, 'L', true);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(255, 255, 255); // Azul (RGB: 0, 0, 255)
      }

      function TituloSeccion2MISMALinea($texto, $X, $Y, $ANCHO) {
        // Ejemplo de implementación
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY($X, $Y);
        $this->SetFillColor(35, 112, 161); // Azul (RGB: 0, 0, 255)
        $this->SetTextColor(255, 255, 255);
        $this->Cell($ANCHO, 10, $texto, 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(255, 255, 255); // Azul (RGB: 0, 0, 255)
      }

      function FilaTabla($contenido, $ln, $anchoCelda, $margen){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Ln($ln);
        $this->Cell($margen,$ln,'',0);
        $this->Cell($anchoCelda, $ln, impresion($contenido));
      }

      function LineaDirectaAzul($contenido, $ln, $anchoCelda, $margen){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Cell($margen,$ln,'',0);
        $this->SetFillColor(35, 112, 161); // Azul (RGB: 0, 0, 255)
        $this->SetTextColor(255, 255, 255);
        $this->Cell($anchoCelda, $ln, impresion($contenido), 0, 1, 'L', true);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(255, 255, 255); // Azul (RGB: 0, 0, 255)
      }

      function LineaDirecta($contenido, $ln, $anchoCelda, $margen){
        // Establece la fuente, tamaño y estilo
        $this->SetFont('Arial', 'B', 12);
        $this->Cell($margen,$ln,'',0);
        $this->Cell($anchoCelda, $ln, impresion($contenido));
      }


    }
    
    
    
    // Creación del objeto de la clase heredada
      $pdf = new PDF('L', 'mm', 'A4'); // Orientación horizontal
      $pdf->AliasNbPages();
      $pdf->AddPage();
      $pdf->SetFont('Times', '', 12);
      $pdf->TituloPrincipalPage("REEVALUACIÓN PARA LA ACTUALIZACIÓN DEL ABORDAJE PSICOEDUCATIVO Y TERAPÉUTICO DESDE EL MODELO TAEO",1,0);
      $pdf->TituloSeccion1("DATOS DE IDENTIFICACION",6,0,0);
      $pdf->ln(1);
      $pdf->TituloSeccion2("DATOS DEL APRENDIZ",5,0,10);
      $pdf->TituloSeccion2MISMALinea("DATOS EVALUACION", 130, 39, 205);

      // DATOS DEL APRENDIZ
      $pdf->FilaTabla( "Nombre y Apellido:",1,10,1)  ;
      $pdf->FilaTabla( @$nombreAprendiz,0,20,42)  ;

      $pdf->FilaTabla( "Cedula Aprendiz:",0,20,100)  ;
      $pdf->FilaTabla( @$cedulaAprendiz,0,0,140)  ;

      $pdf->FilaTabla( "Fecha de Evaluacion:",0,20,190)  ;
      $pdf->FilaTabla( date("d-m-Y", strtotime(@$fechaEvaluacion)),0,0,235)  ;

      $pdf->FilaTabla( "Fecha Nacimiento:",3,10,1)  ;
      $pdf->FilaTabla( date("d-m-Y", strtotime(@$fechaNacimientoAprendiz)),1,20,42)  ;

      $pdf->FilaTabla( "Direccion:",0,20,100)  ;
      $pdf->FilaTabla( @$direccionAprendiz,0,0,140)  ;

      $pdf->FilaTabla( "Edad a la Evaluacion:",0,20,190)  ;
      $pdf->FilaTabla( edadByEvaluacionAux($fechaNacimientoAprendiz,$fechaEvaluacion),0,0,235)  ;
       
      $pdf->FilaTabla( "Edad Actual:",3,20,190)  ;
      $pdf->FilaTabla( edadAprendizAux($fechaNacimientoAprendiz),1,0,235)  ;

      $pdf->ln(4);
      
       //datosd e los padres
      $pdf->TituloSeccion2("DATOS DE LOS PADRES O REPRESENTANTES",5,0,10);


      foreach($arrayPadres as $dataPadres ){
        $pdf->FilaTabla( "(".@$dataPadres['parentescoRepresentante'].")".@$dataPadres['apellidoRepresentante'].', '.@$dataPadres['nombreRepresentante'],4,30,1)  ;
        $pdf->FilaTabla( "Email:".@$dataPadres['correoRepresentante'],1,20,70)  ;

        $pdf->FilaTabla( "Ocupacion: ". @$dataPadres['profesionRepresentante'],0,20,150)  ;
        $pdf->FilaTabla( "Telefono: ".  @$dataPadres['telefonoRepresentante'],0,20,200)  ;
      }  

      $pdf->ln(5);
      
      $pdf->TituloSeccion2("EVALUADO POR ",5,0,10);


      foreach($arrayEvaluadores as $dataEvaluadores){
        $pdf->FilaTabla( @$dataEvaluadores['apellidoUsuario'].', '.@$dataEvaluadores['nombreUsuario'],4,30,1)  ;
        $pdf->FilaTabla( @$dataEvaluadores['emailUsuario'],1,20,70)  ;

        $pdf->FilaTabla( @$dataEvaluadores['descripcionCargo'],0,20,150)  ;
      }  

      $liniaSeparacion= 10;
       
        
      $pdf->AddPage(); 
        
      $pdf->TituloSeccion1("DATOS DE IDENTIFICACION",6,0,0);
      
      
    
      $pdf->TituloSeccion2MISMALinea("Periodo de Abordaje:".(date('Y', strtotime($fechaEvaluacion)) - 1) . '-' . date('Y', strtotime($fechaEvaluacion)), 150,  34, 205);
      
      $pdf->ln(2);
      $pdf->LineaDirecta( "RE-EVALUACION",5,30,60)  ;
      $pdf->LineaDirecta( "RESULTADOS",0,10,80)  ;

      //*******************GRAFICO RESUMEN GENERAL*********** */
      if(isset($_POST['graficoAnt'])){
        $variable=$_POST['graficoAnt'][0];
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 1, 50, 80, 40, 'png');
      }else{
        $pdf->Cell(1, 50, '', 0, 0, 'C'); 
      }

      if(isset($_POST['graficoNew'])){
        $variable=$_POST['graficoNew'][0];
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 110, 50, 80, 40, 'png');
      }else{
        $pdf->Cell(110, 50, '', 0, 0, 'C'); 
      }

      $pdf->SetXY(206, 50); // Ajusta la posición de la tabla
      for ($i = 0; $i < 4; $i++) {
          $pdf->Cell(80, 10, 'Fila ' . ($i + 1), 1, 2, 'C'); // Ajusta el ancho y alto de las celdas
      }
        
      $pdf->Ln(1); // Salto de línea

      // Dibujar una línea gris clara del ancho de la página
      $pdf->SetDrawColor(200, 200, 200); // Color gris claro
      $pdf->Line(10, $pdf->GetY(), 286, $pdf->GetY()); // Línea del ancho de la página
      $pdf->Ln(5); // Salto de línea


      //*******************GRAFICO RESUMEN POR AREA*********** */
      $columnWidth = 30; // Ancho de cada columna
      $height = 25; // Altura de las celdas


      $pdf->Cell(45, $height, impresion('Evaluación Anterior'), 0, 0, 'C');

      // GRAFICO RESUMEN ANTERIORES
        
      if(isset($_POST['EvaAntleng'])){
        $pdf->Cell(30, $height, impresion('Gra1'), 0, 0, 'C');
        $variable=$_POST['EvaAntleng'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 60, 90, $columnWidth, $height, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      if(isset($_POST['EvaAntCog'])){
        $variable=$_POST['EvaAntCog'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 90, 90, 0, 0, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      if(isset($_POST['EvaAntSoc'])){
        $variable=$_POST['EvaAntSoc'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 120, 90, 0, 0, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      if(isset($_POST['EvaAntPsi'])){
        $variable=$_POST['EvaAntSoc'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 150, 90, 0, 0, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      if(isset($_POST['EvaAntAut'])){
        $variable=$_POST['EvaAntAut'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 180, 90, 0, 0, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      if(isset($_POST['EvaAntMor'])){
        $variable=$_POST['EvaAntMor'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 210, 90, 0, 0, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      if(isset($_POST['EvaAntSex'])){
        $variable=$_POST['EvaAntSex'][0]; 
        $img=explode(',',$variable,2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $pdf->Image($pic, 240, 90, 0, 0, 'png');
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      }else{
        $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }

      //*******************LINEA DE TITULOS ENTRE GRAFICOS*********** */
      $pdf->Ln($height); 

      $titles = [
          'Lenguaje',
          'Cognitivo',
          'Social',
          'Psicomotor',
          'Autonomía',
          'Moral',
          'Sexual'
      ];

      $pdf->Cell(45, 1, '', 0, 0, 'C'); 
      foreach ($titles as $title) {
          $pdf->Cell($columnWidth, 8, impresion($title), 1, 0, 'C'); 
      }

          
      //*******************GRAFICO RESUMEN NUEVO (REEVALUACION)*********** */
      $pdf->Ln(5);
      $columnWidth = 30; 
      $height = 25; 
      $pdf->Cell(45, $height, impresion('Evaluación Actual'), 0, 0, 'C');
      
      if(isset($_POST['EvaluacionReeeriorLenguaje'])){
          $variable=$_POST['EvaluacionReeeriorLenguaje'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 60, $pdf->GetY(), 0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      if(isset($_POST['EvaReeCog'])){
          $variable=$_POST['EvaReeCog'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 90, $pdf->GetY(),0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      if(isset($_POST['EvaReeSoc'])){
          $variable=$_POST['EvaReeSoc'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 120, $pdf->GetY(),0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      if(isset($_POST['EvaReePsi'])){
          $variable=$_POST['EvaReePsi'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 150, $pdf->GetY(), 0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      if(isset($_POST['EvaReeAut'])){
          $variable=$_POST['EvaReeAut'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 180, $pdf->GetY(), 0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      if(isset($_POST['EvaReeMor'])){
          $variable=$_POST['EvaReeMor'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 210, $pdf->GetY(), 0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      if(isset($_POST['EvaReeSex'])){
          $variable=$_POST['EvaReeSex'][0]; 
          $img=explode(',',$variable,2)[1];
          $pic = 'data://text/plain;base64,' . $img;
          $pdf->Image($pic, 240, $pdf->GetY(), 0, 0, 'png');
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C');
      } else {
          $pdf->Cell($columnWidth, $height, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
      }
      
      // Salto de página
      $pdf->AddPage(); 

      $pdf->TituloSeccion2("CONCLUSIONES Y RECOMENDACIONES".edadAprendiz($fechaNacimientoAprendiz),5,0,10);
      $pdf->WriteHTML(impresion($conclucionesRecomendaciones));

      // Salto de página
      $pdf->AddPage(); 

      $pdf->Image('../../dist/img/firmas/gresmarPalenca.png',10,50,0,0);
      $pdf->Image('../../dist/img/firmas/laylucMartinez.png',80,80,0,0);
      $pdf->Image('../../dist/img/firmas/gabruielaFernandez.png',210,50,0,0);
      
      // Salto de página
      $pdf->AddPage(); 
      
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
      $modalsData = []; 
      
      foreach ($dataByNivelAndEdad as $nivel => $edades) {
        $pdf->SetFont('Arial','B', 12); 
        $tituloGrafico='';
        $tituloGrafico= strtoupper($nivel);
        $pdf->Ln(2);
        $pdf->Cell(0, 0, impresion(strtoupper($nivel)), 0, 5, 'C');
        $pdf->Ln(2);

        ksort($edades); // Sort edades by key (edad) in ascending order

        foreach ($edades as $edad => $areasData) {
            $tituloGraficoResumen = '';
            $totalAreaLogrado = 0;
            $totalAreaApoyoParcial = 0;
            $totalAreaApoyoTotal = 0;
            $totalAusentes = 0;
            $totalActividades = 0;
            $tituloGraficoResumen = $tituloGrafico . "(Edad: $edad)";
            $tituloGraficoResumenID = str_replace(' ', '', strtoupper($nivel));
            $idGraficoResumen = $tituloGraficoResumenID . "_" . $edad;
            $nivelGraficoResumen = $tituloGraficoResumenID;
            $pdf->SetXY(10, 28);
            $pdf->SetFont('Arial','', 12); 
            $pdf->Cell(0, 0, 'Edad Cronologica: '.$edad , 0, 0, 'L');
            $pdf->Ln(5);
            $columnIndex = 1;
            $columnIndex = 1;

            $x = 10; // Coordenada X inicial
            $y = 30; // Coordenada Y inicial
            $pdf->SetFont('Arial','', 8); 

            foreach ($areas as $area) {
              $ancho=strlen($area)+65;
              $titleSmart = strtok($area, ' ');
              $pdf->SetXY($x, $y);
              $pdf->Cell($ancho, 10, strtoupper(impresion($titleSmart)) . '   (Eva.)', 0, 0, 'L'); 
              $x += 40; 

              $columnIndex = ($columnIndex % 8) + 1; 
            }
            
            $pdf->SetFont('Arial', '', 8); 
            
            //aqui recorre las areas

            $x = 10; 
            $y = 30; 
            $maxRows = max(array_map('count', $areasData));
            $cellWidth = 40; 
            $cellHeight = 10; 

            for ($i = 0; $i < $maxRows; $i++) {
                $columnIndex = 1;
                $y += $cellHeight; 
                $x = 10; 

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
                                $totalAreaApoyoTotal = $totalAreaApoyoTotal + 1;
                                $totalAusentes = $totalAusentes + 1;
                                $pdf->SetFillColor(253,204,69); 
                                break;
                            case 'AP':
                                $icon = 'P';
                                $class = 'AParcial';
                                $totalAreaApoyoParcial = $totalAreaApoyoParcial + 1;
                                $totalAusentes = $totalAusentes + 1;
                                $pdf->SetFillColor(109,189,75); 
                                break;
                                
                            case 'SA':
                                $icon = 'SA';
                                $totalAreaLogrado = $totalAreaLogrado + 1;
                                $pdf->SetFillColor(255,255,255); 
                                break;
                        }

                        $modalId = "editModal_$id";

                        $pdf->SetXY($x, $y);
                        $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('> '.$detalle . '           (' . $evaluacion . ')'), 0, 'L', true);
                        $pdf->SetFillColor(255,255,255); 
                        
                        $x += $cellWidth; 

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
                            'idHeaderEvaluacion' => $idHeaderEvaluacion
                        ];
                    } else {
                        $pdf->SetXY($x, $y);
                        $pdf->Cell($cellWidth, $cellHeight, '', 0, 0, 'C');
                        $x += $cellWidth; 
                    }
                    $columnIndex = ($columnIndex % 8) + 1; 
                }
            }

            $totalActividades = $totalAreaLogrado + $totalAusentes;
            $porAlcanzado = round(($totalAreaLogrado / $totalActividades) * 100, 2);$porAusentes = round(($totalAusentes / $totalActividades) * 100, 2);

            $arrayResumenGrafico = [
                'tituloGraficoResumen' => $tituloGraficoResumen,
                'idGraficoResumen' => $idGraficoResumen,
                'totalActividades' => $totalActividades,
                'totalAreaLogrado' => $totalAreaLogrado,
                'totalAreaApoyoParcial' => $totalAreaApoyoParcial,
                'totalAreaApoyoTotal' => $totalAreaApoyoTotal,
                'totalAusentes' => $totalAusentes,
                'porAlcanzado' => $porAlcanzado,
                'porAusentes' => $porAusentes,
                'nivelGraficoResumen' => $nivelGraficoResumen

            ];

            $arrayResumenGraficoAll[] = $arrayResumenGrafico;

            $pageWidth = $pdf->GetPageWidth();
            $usableWidth = $pageWidth * 0.7; // 70% del ancho de la página
            $margin = ($pageWidth - $usableWidth) / 2; // Margen para centrar las columnas

            $cellWidth = $usableWidth / 3; // Ancho de cada columna
            $cellHeight = 10; // Altura de cada celda

            $x = $margin; // Coordenada X inicial
            $y = 80; // Coordenada Y inicial
            $pdf->SetFont('Arial','', 12); 
            // Columna 1
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('H. Esperadas:'.$totalActividades), 0, 'L', true);
            $y += $cellHeight / 2; // Incrementa la coordenada Y para la siguiente fila
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('H. Alcanzadas:'.$totalAreaLogrado), 0, 'L', true);
            $y += $cellHeight / 2; // Incrementa la coordenada Y para la siguiente fila
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('H. Ausentes:'.$totalAusentes), 0, 'L', true);

            // Columna 2
            $x += $cellWidth; // Mover a la siguiente columna
            $y -= $cellHeight; // Reinicia la coordenada Y para la nueva columna
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('PROMEDIO'), 0, 'L', true);
            $y += $cellHeight / 2; // Incrementa la coordenada Y para la siguiente fila
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('Alcanzado:'.$totalAusentes), 0, 'L', true);
            $y += $cellHeight / 2; // Incrementa la coordenada Y para la siguiente fila
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($cellWidth, $cellHeight / 2, impresion('Por Alcanzar:'.$totalAusentes), 0, 'L', true);

            // Columna 3
            $x += $cellWidth; // Mover a la siguiente columna
            $y -= $cellHeight; // Reinicia la coordenada Y para la nueva columna
            $pdf->SetXY($x, $y);

            if (isset($_POST[$idGraficoResumen][0])) {
                $variable = $_POST[$idGraficoResumen][0]; 
                $img = explode(',', $variable, 2)[1];
                $pic = 'data://text/plain;base64,' . $img;
                $pdf->Image($pic, $x, $y, $cellWidth, 0, 'png');
            } else {
                $pdf->Cell($cellWidth, $cellHeight, '', 0, 0, 'C'); // Mantener el mismo espacio en blanco
            }

            $pdf->AddPage(); 
        }
        /////////////
      }








      $pdf->Output();
    
    ?>


