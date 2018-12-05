<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContenuRepository")
 */
class Contenu {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="contenu_id", type="integer")
     */
    private $contenuId;

    /**
     * @var Commandes
     * @ORM\ManyToOne(targetEntity="Commandes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="com_id", referencedColumnName="com_id")
     * })
     */
    private $idCommande;

    /**
     * @var Produits
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pro_id", referencedColumnName="pro_id")
     * })
     */
    private $idProduit;

    /**
     * @ORM\Column(name="contenu_quantite", type="integer")
     */
    private $quantite;
    
    /**
     * @ORM\Column(name="contenu_prix", type="integer")
     */
    private $contenuPrix;

    public function __toString() {
        return $this->contenuId;
    }

    function getContenuId() {
        return $this->contenuId;
    }

    function getIdCommande() {
        return $this->idCommande;
    }

    function getIdProduit() {
        return $this->idProduit;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function setContenuId($contenuId) {
        $this->contenuId = $contenuId;
    }

    function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    function setIdProduit($idProduit) {
        $this->idProduit = $idProduit;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
    
    function getContenuPrix() {
        return $this->contenuPrix;
    }

    function setContenuPrix($contenuPrix) {
        $this->contenuPrix = $contenuPrix;
    }



}
