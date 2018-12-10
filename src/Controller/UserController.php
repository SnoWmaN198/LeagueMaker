<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    
    /**
     * Register
     *
     * Register function for a new user with form submission and validation 
     * 
     * @Route("/register", name="register") 
     */    
    public function register(Request $request, EncoderFactoryInterface $encoderFactory, TokenStorageInterface $tokenStorage) 
    {
        
        return $this->redirectToRoute('homepage');
    }
    
    /**
     * Login
     * 
     * Login function for an existing user
     * 
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render(
            'User/login.html.twig',
            [
                'lastUsername' => $lastUsername,
                'error'        => $error
            ]
        );
    }
}
