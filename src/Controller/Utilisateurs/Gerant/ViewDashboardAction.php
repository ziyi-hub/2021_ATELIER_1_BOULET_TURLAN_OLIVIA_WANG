<?php
namespace App\Controller\Utilisateurs\Gerant;

use App\Controller\ActionController;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class ViewDashboardAction extends ActionController{

    public $container;
    private $produitRepository;
    private $utilisateurRepository;

    public function __construct(
        ContainerInterface $container,
        ProduitRepository $produitRepository, 
        UtilisateurRepository $utilisateurRepository,
        CommandeRepository $commandeRepository)
    {
        $this->container = $container;
        $this->produitRepository = $produitRepository;
        $this->utilisateurRepository = $utilisateurRepository;
        $this->commandeRepository = $commandeRepository;
    }

    protected function action():Response
    {
        $requeteNbCommande = $this->commandeRepository->findNumberOfCommande();
        $nbCommandesGlobal = $requeteNbCommande[0]['count(idCommande)'];
        $nbClientGlobal = $nbCommandesGlobal;
        //echo $nbCommandesGlobal;
        $producteurs = $this->utilisateurRepository->findAllProducteursByRole(1);
        $caGlobal = 0;
        $nbProducteurs=0;
        $tabCAProducteurs = [];
        foreach ($producteurs as $producteur) {
            $nbProducteurs += 1;
            $caProducteur = 0;
            $nomProducteur = $producteur['nomUtilisateur'];
            $produits = $this->produitRepository->findProduitsByProducteur($producteur['idUtilisateur']);
            foreach ($produits as $produit){
                $quantites = $this->produitRepository->findAskQuantityOfProduct($produit['idProduit']);
                $prix = (float)$produit['tarifUnitaire'];
                $quantiteDuProduit = 0;
                foreach  ($quantites as $quantite){
                    $quantiteDuProduit += (float)$quantite['quantite'];
                }
                $total = $prix * $quantiteDuProduit;
                $caProducteur += $total;
            }
            array_push($tabCAProducteurs,array('nomProducteur'=>$nomProducteur,'caProducteur'=>$caProducteur));
            $caGlobal += $caProducteur;
        }
        
        return $this->container->get('view')->render($this->response, 'utilisateurs/gerant/dashboard.html.twig',[
            "session"=>$_SESSION,
            "nbProducteurs"=>$nbProducteurs,
            "caGlobal"=>$caGlobal,
            "nbCommandesGlobal"=>$nbCommandesGlobal,
            "nbClientGlobal"=>$nbClientGlobal,
            "caProducteurs"=>$tabCAProducteurs
        ]);                
    }

}