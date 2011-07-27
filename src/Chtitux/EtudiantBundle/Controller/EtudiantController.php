<?php
// Fichier ./Controller/EtudiantController.php

namespace Chtitux\EtudiantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Chtitux\EtudiantBundle\Entity\Etudiant;
use Chtitux\EtudiantBundle\Repository\EtudiantRepository;

class EtudiantController extends Controller
{
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Etudiant');
        $etudiants = $repository->findAll();

        return $this->render('ChtituxEtudiantBundle:Etudiant:index.html.twig', array('etudiants' => $etudiants));

    }

    public function showAction($id)
    {

        $repository = $this->getDoctrine()->getRepository('ChtituxEtudiantBundle:Etudiant');
        $etudiant = $repository->find($id);

        if(!$etudiant)
                throw $this->createNotFoundException('No etudiant found for id '.$id);


        return $this->render('ChtituxEtudiantBundle:Etudiant:show.html.twig', array('etudiant' => $etudiant));

    }
}