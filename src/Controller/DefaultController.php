<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    private $twig;
    
    public function __construct(
        \Twig_Environment $twig
        ) {
            $this->twig = $twig;
    }
    /**
     * Homepage
     *
     * The homepage of the application
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return new Response($this->twig->render('homepage.html.twig'));
    }
}
