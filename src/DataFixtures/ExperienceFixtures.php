<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExperienceFixtures extends Fixture implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath("./") . "/src/data/experience.csv";
        $datas = $serializer->decode(file_get_contents($filepath), 'csv');

        foreach ( $datas as $data) {
            $experience = new Experience();
            $experience->setTitle($data['title']);
            $experience->setLocation($data['location']);
            $experience->setDescription($data['description']);
            $experience->setBeginDate(new \DateTime($data['begin_date']));
            $experience->setEndDate(new \DateTime($data['end_date']));
            $manager->persist($experience);
        }

        $manager->flush();
    }
}
