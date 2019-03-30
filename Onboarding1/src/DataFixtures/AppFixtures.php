<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $departement1 = new Departement();
        $departement1->setNom("Rh");
        $departement1->setEmail("Departement1@yopmail.com");

        $manager->persist($departement1);


        $departement2 = new Departement();
        $departement2->setNom("Direction");
        $departement2->setEmail("Departement2@yopmail.com");

        $manager->persist($departement2);


        $departement3 = new Departement();
        $departement3->setNom("Com");
        $departement3->setEmail("Departement3@yopmail.com");

        $manager->persist($departement3);


        $departement4 = new Departement();
        $departement4->setNom("Dev");
        $departement4->setEmail("Departement4@yopmail.com");

        $manager->persist($departement4);


        $manager->flush();
    }
}
