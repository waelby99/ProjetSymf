<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription",name="inscription")
     * @param Request $request
     */
    public function inscription (Request $request,UserPasswordEncoderInterface $encoder){
        $user=new User();
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('login');
        }
        return $this->render('security/registration.html.twig',['form'=>$form->createView()]);

    }

    /**
     * @Route("/login",name="login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout",name="logout")
     */
    public function logout(){
    }
}
