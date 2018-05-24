<?php

namespace App\Controller;
// src/Controller/DefaultController.php
// ...

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>DashBoard Goes Here!</body></html>');
    }
}
