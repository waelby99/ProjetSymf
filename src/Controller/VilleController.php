<?php

namespace App\Controller;
use App\Entity\Ville;
use App\Entity\Destination;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville/{id}", name="ville")
     * @param Destination $Destination
     */
    public function index(Destination $Destination)
    {
        $listeDestination=$this->getDoctrine()->getRepository(Destination::class)->findAll();
        $listeVille=$this->getDoctrine()->getRepository(Ville::class)->findBy(['code_des'=>$Destination]);
        return $this->render('ville/index.html.twig', ['villes' => $listeVille, 'Destination'=>$listeDestination]);
    }
    /**
     * @Route("/AjouterVille",name="NouvelleVille")
     * @param Request $request
     * @return Response |RedirectResponse
     */
    public function Ajouter(Request $request){
        $addville=new Ville();
        $formadd=$this->createForm("App\Form\VilleType",$addville);
        $formadd->handleRequest($request);
        if(($formadd->isSubmitted())&&($formadd->isValid()))
        {$man_add=$this->getDoctrine()->getManager();
            $man_add->persist($addville);
            $man_add->flush();
            return $this->redirectToRoute('Ville');

        }
        return $this->render('ville/add.html.twig',['Ville'=>$addville,'form'=>$formadd->createView()]);
    }
    /**
     * @Route("/ModifierVille/{id}",name="ModifierVille")
     * @param Ville $Ville
     * @param Request $request
     * @return Response
     */
    public function modifier(Ville $Ville,Request $request){
        $man_dest=$this->getDoctrine()->getManager();
        $formDest=$this->createForm('App\Form\VilleType',$Ville);
        $formDest->handleRequest($request);
        if($formDest->isSubmitted() && $formDest->isValid()){
            $man_dest->flush();
            return $this->redirectToRoute('Ville');
        }
        return $this->render('ville/modif.html.twig',['Ville'=>$Ville,'form'=>$formDest->createView()]);
    }
    /**
     * @Route("/deleteville/{id}",name="deleteville")
     * @param Request $request
     * @param Ville $Ville
     */
    public function delete(Ville $Ville, Request $request){
        $em=$this->getDoctrine()->getManager();
        $em->remove($Ville);
        $em->flush();
        return $this->redirectToRoute('Ville');

    }
}
