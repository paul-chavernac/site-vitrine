<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CmdRepository")
 */
class Commandes {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="com_id", type="integer")
     */
    private $comId;

    // add your own fields

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_name")
     * })
     */
    private $userId;

    /**
     * @ORM\Column(name="com_date", type="date")
     * })
     */
    private $comDate;

    public function __toString() {
        return $this->comId;
    }

    function getComId() {
        return $this->comId;
    }

    function getUserId() {
        return $this->userId;
    }

    function setComId($comId) {
        $this->comId = $comId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function getComDate() {
        return $this->comDate;
    }

    function setComDate($comDate) {
        $this->comDate = $comDate;
    }

}
