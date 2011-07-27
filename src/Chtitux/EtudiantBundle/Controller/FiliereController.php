<?php
// Fichier ./Controller/FiliereController.php

namespace Chtitux\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Chtitux\EtudiantBundle\Entity\Etudiant;
use Chtitux\EtudiantBundle\Repository\EtudiantRepository;

class FiliereController extends Controller
{
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Filiere');
        $filieres = $repository->findAll();

        return $this->render('ChtituxEtudiantBundle:Filiere:index.html.twig', array('filieres' => $filieres));

    }

    public function showAction($id)
    {

        $repository = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Filiere');
        $filiere = $repository->find($id);

        if(!$filiere)
                throw $this->createNotFoundException('No filiere found for id '.$id);


        return $this->render('ChtituxEtudiantBundle:Filiere:show.html.twig', array('filiere' => $filiere));

    }

    public function showEtudiantsAction($promotion_slug, $filiere_slug)
    {

        $promotions = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Promotion')->findBySlug($promotion_slug);
        if(count($promotions) == 0)
            throw $this->createNotFoundException('No promotion found for slug '.$promotion_slug);
        else
            $promotion = $promotions[0];

        $filieres = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Filiere')->findBySlug($filiere_slug);
        if(count($filieres) == 0)
            throw $this->createNotFoundException('No filiere found for slug '.$filiere_slug);
        else
            $filiere = $filieres[0];

        $etudiants = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Etudiant')
          ->findBy(array('promotion' => $promotion->getId(), 'filiere' => $filiere->getId()));


        return $this->render('ChtituxEtudiantBundle:Filiere:show_etudiants.html.twig', array(
          'promotion'   => $promotion,
          'filiere'    => $filiere,
          'etudiants'   => $etudiants,
        ));

    }
}
