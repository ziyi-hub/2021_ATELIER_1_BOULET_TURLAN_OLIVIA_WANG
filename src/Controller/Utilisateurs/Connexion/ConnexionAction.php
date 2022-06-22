<?php
namespace App\Controller\Utilisateurs\Connexion;

use App\Controller\ActionController;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class ConnexionAction extends ActionController{

    public $container;
    private $utilisateurRepository;

    public function __construct(ContainerInterface $container,UtilisateurRepository $utilisateurRepository)
    {
        $this->container = $container;
        $this->utilisateurRepository = $utilisateurRepository;
    }

    protected function action():Response
    {
        $parsedBody = $this->request->getParsedBody();
        $mail = htmlspecialchars($parsedBody['mail']);
        $password =  htmlspecialchars($parsedBody['password']);
        $users = $this->utilisateurRepository->findUtilisateurByMail($mail);
        if($users != null){
            $user = $users[0];
            if($password == $user['motDePasse']){  
                $_SESSION['theme']="";
                $_SESSION['message']="";
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $user['idUtilisateur'];

                if($user['roleId'] == '1'){
                    $_SESSION['role'] = '1';
                    $path = '/producteur' . '/' . $user['idUtilisateur'];
                    return $this->response
                    ->withHeader('location',$path) // Ici il faudra rediriger vers le profil du producteur
                    ->withStatus(302);
                }
                else if($user['roleId'] == '2'){
                    $_SESSION['role'] = '2';
                    return $this->response
                    ->withHeader('location','/gerant/list-commandes')
                    ->withStatus(302);
                }
            }else{
                $_SESSION['theme']="danger";
                $_SESSION['message']="Mauvais identifiants";
                return $this->response
                ->withHeader('location','/connexion')
                ->withStatus(302);
            }
        }else{
            $_SESSION['theme']="danger";
            $_SESSION['message']="L'identifiant n'existe pas";
            return $this->response
            ->withHeader('location','/connexion')
            ->withStatus(302);
        }
    }
}