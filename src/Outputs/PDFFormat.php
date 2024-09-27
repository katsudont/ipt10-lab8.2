<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();

    
        $founderUrl = 'https://www.auf.edu.ph/home/images/articles/bya.jpg'; 
        $this->pdf->Image($founderUrl, 20, 3, 20); 

        $this->pdf->AddFont('Times', '', 'times.php'); 
        $this->pdf->SetFont('Times', 'B', 20); 
        $this->pdf->Cell(0, 10, 'Name:'.$profile->getName(), 0, 1, 'C');

        $this->pdf->AddFont('Times', '', 'times.php'); 
        $this->pdf->SetFont('Times', 'B', 14); 
        $this->pdf->Cell(0, 10, 'Story:', 0, 1, 'C'); 
        
        $this->pdf->SetFont('Times', '', 12); 
        $this->pdf->MultiCell(0, 10, $profile->getStory(), 0, 'C'); 
    }

    public function render()
    {
        return $this->pdf->Output('I', 'profile_' . time() . '.pdf'); 
    }
}