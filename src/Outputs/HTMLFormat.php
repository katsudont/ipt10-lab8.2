<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = <<<HTML
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile of {$profile->getName()}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        p {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
            text-align: justify;
        }
        .profile-img {
            display: block;
            width: 150px;
            height: 150px;
            margin: 20px auto;
            object-fit: cover;
            border: 3px solid #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Angeles University Foundation</h1>

        <!-- Profile Image -->
        <img src="https://www.auf.edu.ph/home/images/articles/bya.jpg" alt="Founder Image" class="profile-img">

        <!-- Profile Information -->
        <h2>{$profile->getName()}</h2>
        <p><strong>Founder</strong></p>
        <p>{$profile->getStory()}</p>
    </div>

</body>
</html>
HTML;

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/html');
        return $this->response;
    }
}
