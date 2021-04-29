<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/create-users", name="create-users")
     */
    public function craeteUsers() 
    {
        $users = ['Adam', 'Robert', 'John', 'Susan'];
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($users as $userName) {
            $user = new User;
            $user->setName($userName);            
            $entityManager->persist($user);
        }

        $entityManager->flush();
        return $this->redirectToRoute('default');
    }
    
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $gifts = ['flowers', 'car', 'piano', 'money'];
        shuffle($gifts);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts
        ]);
    }
}
