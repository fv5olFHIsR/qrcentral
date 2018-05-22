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

    function getQrCodes($num = 10){
        $repository =  $this->em->getRepository(QrCode::class);
        $qrcodes = $repository->findAll();
        return($qrcodes);
    }
    function writeQrCode(){
        $entityManager = $this->em;

        $QrCodes = new QrCode;
        $QrCodes->setCreator("Joseph");
        $QrCodes->setName("FirstQr");
        $QrCodes->setImage("http://someimage.com");
        $QrCodes->setViews(0);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($QrCodes);
       // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return("Successfully added");
    }

}
