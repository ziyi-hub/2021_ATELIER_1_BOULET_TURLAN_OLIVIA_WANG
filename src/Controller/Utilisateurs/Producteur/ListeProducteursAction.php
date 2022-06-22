<?php
namespace App\Controller\Utilisateurs\Producteur;

use App\Controller\ActionController;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class ListeProducteursAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, UtilisateurRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $producteurs = $this->repository->findAllProducteursByRole(1);

        return $this->container->get('view')->render($this->response, 'utilisateurs/producteur/listeProducteurs.html.twig',[
            'producteurs' => $producteurs,
            "session"=>$_SESSION
        ]);
    }

}