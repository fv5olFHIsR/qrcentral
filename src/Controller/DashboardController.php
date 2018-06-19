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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Controller\QrCodeController;

class DashboardController extends Controller
{
    
    /**
     * @Route("/dashboard/", name="dashboard")
     */
    public function index(EntityManagerInterface $em)
    {
        $this->getUser() ? $user_role=$this->getUser()->getRoles() : $user_role="Not logged in";
        $code_controller=new QrCodeController;
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'QrCodsseController',
            'user' => $user_role,
            'qrcode'=> $code_controller->renderCodeData("Welcome to QRCentral"),
        ]);
    }
     /**
     * @Route("/dashboard/analytics/", name="qr_analytics")
     * @Method({"GET"})
     */
    public function analyticsIndex(EntityManagerInterface $em)
    {
        $user_name = $this->getUser()->getUserName();
        $QrDb=new QrDatabseManager($em);
        return $this->render('dashboard/analytics.html.twig', [
            'controller_name' => 'QrCodsseController',
            'qrCodes' => $QrDb->getQrCodes($user_name),
        ]);
    }
    /**
     * @Route("/dashboard/tracked/", name="tracked_qr")
     * @Method({"GET"})
     */
    public function trackedIndex(EntityManagerInterface $em)
    {
        $render_data=array();
        $request = Request::createFromGlobals();
        if($request->query->get('status')){
        $request->query->get('status')=="ok" ? 
            $message=array(
                'title'=>'Success',
                'text'=>'Your QR Code was successfuly saved'
            )
            :
            $message=array(
                'title'=>'FAIL',
                'text'=>'You failed in saving your code'
            );
            $render_data=["message"=>$message];
        }
        
        $user_role = $this->getUser() ? $this->getUser()->getRoles() : "Not logged in";
        $code_controller=new QrCodeController;
        $user_name = $this->getUser()->getUserName();

        $QrDb=new QrDatabseManager($em);

        $render_data = array_merge($render_data, [
            'controller_name' => 'QrCodsseController',
            'qrCodes' => $QrDb->getQrCodes($user_name),
            'user' => $user_role,
            'qrcode'=> $code_controller->renderCodeData("Welcome to QRCentral :)"),
        ]);

    
        return $this->render('dashboard/tracked.html.twig', $render_data);
    }
    /**
     * @Route("/dashboard/tracked/save", name="save_qr_code")
     * @Method({"POST"})
     */
    public function saveIndex(EntityManagerInterface $em)
    {
        $request = Request::createFromGlobals();
        $user_role = $this->getUser() ? $this->getUser()->getRoles() : "Not logged in";
        $code_controller=new QrCodeController;
        $QrDb=new QrDatabseManager($em);
        
        
        $user_name = $this->getUser()->getUserName();
        $code_name = $request->request->get('code_name');
        $code_data = $request->request->get('qr_link');
        $campaign_selector = $request->request->get('new_campaign_name');
        $campaign_name = $request->request->get('campaign') == "new_campaign" ? $request->request->get('new_campaign_name') : $request->request->get('campaign');

        $code_write_status = $QrDb->writeQrCode($user_name, $code_name, "SELTEST", $code_data) ? "ok" : "error";

        return $this->redirect($this->generateUrl('tracked_qr', array('status'=> $code_write_status)));
    }
}
