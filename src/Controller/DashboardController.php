<?php

namespace App\Controller;
// src/Controller/DefaultController.php
// ...

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\QrDatabseManager;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;


class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(EntityManagerInterface $em)
    {

        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);
        
        // invoke a fresh QRCode instance
        $qrcode = new QRCode($options);
        // and dump the output
        $qrdata='https://google.com';
        

        if($this->getUser()){
            $user_role=$this->getUser()->getRoles();
        }
        else{
            $user_role="Not logged in";
        }
        //var_dump($qrcode);
        //die;
        //$QrDb->writeQrCode() to create a new code
        $QrDb=new QrDatabseManager($em);
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'QrCodsseController',
            'qrCodes' => $QrDb->getQrCodes(),
            'user' => $user_role,
            'qrcode'=> $qrcode->render($qrdata),
        ]);
    }
}
