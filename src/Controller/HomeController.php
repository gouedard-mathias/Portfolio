<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home_index")
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

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy([]);
        $userInfo = $user->getUserInfo();
        return $this->render('home/profile.html.twig', [
            'user' => $userInfo,
        ]);
    }
}
