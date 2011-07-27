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

        $promotions = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Promotion')->findAll();

        return $this->render('ChtituxEtudiantBundle:Promotion:index.html.twig', array('promotions' => $promotions));

    }

    public function showAction($id)
    {

        $promotion = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Promotion')->find($id);

        if(!$promotion)
                throw $this->createNotFoundException('No promotion found for id '.$id);


        return $this->render('ChtituxEtudiantBundle:Promotion:show.html.twig', array(
          'promotion'   => $promotion,
        ));

    }

    public function showFilieresAction($promotion_slug)
    {

        $promotion = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Promotion')->findBySlug($promotion_slug);

        if(count($promotion) == 0)
                throw $this->createNotFoundException('No promotion found for slug '.$promotion_slug);

        $filieres = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Filiere')->findAll();


        return $this->render('ChtituxEtudiantBundle:Promotion:show_filieres.html.twig', array(
          'promotion'   => $promotion[0],
          'filieres'    => $filieres,
        ));

    }
}
