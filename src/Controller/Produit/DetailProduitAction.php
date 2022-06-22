<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class DetailProduitAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, ProduitRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $produit = $this->repository->findProduitById($this->args['produit']);
        $producteur = $this->repository->findProducteurByProduit($this->args['produit']);
        $nom_produit = $this->repository->findAllProduitById($this->args['produit']);
        $produit_similaire = $this->repository->findAllProduitByName($nom_produit);

        return $this->container->get('view')->render($this->response, 'produit/detailProduit.html.twig', [
            'produit' => $produit,
            'producteur' => $producteur,
            'similaire' => $produit_similaire,
            "session"=>$_SESSION]
        );
    }
}