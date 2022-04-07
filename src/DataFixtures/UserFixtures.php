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
        $faker = \Faker\Factory::create('fr_FR');

        // Root
        $root = (new User())
            ->setEmail('root@phoenix.com')
            ->setFirstName('Phoenix')
            ->setLastName('Grégoire')
            ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
            ->setRole('ROLE_USER')
        ;

        $this->addReference(self::class.'root', $root);
        $manager->persist($root);

        // Users
        foreach (range(1, 20) as $i) {
            $user = (new User())
                ->setEmail($faker->unique()->safeEmail())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
                ->setRole('ROLE_USER')
            ;

            $this->addReference(self::class."user$i", $user);
            $manager->persist($user);
        }

        // Responsibles
        foreach (range(1, 10) as $i) {
            $user = (new User())
                ->setEmail($faker->unique()->safeEmail())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
                ->setRole('ROLE_USER')
            ;

            $this->addReference(self::class."responsible$i", $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
