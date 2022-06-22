<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_commande_utilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommande;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string",length=255)
     */
    private $montant;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="statutPayer", type="boolean", nullable=true)
     */
    private $statutpayer;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="statutLivraison", type="boolean", nullable=true)
     */
    private $statutlivraison;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;




    public function getIdcommande()
    {
        return $this->idcommande;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant( $montant)
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatutpayer()
    {
        return $this->statutpayer;
    }

    public function setStatutpayer( $statutpayer)
    {
        $this->statutpayer = $statutpayer;

        return $this;
    }

    public function getStatutlivraison()
    {
        return $this->statutlivraison;
    }

    public function setStatutlivraison( $statutlivraison)
    {
        $this->statutlivraison = $statutlivraison;

        return $this;
    }

    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(Utilisateur $idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    public function __construct(
        ?int $idcommande,
        string $montant,
        string $statutpayer,
        string $statutlivraison,
        Utilisateur $idutilisateur

    ) {
        $this->idcommande = $idcommande;
        $this->montant = $montant;
        $this->statutpayer = $statutpayer;
        $this->statutlivraison = $statutlivraison;
        $this->idutilisateur = $idutilisateur;

    }

}
