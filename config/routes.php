<?php

use App\Controller\Panier\CommanderAction;
use App\Controller\Panier\PanierInfoLivraisonAction;
use App\Controller\Panier\PanierValiderAction;
use App\Controller\Produit\RechercheProduitsProducteurAction;
use App\Controller\Panier\PanierFactureAction;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Controller\Accueil\AccueilAction;
use App\Controller\Produit\ListeProduitsAction;
use App\Controller\Produit\DetailProduitAction;
use App\Controller\Utilisateurs\Connexion\ConnexionAction;
use App\Controller\Utilisateurs\Producteur\ListeProducteursAction;
use App\Controller\Utilisateurs\Producteur\DetailProducteurAction;
use App\Controller\Utilisateurs\Producteur\ListCommandProducteurAction;
use App\Controller\Produit\RechercheProduitsAction;
use App\Controller\Utilisateurs\Gerant\ListCommandesAction;
use App\Controller\Utilisateurs\Gerant\ViewDetailCommandAction;
use App\Controller\Utilisateurs\Gerant\ViewDashboardAction;

use App\Controller\Panier\AjoutPanierAction;
use App\Controller\Panier\SuppressionPanierAction;

$app->get('/', AccueilAction::class);
$app->get('/nosproduits', ListeProduitsAction::class)->setName('nosproduits');
$app->get('/nosproduits/{produit}', DetailProduitAction::class)->setName('detailproduit');
$app->get('/nosproduits/recherche/{categories}', RechercheProduitsAction::class)->setName('recherchecategorie');
$app->get('/nosproduits/recherches/{producteur}', RechercheProduitsProducteurAction::class)->setName('rechercheproducteur');
$app->get('/nosproducteurs', ListeProducteursAction::class)->setName('nosproducteurs');
$app->get('/nosproducteurs/{producteur}', DetailProducteurAction::class)->setName('detailproducteur');

$app->group('/connexion', function (RouteCollectorProxy $group) {
    $group->get('', function ($request, $response, $args) {
        return $this->get('view')->render($response, 'connexion/connexion.html.twig', [
            "session" => $_SESSION
        ]);
    });
    $group->post('', ConnexionAction::class);
});

$app->get('/deconnexion', function (Request $request, Response $response) {
    session_destroy();
    return $response
        ->withHeader('Location', '/')
        ->withStatus(302);
  }
);

$app->get('/producteur/{id}', ListCommandProducteurAction::class);

$app->group('/gerant', function (RouteCollectorProxy $group) {

    $group->get('/list-commandes', ListCommandesAction::class);
    $group->get('/commande/{id}', ViewDetailCommandAction::class);
    $group->get('/tableau-de-bord', ViewDashboardAction::class);
});
$app->group('/panier', function (RouteCollectorProxy $group) {
    $group->get('', function ($request, $response, $args) {
        return $this->get('view')->render($response, 'panier/panier.html.twig', [
            "session" => $_SESSION
        ]);
    });
    $group->get('/info', PanierInfoLivraisonAction::class);
    $group->post('/info', PanierInfoLivraisonAction::class);

    $group->get('/valider', PanierValiderAction::class);
    $group->post('/valider', PanierValiderAction::class);

    $group->post('/ajout/{id}', AjoutPanierAction::class);
    $group->post('/suppression/{id}', SuppressionPanierAction::class);
    $group->get('/info/facture', PanierFactureAction::class);
    //$group->get('/retrait/{id}', ViewDetailCommandAction::class);
});
$app->post('/commande', CommanderAction::class)->setName('commande');
//$app->get('/comdander', ListeProduitsAction::class);
//$app->get('/nosproduits', ListeProduitsAction::class)

