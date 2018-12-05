<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="pan_id", type="integer")
     */
    private $panId;

    /**
     * @var Produits
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pro_id", referencedColumnName="pro_id")
     * })
     */
    private $proId;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_name")
     * })
     */
    private $userId;

    /**
     * @ORM\Column(name="pan_quantite", type="integer")
     */
    private $panQuantite;

    function getPanId() {
        return $this->panId;
    }

    function getProId() {
        return $this->proId;
    }

    function getUserId() {
        return $this->userId;
    }

    function getPanQuantite() {
        return $this->panQuantite;
    }
    
    function setPanId($panId) {
        $this->panId = $panId;
    }

    function setProId($proId) {
        $this->proId = $proId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setPanQuantite($panQuantite) {
        $this->panQuantite = $panQuantite;
    }

}
