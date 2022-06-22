<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    public function __construct(
        ?int $idutilisateur,
        string $nomutilisateur,
        string $adresse,
        string $mail,
        string $motdepasse,
        ?string $roleid,
        ?string $numtel
    ) {
        $this->idutilisateur = $idutilisateur;
        $this->nomutilisateur = $nomutilisateur;
        $this->adresse = $adresse;
        $this->motdepasse = $motdepasse;
        $this->numtel = $numtel;
        $this->roleid = $roleid;
        $this->mail = $mail;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUtilisateur", type="string", length=255, nullable=false)
     */
    private $nomutilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motDePasse", type="string", length=255, nullable=true)
     */
    private $motdepasse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="roleId", type="integer", nullable=true)
     */
    private $roleid;



    /**
     * @var string|null
     *
     * @ORM\Column(name="numTel", type="string", length=255, nullable=true)
     */
    private $numtel;

    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;
    }

    public function getNomutilisateur()
    {
        return $this->nomutilisateur;
    }

    public function setNomutilisateur( $nomutilisateur)
    {
        $this->nomutilisateur = $nomutilisateur;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getRoleid()
    {
        return $this->roleid;
    }

    public function setRoleid( $roleid)
    {
        $this->roleid = $roleid;

        return $this;
    }

    public function getNumtel()
    {
        return $this->numtel;
    }

    public function setNumtel( $numtel)
    {
        $this->numtel = $numtel;

        return $this;
    }


}
