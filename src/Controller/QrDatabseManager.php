<?php

namespace App\Controller;


use App\Entity\QrCode;
use Doctrine\ORM\EntityManagerInterface;

class QrDatabseManager
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    function getQrCodes($username = FALSE, $num = 10){
        $repository =  $this->em->getRepository(QrCode::class);
        //$qrcodes = $username ? $repository->findOneByCreator(['creator'=> $username]) : $repository->findAll();
        $qrcodes = $repository->findBy(['creator'=> $username]);
        return($qrcodes);
    }
    function writeQrCode($username, $codename, $campaign, $qrdata){
        $entityManager = $this->em;

        $QrCode = new QrCode;
        $QrCode->setCreator($username);
        $QrCode->setName($codename);
        $QrCode->setCampaign($campaign);
        $QrCode->setImage($qrdata);
        $QrCode->setViews(0);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($QrCode);
        $entityManager->flush();
       // actually executes the queries (i.e. the INSERT query)
       return true;
    }

}
