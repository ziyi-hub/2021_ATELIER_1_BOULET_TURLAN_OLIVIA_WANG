<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="FK_produit_utilisateur", columns={"idUtilisateur"}), @ORM\Index(name="FK_produit_categorie", columns={"idCategorie"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProduit", type="string", length=255, nullable=false)
     */
    private $nomproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tarifUnitaire", type="string", length=255, nullable=false)
     */
    private $tarifunitaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lienImage", type="string", length=255, nullable=true)
     */
    private $lienimage;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorie", referencedColumnName="idCategorie")
     * })
     */
    private $idcategorie;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function getIdproduit()
    {
        return $this->idproduit;
    }

    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    public function setNomproduit( $nomproduit)
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription( $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getTarifunitaire()
    {
        return $this->tarifunitaire;
    }

    public function setTarifunitaire( $tarifunitaire)
    {
        $this->tarifunitaire = $tarifunitaire;

        return $this;
    }

    public function getLienimage()
    {
        return $this->lienimage;
    }

    public function setLienimage( $lienimage)
    {
        $this->lienimage = $lienimage;

        return $this;
    }

    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(Categorie $idcategorie)
    {
        $this->idcategorie = $idcategorie;

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

    /**
     * @return Collection|Commande[]
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }

}
