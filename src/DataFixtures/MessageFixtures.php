<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MessageFixtures extends Fixture implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath("./") . "/src/data/message.csv";
        $datas = $serializer->decode(file_get_contents($filepath), 'csv');

        foreach ( $datas as $data) {
            $message = new Message();
            $message->setName($data['name']);
            $message->setSubject($data['subject']);
            $message->setEmail($data['email']);
            $message->setComment($data['comment']);
            $message->setCreatedAt(new \DateTime($data['created_at']));
            $message->setIsSee($data['is_see']);
            $manager->persist($message);
        }

        $manager->flush();
    }
}
