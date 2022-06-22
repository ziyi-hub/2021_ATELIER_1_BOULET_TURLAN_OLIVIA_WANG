<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Repository\CommandeRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class PanierValiderAction extends ActionController{

    public $container;
    public $utilisateurRepository;
    public $commandeRepository;

    public function __construct(ContainerInterface $container, UtilisateurRepository $utilisateurRepository, CommandeRepository $commandeRepository)
    {
        $this->container = $container;
        $this->utilisateurRepository = $utilisateurRepository;
        $this->commandeRepository = $commandeRepository;
    }

    protected function action():Response
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $montant = htmlentities($_POST['montant']);

            $this->commandeRepository->addCommande($montant);

            $sommaire = $this->commandeRepository->findMontantByMontant($montant);

            return $this->container->get('view')->render($this->response, 'panier/infoLivraison.html.twig',[
                'sommaire' => $sommaire
            ]);
        }
        else
        {
            return $this->response->withHeader('Location','/panier');
        }
    }

}