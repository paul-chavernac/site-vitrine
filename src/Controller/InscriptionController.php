<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
/**
 * Description of InscriptionController
 *
 * @author Maiwenn
 */
class InscriptionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController {
    /**
     * 
     * @Route("/inscription", name="inscription")
     */
    public function Inscription (\Doctrine\ORM\EntityManagerInterface $em, Request $request){
        $unUser = new User ();
        $form = $this->createFormBuilder($unUser)
                ->add('userName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label"=>"Identifiant"])
                ->add('password', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label"=>"Mot De Passe"])
                ->add('email')
                ->add('Enregistrer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => "Création de l'utilisateur", "attr" => array("class" => "btn-success")))
                ->getForm()
                ;
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $unUser->setIsActive(1);
            $unUser->setRole("ROLE_USER").
                    $em->persist($unUser);
            $em->flush();
            return $this->redirectToRoute("redirectHome");
        }
        return $this->render("Inscription/inscription.html.twig", array('form'=>$form->createView()));
    }
}
