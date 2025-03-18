<?php

require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");
use Dompdf\Dompdf;

function gerarPdf($htmlContent, $title)
{
    $dompdf = new Dompdf(['chroot' => __DIR__]);
    $dompdf->setBasePath(realpath(dirname(__DIR__)));

    $options = $dompdf->getOptions();
    $options->setDefaultFont('Arial');
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); // Habilita recursos remotos
    $dompdf->setOptions($options);

    $dompdf->setPaper([0, 0, 800, 1200]);

    //$htmlContent = htmlspecialchars($htmlContent, ENT_QUOTES, 'UTF-8');

    $dompdf->loadHtml($htmlContent);
    $dompdf->render();

    if (ob_get_length()) {
        ob_end_clean();
    }

    $dompdf->stream($title . ".pdf", array('Attachment' => 0));
}