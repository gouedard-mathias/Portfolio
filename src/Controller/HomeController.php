<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\ExperienceRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
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
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(
        UserRepository $userRepository,
        ProjectRepository $projectRepository,
        ClientRepository $clientRepository,
        SkillRepository $skillRepository,
        ExperienceRepository $experienceRepository
    ): Response
    {
        $user = $userRepository->findOneBy([]);
        $projects = $projectRepository->findAll();
        $clients = $clientRepository->findAll();
        $skills = $skillRepository->findAll();
        $experiences = $experienceRepository->findAll();
        return $this->render('home/profile.html.twig', [
            'user' => $user,
            'projects' => $projects,
            'clients' => $clients,
            'skills' => $skills,
            'experiences' => $experiences,
        ]);
    }
}
