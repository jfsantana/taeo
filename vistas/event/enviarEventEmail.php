<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';  // Asegúrate de que la ruta sea correcta

$idEvento = $_GET['idEvento'];

if (!isset($idEvento)) {
    echo 'No se ha proporcionado un ID de evento.';
    exit;
}

$apiUrl = "http://taeo/funciones/wsdl/event?type=2&idEvento=" . $idEvento;
$response = file_get_contents($apiUrl);
$eventData = json_decode($response, true);

if (empty($eventData)) {
    echo 'No se encontraron datos para el evento con ID ' . $idEvento;
    exit;
}

$apiUrl = "http://taeo/funciones/wsdl/config?type=2&tipo=email";
$response = file_get_contents($apiUrl);
$mailData = json_decode($response, true);

$mail = new PHPMailer(true);
//print("<pre>".print_r(($mailData),true)."</pre>");  die;
try {
/**************HASTA AQUI PARA EL REQUIRE_ONCE ****************************************
    /******************
 * hay que hacer un endpoint que retorne los datos del envio de los correos esos ta estan en la BD
 * esta seccion se puede mejorar colocadolo en un archivo y haciendo un require_once
 */

    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = $mailData[7]['valor'];//'mail.organizaciontaeo.com'; // Reemplaza con tu servidor SMTP
    $mail->SMTPAuth = $mailData[6]['valor'];  //true;
    $mail->Username = $mailData[1]['valor']; // 'info@organizaciontaeo.com'; // Reemplaza con tu correo
    $mail->Password = $mailData[2]['valor']; // '_9H)GfPp(~w_'; // Reemplaza con tu contraseña
    $mail->SMTPSecure = $mailData[4]['valor']; // 'tls';
    $mail->Port = $mailData[3]['valor'];// 587;
    $mail->Helo = $mailData[5]['valor'];//  'organizaciontaeo.com'; // Configura el nombre HELO
    $mail->SMTPDebug = 1; // Puedes usar 2 para obtener información detallada
    $mail->Debugoutput = 'html'; // Mostrar la salida de depuración en formato HTML
    $mail->CharSet = 'UTF-8';

/**************HASTA AQUI PARA EL REQUIRE_ONCE *****************************************/

    // Destinatarios
    $mail->setFrom('info@organizaciontaeo.com', 'Organización TAEo'); // Usa una dirección permitida por el servidor SMTP
    $mail->addAddress('jfsantana77@gmail.com');
    //$mail->addAddress('anagabrielagutierrez1@gmail.com');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = "Detalles del Evento: " . $eventData[0]['nombreEvento'];
    $mail->Body    = "
    <html>
    <head>
    <title>Detalles del Evento</title>
    </head>
    <body>
    <p>Nombre del Evento: " . $eventData[0]['nombreEvento'] . "</p>
    <p>Descripción: " . $eventData[0]['descripcionEvento'] . "</p>
    <p>Lugar: " . $eventData[0]['lugarEvento'] . "</p>
    <p>Fecha: " . $eventData[0]['fechaEvento'] . "</p>
    <p>Organizado por: " . $eventData[0]['organizadoPor'] . "</p>
    <img src='" . $eventData[0]['flayerImg'] . "' alt='" . $eventData[0]['flayerName'] . "' />
    </body>
    </html>
    ";

    $mail->send();
    echo 'Correo enviado exitosamente.';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>