<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\Categorie;

//TODO : finir entity -> pages produit -> panier
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author Maiwenn
 */
class HomeController extends AbstractController {
    //put your code here

    /**
     * @route("/",name="redirectHome")
     * @return Response
     */
    public function redirectToAcceuil() {
        return $this->redirect($this->generateUrl('home'));
    }

    /**
     * @route("/Accueil/{categorie}",defaults = {"categorie"=null},name="home")
     * @return Response
     */
    public function indexController($categorie) {
        if ($categorie) {
            
            $catId = $this->getDoctrine()
                    ->getRepository(Categorie::class)
                    ->findOneByCatLibelle($categorie);
            if ($catId) {
                $produits = $this->getDoctrine()
                        ->getRepository(Produits::class)
                        ->findByCatId($catId->getCatId());
                $page = $catId;
            } else {
                $page = 'Catégorie "'.$categorie.'" innexistante';
                $produits = null;
            }
        } else {
            $produits = $this->getDoctrine()
                    ->getRepository(Produits::class)
                    ->findAll();
            $page = "Accueil";
        }
        $categories = $this->getDoctrine()
                ->getRepository(Categorie::class)
                ->findAll();


        return $this->render('home/index.html.twig', [
                    'produits' => $produits,
                    'categories' => $categories,
                    'page' => $page]);
    }

    /**
     * @Route("/visiteur",name="visiteur")
     * @return Response
     */
    public function visiteurController() {
        return $this->render('visiteur/visiteur.html.twig');
    }
    

}
