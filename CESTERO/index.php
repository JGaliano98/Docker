<?php
    require_once "./vendor/autoload.php";
    use Dompdf\Dompdf;
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $pdfprovisional=new Dompdf();

        $pdfprovisional->getOptions()->setChroot('../RECURSOS/jamon.jpg');

        $html='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <table>
                <thead>
                    <th>
                        Hola
                    </th>
                    <th>
                        Tu Jamón
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>PDF</td>
                    </tr>
                </tbody>
            </table>
            <img src="../RECURSOS/jamon.jpg">
        </body>
        </html>';

        

        $pdfprovisional->setPaper("A4", "portrait");
        # Cargamos el contenido HTML.
        $pdfprovisional->loadHtml($html);

        # Renderizamos el documento PDF.
        $pdfprovisional->render();

        # Creamos un fichero
        echo $pdfprovisional->output();
    }

?>