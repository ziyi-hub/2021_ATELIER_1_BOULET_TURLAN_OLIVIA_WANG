<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class SuppressionPanierAction extends ActionController{

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
        //$group = $this->groupRepository->find($groupId);
        $parsedBody = $this->request->getParsedBody();
        $quantite = htmlspecialchars($parsedBody['quantite']);
        if (isset($_SESSION['panier'])){
            $panier = ($_SESSION['panier']);
            $nouveauPanier = [];
            foreach ($panier as $ligne) {
                if($ligne['idProduit'] != $produitId && $ligne['quantiteProduit'] != $quantite){
                    array_push($nouveauPanier, $ligne);
                }
            }
        }
        $_SESSION['panier'] = $nouveauPanier;

        return $this->response
            ->withHeader('location','/panier')
            ->withStatus(302);
    }
    
}