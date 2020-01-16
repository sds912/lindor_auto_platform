<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="security.register")
     */
    public function register(Request $request,UserPasswordEncoderInterface $encoder)
    {
         $user = new User();

         $form = $this->createForm(UserRegisterType::class, $user);

         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid())
         {
             $hash = $encoder->encodePassword($user,$user->getPassword());
             $user->setPassword($hash);
             $em = $this->getDoctrine()->getManager();
             $em->persist($user);
             $em->flush();
         }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="security.login")
     */

     public function login(AuthenticationUtils $authenticationUtils)
     {
         $error = $authenticationUtils->getLastAuthenticationError();
         $lastUsername = $authenticationUtils->getLastUsername();

         return $this->render('security/login.html.twig',[
             'last_username' => $lastUsername,
             'error' => $error
         ]);
     }
}
