<?php
namespace App\Controller\Utilisateurs\Gerant;

use App\Controller\ActionController;
use App\Repository\CommandeRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class ViewDetailCommandAction extends ActionController{

    public $container;
    private $commandeRepository;

    public function __construct(ContainerInterface $container,CommandeRepository $commandeRepository)
    {
        $this->container = $container;
        $this->commandeRepository = $commandeRepository;
    }

    protected function action():Response
    {
        $commandeId = (int) $this->args['id'];
        $commande = $this->commandeRepository->findOneById($commandeId);
        $produits = $this->commandeRepository->findProduitsDeLaCommande($commandeId);
        return $this->container->get('view')->render($this->response, 'utilisateurs/gerant/detailCommande.html.twig',[
            "commande"=>$commande,
            "produits"=>$produits,
            "session"=>$_SESSION
        ]);                
    }

}