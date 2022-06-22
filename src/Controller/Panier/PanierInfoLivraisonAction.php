<?php

namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Utilisateur;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class PanierInfoLivraisonAction extends ActionController
{

    public $container;
    private $produitRepository;

    public function __construct(ContainerInterface $container,
                                ProduitRepository $produitRepository,
                                EntityManager $em,
                                UtilisateurRepository $utilisateurRepository, CommandeRepository $commanderepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->commanderepository = $commanderepository;
        $this->em = $em;
        $this->container = $container;
        $this->produitRepository = $produitRepository;
    }

    protected function action(): Response
    {   $nom = htmlentities($_POST['nom']);
        $mail = htmlentities($_POST['mail']);
        $numTel = htmlentities($_POST['numTel']);
        $adresse = htmlentities($_POST['adresse']);
        $montant = htmlentities($_POST['montant']);

        $user = new Utilisateur(null, $nom, $adresse,$mail,"", 0, $numTel);
        $this->em->persist($user);
        $this->em->flush();
        $requeteUsers = $this->utilisateurRepository->findUtilisateurByMail($mail);;
        $idUtilisateur = (int)$requeteUsers[0]['idUtilisateur'];
        $user->setIdutilisateur($idUtilisateur);

        $montant = htmlentities($_POST['montant']);
        $commande = new Commande(null, $montant, 0, 0, $user);
        $this->em->persist($commande);
        $this->em->flush();
        $panier = $_SESSION['panier'];
        //*find id commande*/
        $idCommande = $this->commanderepository->findCommandeOfUser($idUtilisateur);

        foreach ($panier as $ligne) {
            $idproduit = $ligne['idProduit'];
            $quantite = $ligne['quantiteProduit'];
            $panier = new Panier(null, $idproduit, $idCommande, $quantite);
            $this->em->persist($panier);
        }
        $this->em->flush();
        $_SESSION['panier']=[];
        return $this->response
            ->withHeader('location', '/') 
            ->withStatus(302);
    }
}