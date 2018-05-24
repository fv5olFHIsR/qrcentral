<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\QrDatabseManager;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QrCodeController extends Controller
{
   
    /**
     * @Route("/qr/code", name="qr_code")
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
        

        //var_dump($qrcode);
        //die;
        $QrDb=new QrDatabseManager($em);
        return $this->render('qr_code/index.html.twig', [
            'controller_name' => 'QrCodeController',
            'qrCodes' => $QrDb->getQrCodes(),
            'write' => $QrDb->writeQrCode(),
            'qrcode'=> $qrcode->render($qrdata),
        ]);
    }
}
