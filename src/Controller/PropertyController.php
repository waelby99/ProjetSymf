<?php
namespace App\Controller;
use App\Entity\Destination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController {

    /**
     * @Route("/tours",name="tours.index")
     * @return Response
     */
    public function index():Response{
        $listDest=$this->getDoctrine()->getRepository(Destination::class)->findAll();
        return $this->render("tours/index.html.twig",['destination'=>$listDest
        ]);
    }
    /**
     * @Route("/Ajouter",name="NouvelleDestination")
     * @param Request $request
     * @return Response |RedirectResponse
     */
    public function Ajouter(Request $request){
        $addest=new Destination();
        $formadd=$this->createForm("App\Form\DestinationModifierType",$addest);
        $formadd->handleRequest($request);
        if(($formadd->isSubmitted())&&($formadd->isValid()))
        {$man_add=$this->getDoctrine()->getManager();
        $man_add->persist($addest);
        $man_add->flush();
        return $this->redirectToRoute('Destination');

        }
        return $this->render('tours/add.html.twig',['Destination'=>$addest,'form'=>$formadd->createView()]);
    }
    /**
     * @Route("/ModifierDestination/{id}",name="ModifierDestination")
     * @param Destination $Destination
     * @param Request $request
     * @return Response
     */
    public function modifier(Destination $Destination,Request $request){
        $man_dest=$this->getDoctrine()->getManager();
        $formDest=$this->createForm('App\Form\DestinationModifierType',$Destination);
        $formDest->handleRequest($request);
        if($formDest->isSubmitted() && $formDest->isValid()){
            $man_dest->flush();
            return $this->redirectToRoute('Destination');
        }
        return $this->render('tours/modif.html.twig',['Destination'=>$Destination,'form'=>$formDest->createView()]);
    }
    /**
     * @Route("/deletedestination/{id}",name="deletedestination")
     * @param Request $request
     * @param Destination $Destination
     */
    public function delete(Destination $Destination, Request $request){
        $em=$this->getDoctrine()->getManager();
        $em->remove($Destination);
        $em->flush();
        return $this->redirectToRoute('Destination');

    }
}