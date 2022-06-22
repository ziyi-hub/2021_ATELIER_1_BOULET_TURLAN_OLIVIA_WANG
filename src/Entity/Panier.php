<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPanier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPanier;

    /**
     * @var string
     *
     * @ORM\Column(name="idProduit", type="string", length=255, nullable=false)
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="idcommande", type="string", length=255, nullable=true)
     */
    private $idCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="string", length=255, nullable=true)
     */
    private $quantité;

    public function __construct(
        ?int $idPanier,
        string $idProduit,
        string $idCommande,
        string $quantité

        
    ) {
        $this->idPanier = $idPanier;
        $this->idProduit = $idProduit;
        $this->idCommande = $idCommande;
        $this->quantité = $quantité;
    }


}
