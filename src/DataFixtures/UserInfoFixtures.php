<?php

namespace App\DataFixtures;

use App\Entity\UserInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserInfoFixtures extends Fixture implements ContainerAwareInterface, DependentFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath("./") . "/src/data/userInfo.csv";
        $datas = $serializer->decode(file_get_contents($filepath), 'csv');

        foreach ( $datas as $data) {
            $userInfo = new UserInfo();
            $userInfo->setAge($data['age']);
            $userInfo->setCreatedAt(new \DateTime($data['created_at']));
            $userInfo->setUpdatedAt(new \DateTime($data['updated_at']));
            $userInfo->setDescription($data['description']);
            $userInfo->setUser($this->getReference('user_' . $data['user_id']));
            $userInfo->setGithub($data['github']);
            $userInfo->setAddress($data['address']);
            $userInfo->setLinkedin($data['linkedin']);
            $userInfo->setPicture($data['picture']);
            $manager->persist($userInfo);
            $this->addReference('userInfo_'.$data['id'], $userInfo);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}