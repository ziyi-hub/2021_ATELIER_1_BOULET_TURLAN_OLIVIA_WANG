<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="FK_facture_commande", columns={"idCommande"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="numFacture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numfacture;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string", length=255, nullable=false)
     */
    private $montant;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCommande", referencedColumnName="idCommande")
     * })
     */
    private $idcommande;

    public function getNumfacture()
    {
        return $this->numfacture;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    public function getIdcommande()
    {
        return $this->idcommande;
    }

    public function setIdcommande(Commande $idcommande)
    {
        $this->idcommande = $idcommande;

        return $this;
    }


}
