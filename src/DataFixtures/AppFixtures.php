<?php

namespace App\DataFixtures;

use App\Entity\Administrateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $adresseMail= "rakotoniainatefy@gmail.com";
        $password= "0123456789";
        $admin= new Administrateur();
        $admin->setnom("Rakotoniaina");
        $admin->setprenom("Tefy");
        $admin->setadresseMail("rakotoniainatefy@gmail.com");
        $admin->setpassword("0123456789");
        $manager->persist($admin);
        $manager->flush();
    }
}
