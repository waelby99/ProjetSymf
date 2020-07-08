<?php

namespace App\Controller;
use App\Entity\Circuit;
use App\Entity\EtapeCircuit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtapeCircuitController extends AbstractController
{
    /**
     * @Route("/etape/circuit/{id}", name="etape_circuit")
     * @param Circuit $circuit
     */
    public function index(Circuit $circuit)
    {
        $listeEtape=$this->getDoctrine()->getRepository(EtapeCircuit::class)->findBy(['code_circuit'=>$circuit]);

        return $this->render('etape_circuit/index.html.twig', ['etapes' => $listeEtape]);
    }
    /**
     * @Route("/AjouterEtape",name="NouvelleEtape")
     * @param Request $request
     * @return Response |RedirectResponse
     */
    public function Ajouter(Request $request){
        $addetape=new EtapeCircuit();
        $formadd=$this->createForm("App\Form\EtapeCircuitType",$addetape);
        $formadd->handleRequest($request);
        if(($formadd->isSubmitted())&&($formadd->isValid()))
        {$man_add=$this->getDoctrine()->getManager();
            $man_add->persist($addetape);
            $man_add->flush();
            return $this->redirectToRoute('EtapeCircuit');

        }
        return $this->render('etape_circuit/add.html.twig',['EtapeCircuit'=>$addetape,'form'=>$formadd->createView()]);
    }
    /**
     * @Route("/ModifierEtape/{id}",name="ModifierEtape")
     * @param EtapeCircuit $EtapeCircuit
     * @param Request $request
     * @return Response
     */
    public function modifier(EtapeCircuit $EtapeCircuit,Request $request){
        $man_eta=$this->getDoctrine()->getManager();
        $formEta=$this->createForm('App\Form\EtapeCircuitType',$EtapeCircuit);
        $formEta->handleRequest($request);
        if($formEta->isSubmitted() && $formEta->isValid()){
            $man_eta->flush();
            return $this->redirectToRoute('EtapeCircuit');
        }
        return $this->render('etape_circuit/modif.html.twig',['EtapeCircuit'=>$EtapeCircuit,'form'=>$formEta->createView()]);
    }
    /**
     * @Route("/deleteetape/{id}",name="deleteetape")
     * @param Request $request
     * @param EtapeCircuit $EtapeCircuit
     */
    public function delete(EtapeCircuit $EtapeCircuit, Request $request){
        $em=$this->getDoctrine()->getManager();
        $em->remove($EtapeCircuit);
        $em->flush();
        return $this->redirectToRoute('EtapeCircuit');

    }
}
