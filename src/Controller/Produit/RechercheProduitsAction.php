<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class RechercheProduitsAction extends ActionController{

    public $container;
    public $produitRepository;
    public $categorieRepository;
    public $utilisateurRepository;

    public function __construct(ContainerInterface $container, ProduitRepository $produitRepository, CategorieRepository  $categorieRepository, UtilisateurRepository $utilisateurRepository)
    {
        $this->container = $container;
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
        $this->utilisateurRepository = $utilisateurRepository;
    }

    protected function action():Response
    {
        $categorie = $this->categorieRepository->findAllCategorie();
        $recherche = $this->produitRepository->findSelectedCategorie($this->args['categories']);
        $producteur = $this->utilisateurRepository->findAllProducteursByRole(1);

        return $this->container->get('view')->render($this->response, 'produit/listeProduitsRecherche.html.twig', [
            'recherche' => $recherche,
            'producteur' => $producteur,
            'categorie' => $categorie
        ]);
    }

}