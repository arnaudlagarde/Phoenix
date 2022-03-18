<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'User_';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // Users
        foreach (range(1, 20) as $i) {
            $user = (new User())
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
                ->setRole('ROLE_USER');


            $this->addReference(self::USER_REFERENCE . "user$i", $user);
            $manager->persist($user);

        }
        // Boss
       /* foreach (range(1, 20) as $i) {
            $user = (new User())
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setEmail("boss$i@gmail.com")
                ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
                ->setRole('ROLE_USER');


            $this->addReference(self::class . "boss$i", $user);
            $manager->persist($user);

        }*/

        $manager->flush();

    }
}
