<?php
namespace App\Controller\Utilisateurs\Producteur;

use App\Controller\ActionController;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class DetailProducteurAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, UtilisateurRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $producteur = $this->repository->findProducteurById($this->args['producteur']);

        return $this->container->get('view')->render($this->response, 'utilisateurs/producteur/detailProducteur.html.twig',[
            'producteur' => $producteur,
            "session"=>$_SESSION
        ]);
    }
}