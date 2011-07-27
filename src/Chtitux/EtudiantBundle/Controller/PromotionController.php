<?php
// Fichier ./Controller/PromotionController.php

namespace Chtitux\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Chtitux\EtudiantBundle\Entity\Etudiant;
use Chtitux\EtudiantBundle\Repository\EtudiantRepository;

class PromotionController extends Controller
{
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Promotion');
        $promotions = $repository->findAll();

        return $this->render('ChtituxEtudiantBundle:Promotion:index.html.twig', array('promotions' => $promotions));

    }

    public function showAction($id)
    {

        $repository = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Promotion');
        $promotion = $repository->find($id);

        if(!$promotion)
                throw $this->createNotFoundException('No promotion found for id '.$id);


        return $this->render('ChtituxEtudiantBundle:Promotion:show.html.twig', array('promotion' => $promotion));

    }
}
