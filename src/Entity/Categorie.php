<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="cat_id", type="integer")
     */
    private $catId;

    /**
     * @ORM\Column(name="cat_libelle", type="string", length=255, nullable=false)
     */
    private $catLibelle;

    function __toString() {
        return $this->catLibelle;
    }

    function getCatId() {
        return $this->catId;
    }

    function getCatLibelle() {
        return $this->catLibelle;
    }

    function setCatId($catId) {
        $this->catId = $catId;
    }

    function setCatLibelle($catLibelle) {
        $this->catLibelle = $catLibelle;
    }

}
