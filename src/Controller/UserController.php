<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user, ['standalone' => true]);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $encoderFactory->getEncoder(User::class);
            
            $user->setSalt(md5($user->getUsername()));
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            
            $user->setPassword($password);
            
            // user role 
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            
            $tokenStorage->setToken(
                new UsernamePasswordToken($user, null, 'main', $user->getRoleId())    
            );
            
            return $this->redirectToRoute('homepage');
        }
        
    return $this->render(
        'User/register.html.twig',
        ['formObj' => $form->createView()]
        );
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
