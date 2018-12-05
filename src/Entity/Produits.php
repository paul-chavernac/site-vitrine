<?php

namespace App\Entity;

//TODO : recréer classe produit 
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsRepository")
 */
class Produits {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="pro_id", type="integer")
     */
    private $proId;

    /**
     * @ORM\Column(name="pro_nom", type="string", length=255, nullable=false)
     */
    private $proNom;

    /**
     * @ORM\Column(name="pro_prix", type="integer", nullable=false)
     */
    private $proPrix;

    /**
     * @ORM\Column(name="pro_image", type="string", length=500, nullable=false , options={"default" : "http://manutentionquebec.com/wp-content/themes/manutentionquebe/images/aucune-image.jpg"})
     */
    private $proImage = "http://manutentionquebec.com/wp-content/themes/manutentionquebe/images/aucune-image.jpg";

    /**
     * @ORM\Column(name="pro_Resume", type="string", length=1500, nullable=false)
     */
    private $proResume;
    
    /**
     * @ORM\Column(name="pro_stock", type="integer", nullable=false)
     */
    private $proStock;

    /**
     * @var Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cat_id", referencedColumnName="cat_id")
     * })
     * 
     */
    private $catId;

    public function __toString() {
        return $this->proNom;
    }

    function getProId() {
        return $this->proId;
    }

    function getProNom() {
        return $this->proNom;
    }

    function getProPrix() {
        return $this->proPrix;
    }

    function getProImage() {
        return $this->proImage;
    }
    
    function getProStock() {
        return $this->proStock;
    }

    function getCatId(){
        return $this->catId;
    }
    
    function getProResume() {
        return $this->proResume;
    }

    function setProId($proId) {
        $this->proId = $proId;
    }

    function setProNom($proNom) {
        $this->proNom = $proNom;
    }

    function setProPrix($proPrix) {
        $this->proPrix = $proPrix;
    }

    function setProImage($proImage) {
        $this->proImage = $proImage;
    }
    
    function setProStock($proStock) {
        $this->proStock = $proStock;
    }

    function setCatId($catId) {
        $this->catId = $catId;
    }

    function setProResume($proResume) {
        $this->proResume = $proResume;
    }


}
