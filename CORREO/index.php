<?php
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ahora, $datos es un array que contiene los datos enviados en el cuerpo de la solicitud
    // Puedes acceder a cada elemento así:
    $contenido="";
    try {
        $client = new GuzzleHttp\Client();

        $res = $client->request('POST', 'http://cestero');
        $contenido=$res->getBody();
    } catch (GuzzleHttp\Exception\RequestException $e) {
        // Manejar errores de Guzzle
        echo 'Error: ' . $e->getMessage();
        if ($e->hasResponse()) {
            echo 'Response: ' . $e->getResponse()->getBody()->getContents();
        }
    }

    $filename = "navidad.pdf";
    file_put_contents($filename, $contenido);

    $recibe = $_POST['recibe'];
    $nombre = $_POST['nombre'];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    // cambiar a 0 para no ver mensajes de error
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    // introducir usuario de google
    $mail->Username = "jlopgal0606@g.educaand.es";
    // introducir clave
    $mail->Password = "vxns xigb kuef sfod";
    $mail->SetFrom($recibe, 'Cesta de Navidad');
    // asunto
    $mail->Subject = "¿Mereces cesta de navidad?";
    $mail->isHTML(true);
    //$mail->AddEmbeddedImage("foto.png", 'logoimg', 'foto.png');
    // cuerpo
    $mail->MsgHTML("Mensaje");
    // adjuntos
    //$mail->addAttachment("hola.html");
    // destinatario
    $address = $recibe;
    $mail->AddAddress($address, "Test");
    $mail->addAttachment($filename, 'Docker');
    // enviar
    $resul = $mail->Send();
    if (!$resul) {
        echo "Error" . $mail->ErrorInfo;
    } else {
        echo "El gmail ha sido enviado correctamente";
    }
}
?>
