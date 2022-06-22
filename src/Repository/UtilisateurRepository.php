<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;

class UtilisateurRepository 
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllProducteursByRole(int $roleId)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idUtilisateur, nomUtilisateur')
            ->from('utilisateur')
            ->where('roleId = :roleId')
            ->setParameter('roleId', $roleId)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProducteurById(int $idUtilisateur)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('nomUtilisateur, mail, numTel')
            ->from('utilisateur')
            ->where('idUtilisateur = :idUtilisateur')
            ->setParameter('idUtilisateur', $idUtilisateur)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findUtilisateurByMail(string $mail){
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('*')
            ->from('Utilisateur')
            ->where('mail = :mail')
            ->setParameter('mail', $mail)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findClientById(int $roleId)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idUtilisateur, nomUtilisateur, numTel, mail, adresse')
            ->from('utilisateur')
            ->where('roleId = :roleId')
            ->setParameter('roleId', $roleId)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function addClientInfo(string $nom, string $numTel, string $mail, string $adresse)
    {
        $values = [
            'nomUtilisateur' => $nom,
            'numTel' => $numTel,
            'mail' => $mail,
            'adresse'=> $adresse,
            'roleId' => '0'
        ];

        return $this->em->getConnection()->insert('utilisateur', $values);
    }

}
