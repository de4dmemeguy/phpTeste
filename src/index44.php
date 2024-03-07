<?php
    

    require_once 'vendor/autoload.php';

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $dompdf->loadHtml("Olá Calabresos");

    //$dompdf->set_option('defaltFont', 'sans');

    $dompdf->setPaper('A4', 'portrait'); //landscape

    $dompdf->render();

    $dompdf->stream();
?>