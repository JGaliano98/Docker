<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "./vendor/autoload.php";
        $recibe=$_POST['recibe'];
        $nombre=$_POST['nombre'];
        $enviar=isset($_POST['enviar']);
        if ($enviar){
            try {
                $client = new GuzzleHttp\Client();

                $res = $client->request('POST', 'http://correo', [
                    'form_params' => [
                  
                        'recibe' => $recibe,
                        'nombre' => $nombre
                    ]
                ]);
                echo $res->getBody();
            } catch (GuzzleHttp\Exception\RequestException $e) {
                // Manejar errores de Guzzle
                echo 'Error: ' . $e->getMessage();
                if ($e->hasResponse()) {
                    echo 'Response: ' . $e->getResponse()->getBody()->getContents();
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="application/x-www-form-urlencoded">
        <label>INTRODUZCA EL DESTINATARIO</label><br>
        <input type="email" name="recibe"><br><br>
        <label>INTRODUZCA EL NOMBRE DEL DESTINATARIO</label><br>
        <input type="email" name="nombre"><br><br>
        <input type="submit" name="enviar" value="ENVIAR">
    </form>
</body>
</html>