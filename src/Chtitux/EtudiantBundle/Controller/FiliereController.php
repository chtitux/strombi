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
}
