<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManager;

class CategorieRepository
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllCategorie()
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idCategorie, nomCategorie')
            ->from('categorie')
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

}
