<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Livraison;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of InscriptionController
 *
 * @author Maiwenn
 */
class LivraisonController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController {

    /**
     * 
     * @Route("/livraison", name="livraison")
     */
    public function Livraison(\Doctrine\ORM\EntityManagerInterface $em, Request $request) {
        $uneLivraison = new Livraison ();
        $form = $this->createFormBuilder($uneLivraison)
                ->add('nom', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "nom"])
                ->add('prenom', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "prenom"])
                ->add('telephone', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "telephone"])
                ->add('cp', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "code postal"])
                ->add('ville', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "ville"])
                ->add('pays', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "pays"])
                ->add('Enregistrer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => "Ajouter", "attr" => array("class" => "btn-success")))
                ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            
                    $em->persist($uneLivraison);
            $em->flush();
            return $this->redirectToRoute("commandes");
        }
        return $this->render("compte/consulterCmd.html.twig", array('form'=>$form->createView()));
    }
        

}
