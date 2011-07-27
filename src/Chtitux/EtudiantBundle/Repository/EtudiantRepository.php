<?php
// Fichier ./Repository/EtudiantRepository.php

namespace Chtitux\EtudiantBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EtudiantRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT t FROM Chtitux\EtudiantBundle\Entity\Etudiant t
                                    ORDER BY t.lastname ASC')
                    ->getResult();
    }
}