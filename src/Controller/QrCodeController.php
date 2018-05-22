<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\QrDatabseManager;

class QrCodeController extends Controller
{
   
    /**
     * @Route("/qr/code", name="qr_code")
     */
    public function index(EntityManagerInterface $em)
    {
        $QrDb=new QrDatabseManager($em);
        return $this->render('qr_code/index.html.twig', [
            'controller_name' => 'QrCodeController',
            'qrCodes' => $QrDb->getQrCodes(),
            'write' => $QrDb->writeQrCode(),
        ]);
    }
}
