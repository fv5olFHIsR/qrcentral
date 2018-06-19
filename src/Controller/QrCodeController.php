<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\QrDatabseManager;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// color options
// 'moduleValues' => [
//     // finder
//     1536 => '#520E8F', // dark (true)
//     6    => '#FFFFFF', // light (false)
//     // alignment
//     2560 => '#520E8F',
//     10   => '#FFFFFF',
//     // timing
//     3072 => '#98005D',
//     12   => '#FFFFFF',
//     // format
//     3584 => '#520E8F',
//     14   => '#98005D',
//     // version
//     4096 => '#650098',
//     16   => '#E0B8FF',
//     // data
//     1024 => '#A41B8F',
//     4    => '#FFFFFF',
//     // darkmodule
//     512  => '#080063',
//     // separator
//     8    => '#FFFFFF',
//     // quietzone
//     18   => '#FFFFFF',
// ],

class QrCodeController extends Controller
{
    public function renderCodeData($data, $scale=5){
        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
            'scale' => $scale
        ]);
        $qrcode = new QRCode($options);
        return $qrcode->render($data);
    }
    /**
     * @Route("/qr/code", name="qr_code")
     * @Method({"POST"})
     */
    public function index(EntityManagerInterface $em)
    {
        $request = Request::createFromGlobals();
        $qrdata = $request->request->get('data') ? $request->request->get('data') : "No data";
        $scale = $request->request->get('scale') ? $request->request->get('scale') : 5;
        $QrDb = new QrDatabseManager($em);
        return new Response($this->renderCodeData($qrdata, $scale));
    }
}
