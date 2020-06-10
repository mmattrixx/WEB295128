<?php

namespace App\DataFixtures;

use App\Entity\Papier;
use App\Entity\Tektura;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;


    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $users=[['mateuszw','test@wok','Mateusz Wróblewski 295','mateusz0185',['ROLE_ADMIN']],['admin','admin@admin','Zaliczenie 295128','zaq1@WSXAdmin01.',['ROLE_ADMIN']]];
        foreach ($users as $item) {
        $user=new User();
        $user->setUsername($item[0]);
        $user->setPassword($this->passwordEncoder->encodePassword($user,$item[3]));
        $user->setEmail($item[1]);
        $user->setFullName($item[2]);
        $user->setRoles($item[4]);
        $manager->persist($user);
        $manager->flush();
        }




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

        $arr=[['HP',150,'FirmaX'],['CraftLiner',302,'FirmaY'],['KLB',170,'FirmaJ'],['KLB',200,'FirmaC'],['KLB',230,'FirmaC'],['KTX',230,'FirmaS']];
        foreach ($arr as $item) {
            $papier=new Papier();
            $papier->setNazwa($item[0]);
            $papier->setGramatura($item[1]);
            $papier->setProducent($item[2]);
            $manager->persist($papier);
            $manager->flush();
        }
        $arr2=[['KPQ',150],['KIU',302],['BPBP',170],['WECD',200],['SKD',230],['DSKD',230]];
        foreach ($arr2 as $item) {
            $tektura=new Tektura();
            $tektura->setNazwa($item[0]);
            $tektura->setGramatura($item[1]);
            $manager->persist($papier);
            $manager->flush();
        }
    }
}
