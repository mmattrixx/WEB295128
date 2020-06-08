<?php

namespace App\DataFixtures;

use App\Entity\Papier;
use App\Entity\Tektura;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;


    /**
     * AppFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user=new User();
        $user->setUsername("test");
        $user->setPassword($this->passwordEncoder->encodePassword($user,'test12345678'));
        $user->setEmail("test@wok");
        $user->setFullName("Mateusz Wróblewski");
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);
        $manager->flush();
        $tektura=new Tektura();
        $tektura->setGramatura(0);
        $tektura->setNazwa("BRAK");
        $manager->persist($tektura);
        $manager->flush();
        $papier=new Papier();
        $papier->setNazwa("BRAK");
        $papier->setGramatura(0);
        $papier->setProducent("");
        $manager->persist($papier);
        $manager->flush();
    }
}
