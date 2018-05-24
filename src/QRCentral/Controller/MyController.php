<?php

namespace App\QRCentral\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyController extends Controller
{
    /**
     * @Route("/app/q/r/central/my", name="app_q_r_central_my")
     */
    public function index()
    {
        return $this->render('app/qr_central/my/index.html.twig', [
            'controller_name' => 'MyController',
        ]);
    }
}
