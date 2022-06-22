<?php
namespace App\Controller\Utilisateurs\Gerant;

use App\Controller\ActionController;
use App\Repository\CommandeRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class ListCommandesAction extends ActionController{

    public $container;
    private $commandeRepository;

    public function __construct(ContainerInterface $container,CommandeRepository $commandeRepository)
    {
        $this->container = $container;
        $this->commandeRepository = $commandeRepository;
    }

    protected function action():Response
    {
        $commandes = $this->commandeRepository->findAllCommandesWithClientName();
        return $this->container->get('view')->render($this->response, 'utilisateurs/gerant/listCommandes.html.twig',[
            "commandes"=>$commandes,
            "session"=>$_SESSION
        ]);                
    }

}