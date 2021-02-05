<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProjectFixtures extends Fixture implements ContainerAwareInterface, DependentFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath("./") . "/src/data/project.csv";
        $datas = $serializer->decode(file_get_contents($filepath), 'csv');

        foreach ( $datas as $data) {
            $project = new Project();
            $project->setTitle($data['title']);
            $project->setCreatedAt(new \DateTime($data['created_at']));
            $project->setUpdatedAt(new \DateTime($data['updated_at']));
            $project->setDescription($data['description']);
            $project->setCategory($this->getReference('category_' . $data['category_id']));
            $project->setClient($this->getReference('client_' . $data['client_id']));
            $project->setGithub($data['github']);
            $project->setVideo($data['video']);
            $project->setWebsite($data['website']);
            $manager->persist($project);
            $this->addReference('project_'.$data['id'], $project);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ClientFixtures::class,
        ];
    }
}