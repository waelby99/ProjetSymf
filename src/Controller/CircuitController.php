<?php
namespace App\Controller;
use App\Entity\EtapeCircuit;
use App\Entity\Ville;
use App\Entity\Circuit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class CircuitController extends AbstractController {

    /**
     * @Route("/circuit",name="circuit")
     * @return Response
     */
    public function index():Response{
        $listCir=$this->getDoctrine()->getRepository(Circuit::class)->findAll();
        return $this->render("circuit/index.html.twig",['circuit'=>$listCir
        ]);
    }
    /**
     * @Route("/AjouterCircuit",name="NouveauCircuit")
     * @param Request $request
     * @return Response |RedirectResponse
     */
    public function Ajouter(Request $request){
        $addcir=new Circuit();
        $formadd=$this->createForm("App\Form\CircuitType",$addcir);
        $formadd->handleRequest($request);
        if(($formadd->isSubmitted())&&($formadd->isValid()))
        {$man_add=$this->getDoctrine()->getManager();
            $man_add->persist($addcir);
            $man_add->flush();
            return $this->redirectToRoute('Circuit');

        }
        return $this->render('circuit/add.html.twig',['Circuit'=>$addcir,'form'=>$formadd->createView()]);
    }
    /**
     * @Route("/ModifierCircuit/{id}",name="ModifierCircuit")
     * @param Circuit $Circuit
     * @param Request $request
     * @return Response
     */
    public function modifier(Circuit $Circuit,Request $request){
        $man_cir=$this->getDoctrine()->getManager();
        $formCir=$this->createForm('App\Form\CircuitType',$Circuit);
        $formCir->handleRequest($request);
        if($formCir->isSubmitted() && $formCir->isValid()){
            $man_cir->flush();
            return $this->redirectToRoute('Circuit');
        }
        return $this->render('circuit/modif.html.twig',['Circuit'=>$Circuit,'form'=>$formCir->createView()]);
    }
    /**
     * @Route("/deletecircuit/{id}",name="deletecircuit")
     * @param Request $request
     * @param Circuit $Circuit
     */
    public function delete(Circuit $Circuit, Request $request){
        $em=$this->getDoctrine()->getManager();
        $em->remove($Circuit);
        $em->flush();
        return $this->redirectToRoute('Circuit');

    }
}