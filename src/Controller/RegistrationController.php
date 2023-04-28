<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $registrationForm = $this->createForm(RegistrationType::class, $user);
            $registrationForm->handleRequest($request);
            if($registrationForm->isSubmitted() && $registrationForm->isValid())
            {

                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $registrationForm->get('password')->getData()
                    )


                );

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_home');

            }

        return $this->renderForm('registration/login.html.twig', [
            'registrationForm' => $registrationForm,
        ]);
    }
}
