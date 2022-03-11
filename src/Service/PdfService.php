<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $domPdf;

    public function __construct(){
        $this->domPdf = new Dompdf();
       $pdf_options = new Options();
       $pdf_options->set('defaultFont','Monserrat');
       $this->domPdf->setOptions($pdf_options);
    }

    public function showPdf($html)
    {
        // instantiate and use the dompdf class
        $this->domPdf->loadHtml($html);
        // Render the HTML as PDF
        $this->domPdf->render();
        // Output the generated PDF to Browser
        $this->domPdf->stream("detail.pdf",[
            'Attachement'=> false
        ]);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
    }

    public function generateBinaryPdf($html)
    {
        // instantiate and use the dompdf class
        $this->domPdf->loadHtml($html);
        // Render the HTML as PDF
        $this->domPdf->render();

        $this->domPdf->output();
    }
    
}
