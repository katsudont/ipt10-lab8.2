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
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Cell(0, 10, 'Profile of ' . $profile->getFullName(), 0, 1, 'C');

        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 10, 'Email: ' . $profile->getContactDetails()['email'], 0, 1);
        $this->pdf->Cell(0, 10, 'Phone: ' . $profile->getContactDetails()['phone_number'], 0, 1);
        
        // Address
        $address = implode(", ", $profile->getContactDetails()['address']);
        $this->pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
        
        // Education
        $this->pdf->Cell(0, 10, 'Education: ' . $profile->getEducation()['degree'] . ' at ' . $profile->getEducation()['university'], 0, 1);
        
        // Skills
        $this->pdf->Cell(0, 10, 'Skills: ');
        $this->pdf->Ln();
        foreach ($profile->getSkills() as $skill) {
            $this->pdf->Cell(0, 10, '- ' . $skill, 0, 1);
        }

        // Experience
        $this->pdf->Cell(0, 10, 'Experience:', 0, 1);
        foreach ($profile->getExperience() as $job) {
            $this->pdf->Cell(0, 10, '- ' . $job['job_title'] . ' at ' . $job['company'] . ' (' . $job['start_date'] . ' to ' . $job['end_date'] . ')', 0, 1);
        }

        // Certifications
        $this->pdf->Cell(0, 10, 'Certifications:', 0, 1);
        foreach ($profile->getCertifications() as $cert) {
            $this->pdf->Cell(0, 10, '- ' . $cert['name'] . "  " . "(" . $cert['date_earned'] .")", 0, 1);
        }

        // Extra-Curricular Activities
        $this->pdf->Cell(0, 10, 'Extra-Curricular Activities:', 0, 1);

        foreach ($profile->getExtracurricularActivities() as $acts) {
        $activityText = '- ' . $acts['role'] . " of " . $acts['organization'] . " (" 
                  . $acts['start_date'] . " to " . $acts['end_date'] . ")\n" 
                  . "Description: " . $acts['description'];
        $this->pdf->MultiCell(0, 10, $activityText, 0, 1);
        }


        // Languages
        $this->pdf->Cell(0, 10, 'Languages:', 0, 1);
        foreach ($profile->getLanguages() as $lan) {
            $this->pdf->Cell(0, 10, '- ' . $lan['language'] . ": " . $lan['proficiency'], 0, 1);
        }

        // References
        $this->pdf->Cell(0, 10, 'References:', 0, 1);

        foreach ($profile->getReferences() as $ref) {
        $referenceText = '- ' . $ref['name'] . "\n" 
                   . $ref['position'] . " at " . $ref['company'] . "\n" 
                   . $ref['email'] . "\n" 
                   . $ref['phone_number'];
        $this->pdf->MultiCell(0, 10, $referenceText, 0, 1);
        }

    }

    public function render()
    {
        // Output PDF to string (to save to file)
        return $this->pdf->Output();
    }
}
