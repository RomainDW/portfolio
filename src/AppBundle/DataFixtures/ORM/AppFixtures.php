<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('romain.ollier34@gmail.com');
        $user->setPlainPassword('test');
        $manager->persist($user);
        $manager->flush();

    }
}