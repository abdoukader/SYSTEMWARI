<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Warifixture extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setUsername('abdoukader');
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $password = $this->encoder->encodePassword($user, '1234');
        $user->setPassword($password);
        $user->setNom('thiam');
        $user->setPrenom('redakt');
        $user->setTel(772086894);
        $user->setmail('aktmere@gmail.com');
        $user->setAdresse('thiaroye');
        $user->setStatut('actif');
        $user->setNinea('NIN123');
        $user->setProfil('superadmin');

        $manager->persist($user);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
