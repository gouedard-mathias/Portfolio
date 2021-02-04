<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/home", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy([]);
        $userInfo = $user->getUserInfo();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $userInfo,
        ]);
    }
}
