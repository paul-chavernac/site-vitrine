<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PaiementController
 *
 * @author chave
 */
class PaiementController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController{

    /**
     * 
     * @Route("/paiement", name="paiement")
     */
    public function Paiement() {
        return $this->render("paiement/paiement.html.twig");
    }

}
