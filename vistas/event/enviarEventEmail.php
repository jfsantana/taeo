<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';  // Asegúrate de que la ruta sea correcta

// Step 1: Recibir el idEvento desde la solicitud
$idEvento = $_GET['idEvento'];

// Step 2: Obtener los datos del evento usando el idEvento desde la API REST
$apiUrl = "http://taeo/funciones/wsdl/event?type=2&idEvento=" . $idEvento;
$response = file_get_contents($apiUrl);

// Step 3: Decodificar la respuesta JSON de la API
$eventData = json_decode($response, true);

// Step 4: Preparar los datos del evento para el envío del correo
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.organizaciontaeo.com'; // Reemplaza con tu servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'info@organizaciontaeo.com'; // Reemplaza con tu correo
    $mail->Password = '_9H)GfPp(~w_'; // Reemplaza con tu contraseña
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Helo = 'organizaciontaeo.com'; // Configura el nombre HELO

 
    // Habilitar el modo de depuración
    $mail->SMTPDebug = 2; // Puedes usar 2 para obtener información detallada
    $mail->Debugoutput = 'html'; // Mostrar la salida de depuración en formato HTML

    // Configurar la codificación de caracteres
    $mail->CharSet = 'UTF-8';


    // Destinatarios
    $mail->setFrom('info@organizaciontaeo.com', 'Organización TAEo'); // Usa una dirección permitida por el servidor SMTP
    $mail->addAddress('jfsantana77@gmail.com');
    $mail->addAddress('anagabrielagutierrez1@gmail.com');

    //    // Incrustar la imagen en el correo
    //    $imagePath = $eventData[0]['flayerImg'];
    //    $mail->addEmbeddedImage($imagePath, 'flayerImg');

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