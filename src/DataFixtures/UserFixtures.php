<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            $users[$i] = new User();
            $users[$i]->setFirstname($faker->firstName);
            $users[$i]->setLastname($faker->lastName);
            $users[$i]->setEmail($faker->email);
            $users[$i]->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC');
            $users[$i]->setRole('ROLE_USER');


            $manager->persist($users[$i]);
            $manager->flush();
        }
    }
}
