<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('administrator');
        $user->setEmail('null@hetic.net');
        $user->setFirstName('Administrator');
        $user->setLastName('Administrator');
        $user->setPlanet('Nemesis');
        $user->setCredits(0);
        $user->setPhoneNumber('+33600000000');
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
}
