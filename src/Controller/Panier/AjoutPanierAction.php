<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class   AjoutPanierAction extends ActionController{

    public $container;
    private $produitRepository;

    public function __construct(ContainerInterface $container,ProduitRepository $produitRepository)
    {
        $this->container = $container;
        $this->produitRepository = $produitRepository;
    }

    protected function action():Response
    {
        $produitId = (int) $this->args['id'];
        $parsedBody = $this->request->getParsedBody();
        $prix = $this->produitRepository->findPriceOfProduct($this->args['id']);
        $nomProduit = $this->produitRepository->findPanierProduitName($this->args['id']);
        $quantite = htmlspecialchars($parsedBody['quantite']);
        if (isset($_SESSION['panier'])){
            $panier = ($_SESSION['panier']);
            array_push($panier,array(
                'idProduit' => $produitId,
                'quantiteProduit' => $quantite,
                'prix' => $prix[0]['tarifUnitaire'],
                'nom' => $nomProduit[0]['nomProduit']));
        }else{
            $panier = array(array('idProduit'=>$produitId,'quantiteProduit'=>$quantite,'prix' => $prix[0]['tarifUnitaire'],
                'nom' => $nomProduit[0]['nomProduit']));
        }
        $_SESSION['panier'] = ($panier);


        return $this->response
            ->withHeader('location','/nosproduits')
            ->withStatus(302);
    }
}