<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\RegionalModel;
use CodeIgniter\Config\Config;
use Dompdf\Dompdf;

class CetakKartu extends BaseController
{
    public function cetak() {
        $pdf = new Dompdf();
        $pdf->load_html('<h1 style="text-align: center"> Hello World</h1>');
                // (Optional) Setup the paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to Browser
        $pdf->stream();
    }
}
