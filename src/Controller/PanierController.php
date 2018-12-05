<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\Panier;
use App\Entity\User;
use App\Entity\Commandes;
use App\Entity\Contenu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Description of PanierController
 *
 * @author Maiwenn
 */
class PanierController extends AbstractController {
    //put your code here

    /**
     * @route("/panier",name="panier")
     * @return Response
     */
    public function panierController() {
        if (!($this->getUser()))
            return $this->redirect($this->generateUrl('login'));

        $panier = $this->getDoctrine()
                ->getRepository(Panier::class)
                ->findBy([
            'userId' => $this->getUser()->getUsername()
        ]);

        return $this->render('home/panier.html.twig', array('panier' => $panier));
    }

    /**
     * @route("/ajoutPanierFromPanier/{id}",name="ajoutPanierFromPanier")
     * @return Response
     */
    public function ajoutProduitPanierFromPanierController($id, EntityManagerInterface $em) {
        if (!($this->getUser()))
            return $this->redirect($this->generateUrl('login'));
        $this->ajoutProduitPanierController($id, $em);
        return $this->redirect($this->generateUrl('panier'));
    }
    
    /**
     * @route("/ajoutPanierFromHome/{id}",name="ajoutPanierFromHome")
     * @return Response
     */
    public function ajoutProduitPanierFromHomeController($id, EntityManagerInterface $em) {
        if (!($this->getUser()))
            return $this->redirect($this->generateUrl('login'));
        $this->ajoutProduitPanierController($id, $em);
        return $this->redirect($this->generateUrl('home'));
    }
    /**
     * @route("/ajoutPanierFromProduit/{id}",name="ajoutPanierFromProduit")
     * @return Response
     */
    public function ajoutProduitPanierFromProduitController($id, EntityManagerInterface $em) {
        if (!($this->getUser()))
            return $this->redirect($this->generateUrl('login'));
        $this->ajoutProduitPanierController($id, $em);
        return $this->redirect($this->generateUrl('produit', ['id' => $id]));
    }

    /**
     * @route("/moinsPanier/{id}",name="moinsPanier")
     * @return Response
     */
    public function moinsProduitPanierController($id, EntityManagerInterface $em) {

        $actuUser = $this->getUser()->getUsername();
        $panier = $this->getDoctrine()
                ->getRepository(Panier::class)
                ->findOneBy([
            'userId' => $actuUser,
            'proId' => $id
        ]);

        $actuQte = $panier->getPanQuantite();

        if ($actuQte < 2) {
            $em->remove($panier);
            $sql = "DELETE FROM `panier` WHERE pro_id = :id AND user_id = :user";
            $proId = $panier->getProId()->getProId();
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute(['id' => $proId, 'user' => $actuUser]);
        } else {
            $panier->setPanQuantite($actuQte - 1);
        }
        $em->persist($panier);
        $em->flush();
        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @route("/supprPanier/{id}",name="supprPanier")
     * @return Response
     */
    public function supprProduitPanierController($id, EntityManagerInterface $em) {

        $actuUser = $this->getUser()->getUsername();
        $panier = $this->getDoctrine()
                ->getRepository(Panier::class)
                ->findOneBy([
            'userId' => $actuUser,
            'proId' => $id
        ]);

        $em->remove($panier);
        $sql = "DELETE FROM `panier` WHERE pro_id = :id AND user_id = :user";
        $proId = $panier->getProId()->getProId();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute(['id' => $proId, 'user' => $actuUser]);
        $em->persist($panier);
        $em->flush();
        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @route("/validPanier",name="validPanier")
     * @return Response
     */
    public function validerPanierController(EntityManagerInterface $em) {

        $actuUser = $this->getUser()->getUsername();
        $panier = $this->getDoctrine()
                ->getRepository(Panier::class)
                ->findBy([
            'userId' => $actuUser,
        ]);

        $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
            'userName' => $this->getUser()->getUsername()
        ]);

        $today = new \DateTime('now');

        $commande = new Commandes;
        $commande->setUserId($user);
        $commande->setComDate($today);
        $em->persist($commande);
        $em->flush();

        foreach ($panier as $pan) {
            $contenuCommande = new Contenu();
            $contenuCommande->setIdCommande($commande);
            $contenuCommande->setIdProduit($pan->getProId());
            $contenuCommande->setContenuPrix($pan->getProId()->getProPrix());
            $contenuCommande->setQuantite($pan->getPanQuantite());
            $em->persist($contenuCommande);
            $em->flush();
        }

        $sql = "DELETE FROM `panier` WHERE user_id = :id";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute(['id' => $actuUser]);

        return $this->redirect($this->generateUrl('panier'));
    }

    public function ajoutProduitPanierController($id, EntityManagerInterface $em) {
        $panier = $this->getDoctrine()
                ->getRepository(Panier::class)
                ->findOneBy([
            'userId' => $this->getUser()->getUsername(),
            'proId' => $id
        ]);
        $produit = $this->getDoctrine()
                ->getRepository(Produits::class)
                ->findOneBy([
            'proId' => $id
        ]);

        $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
            'userName' => $this->getUser()->getUsername()
        ]);

         if (!$panier) {
            //ajout du nouveau produit
            $nouveauPanier = new Panier;
            $nouveauPanier->setProId($produit);
            $nouveauPanier->setUserId($user);
            $nouveauPanier->setPanQuantite(1);
            $em->persist($nouveauPanier);
            $em->flush();
        } else {
            echo '<pre>';
            $actuQte = $panier->getPanQuantite();
            $panier->setPanQuantite($actuQte + 1);
            $em->persist($panier);
            $em->flush();
        }
    }

}
