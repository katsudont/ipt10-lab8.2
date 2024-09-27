<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "Full Name: " . $profile->getFullName() . PHP_EOL;
        $output .= "Email: " . $profile->getContactDetails()['email'] . PHP_EOL;
        $output .= "Phone: " . $profile->getContactDetails()['phone_number'] . PHP_EOL;
        $output .= "Address: " . implode(", ", $profile->getContactDetails()['address']) . PHP_EOL;
        $output .= "Education: " . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . PHP_EOL;
        $output .= "Skills: " . implode(", ", $profile->getSkills()) . PHP_EOL;

        // Experience
        $output .= "\nExperience:\n";
        foreach ($profile->getExperience() as $job) {
            $output .= "- " . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")\n";
        }
        $this->response = $output;

        //Certifications
        $output .= "\nCertifications:\n";
        foreach ($profile->getCertifications() as $cert) {
            $output .= "- " . $cert['name'] . "  " . "(" . $cert['date_earned'] .")\n";
        }
        $this->response = $output;

        //Extra-Curricular Activities
        $output .= "\nExtra-Curricular Activities:\n";
        foreach ($profile->getExtracurricularActivities() as $acts) {
            $output .= "- " . $acts['role'] . " of " . $acts['organization'] . " (" . $acts['start_date'] . " to " . $acts['end_date'] .")\n " . 'Description: '. $acts['description']."\n";
        }
        $this->response = $output;

        //Languages
        $output .= "\nLanguages:\n";
        foreach ($profile->getLanguages() as $lan) {
            $output .= "- " . $lan['language'] . ": " . $lan['proficiency']."\n";
        }
        $this->response = $output;

        //References
        $output .= "\nReferences:\n";
        foreach ($profile->getReferences() as $ref) {
            $output .= "- " . $ref['name'] . "\n " . $ref['position']. " at ". $ref['company']. "\n " . $ref['email'] . "\n " . $ref['phone_number']."\n";
        }
        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text');
        return $this->response;
    }
}
