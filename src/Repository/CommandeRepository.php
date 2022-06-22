<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\ORM\EntityManager;

class CommandeRepository
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllCommandesWithClientName(): array
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $commandes = $query
            ->select('c.*, u.nomUtilisateur')
            ->from('commande', 'c')
            ->leftJoin('c', 'utilisateur', 'u', 'c.idUtilisateur = u.idUtilisateur')
            ->execute()
            ->fetchAllAssociative();

        return $commandes;
    }

    public function findOneById(int $id)
    {

        $query = $this->em->getConnection()->createQueryBuilder();

        $commande = $query
            ->select('c.*, u.nomUtilisateur, u.adresse')
            ->from('commande', 'c')
            ->where('idCommande=:idCommande')
            ->setParameter('idCommande', $id)
            ->leftJoin('c', 'utilisateur', 'u', 'c.idUtilisateur = u.idUtilisateur')
            ->execute()
            ->fetchAllAssociative();

        return $commande;
    }

    public function findProduitsDeLaCommande($idCommande): array
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $produits = $query
            ->select('p.idProduit, p.nomProduit, panier.quantite')
            ->from('panier', 'panier')
            ->where('idCommande=:idCommande')
            ->setParameter('idCommande', $idCommande)
            ->leftJoin('panier', 'produit', 'p', 'panier.idProduit = p.idProduit')
            ->execute()
            ->fetchAllAssociative();

        return $produits;
    }

    public function findCommandeOfUser($idUtilisateur)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idCommande')
            ->from('commande')
            ->where('idUtilisateur = :idUtilisateur')
            ->setParameter('idUtilisateur', $idUtilisateur)
            ->execute()
            ->fetchOne();

        return $rows;


    }

    public function findNumberOfCommande(){
        $query = $this->em->getConnection()->createQueryBuilder();

        $produits = $query
            ->select('count(idCommande)')
            ->from('commande')
            ->execute()
            ->fetchAllAssociative();

        return $produits;
    }

    public function findFactureByIdCom($idCommande)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('numFacture')
            ->from('facture')
            ->where('idCommande = :idCommande')
            ->setParameter('idCommande', $idCommande)
            ->execute()
            ->fetchOne();

        return $rows;
    }

    public function addCommande(string $montant)
    {
        $values = [
            'montant' => $montant
        ];

        return $this->em->getConnection()->insert('commande', $values);
    }

    public function addUser($idCommande, $idUtilisateur)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->update('commande')
            ->set('idUtilisateur', ':idUtilisateur')
            ->where('idCommande = :idCommande')
            ->setParameter('idUtilisateur',$idUtilisateur)
            ->setParameter('idCommande', $idCommande)
            ->execute();

        return $rows;
    }


    public function findMontantByMontant($montant)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('montant')
            ->from('commande')
            ->where('montant = :montant')
            ->setParameter('montant', $montant)
            ->execute()
            ->fetchOne();

        return $rows;
    }

    public function findCommandeByMontant($montant)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('idCommande')
            ->from('commande')
            ->where('montant = :montant')
            ->setParameter('montant', $montant)
            ->execute()
            ->fetchOne();

        return $rows;
    }

}
