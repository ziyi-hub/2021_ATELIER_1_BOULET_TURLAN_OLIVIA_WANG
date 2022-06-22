<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\ORM\EntityManager;

class ProduitRepository
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllProduits(): array
    {
        $produits = $this->em->getRepository(Produit::class)->findAll();
        return $produits;
    }

    public function findProduitById(int $idProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('*')
            ->from('produit')
            ->where('idProduit = :idProduit')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findPriceOfProduct(string $idProduit){
        $query = $this->em->getConnection()->createQueryBuilder();
        $rows = $query
            ->select('tarifUnitaire')
            ->from('produit')
            ->where('idProduit = :idProduit')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProducteurByProduit(int $idProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('p.idUtilisateur, u.nomUtilisateur')
            ->from('produit', 'p')
            ->where('p.idProduit = :idProduit')
            ->leftJoin('p', 'utilisateur', 'u', 'p.idUtilisateur = u.idUtilisateur')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProduitsByProducteur(int $idProducteur){
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idProduit,tarifUnitaire, nomProduit')
            ->from('produit', 'p')
            ->where('p.idUtilisateur = :idUtilisateur')
            ->setParameter('idUtilisateur', $idProducteur)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findAllProduitById(int $idProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('nomProduit')
            ->from('produit')
            ->where('idProduit = :idProduit')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchOne();

        return $rows;
    }

    public function findAllProduitByName(string $nomProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idProduit')
            ->from('produit')
            ->where('nomProduit = :nomProduit')
            ->setParameter('nomProduit', $nomProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findCategorieByName()
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('p.idCategorie, c.nomCategorie')
            ->from('produit', 'p')
            ->leftJoin('p', 'categorie', 'c', 'p.idCategorie = c.idCategorie')
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findSelectedCategorie(int $idCategorie)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idProduit, nomProduit')
            ->from('produit')
            ->where('idCategorie = :idCategorie')
            ->setParameter('idCategorie', $idCategorie)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProduitByProducteur(int $idUtilisateur)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idProduit, nomProduit')
            ->from('produit')
            ->where('idUtilisateur = :idUtilisateur')
            ->setParameter('idUtilisateur', $idUtilisateur)
            ->execute()
            ->fetchAllAssociative();
          
         return $rows;
    }
  
    public function findAskQuantityOfProduct(int $idProduit){
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('p.idProduit, p.quantite, o.idUtilisateur, u.nomUtilisateur')
            ->from('panier','p')
            ->where('p.idProduit = :idProduit')
            ->leftJoin('p', 'produit', 'o', 'p.idProduit = o.idProduit')
            ->leftJoin('o', 'utilisateur', 'u', 'o.idUtilisateur = u.idUtilisateur')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findPanierProduitName(int $idProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('nomProduit')
            ->from('produit')
            ->where('idProduit = :idProduit')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }
}
