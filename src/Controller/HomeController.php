<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/connected/coucou', name: 'app_coucou')]
    public function coucou(): Response
    {
        if($post->getAuthor() === $this->getUser()){
            // alors j'accepte l'edition
        }

        $user =$this->getUser();

        if(!$user){
            return $this->redirectToRoute('app_home');
        }


        return $this->render('home/coucou.html.twig', [
            'user'=>$user
        ]);
    }

}
