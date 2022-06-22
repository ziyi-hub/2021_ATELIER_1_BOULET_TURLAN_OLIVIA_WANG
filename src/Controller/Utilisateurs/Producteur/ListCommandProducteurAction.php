<?php
namespace App\Controller\Utilisateurs\Producteur;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class ListCommandProducteurAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container,
        UtilisateurRepository $repository,
        ProduitRepository $produitRepository)
    {
        $this->container = $container;
        $this->repository = $repository;
        $this->produitRepository = $produitRepository;
    }

    protected function action():Response
    {
        $ProducteurId = (int) $this->args['id'];
        $producteurs = $this->repository->findProducteurById($ProducteurId);
        $producteur = $producteurs[0];
        // Recuperer les produits du producteur : 
        $nomProducteur = $producteur['nomUtilisateur'];
        $produits = $this->produitRepository->findProduitsByProducteur($ProducteurId);
        $tabAskProduit = [];
            foreach ($produits as $produit){
                $quantites = $this->produitRepository->findAskQuantityOfProduct($produit['idProduit']);
                $quantiteDuProduit = 0;
                foreach  ($quantites as $quantite){
                    
                    $quantiteDuProduit += (float)$quantite['quantite'];
                }
                array_push($tabAskProduit,array('nomProduit'=>$produit['nomProduit'],'quantiteProduit'=>$quantiteDuProduit));
            }
        return $this->container->get('view')->render($this->response, 'utilisateurs/producteur/commandesProducteurs.html.twig',[
            'producteur' => $producteur,
            "tabQuantiteProduits"=>$tabAskProduit,
            "session"=>$_SESSION
        ]);
    }
}