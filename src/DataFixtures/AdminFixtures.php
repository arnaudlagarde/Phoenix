<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AdminFixtures extends Fixture
{
    public const ADMIN_REFERENCE = 'Admin_';

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $admin = new Admin();
        $admin->setUsername('root');
        $admin->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC');
        $admin->setRoles((array)'ROLE_ADMIN');
        $admin->setFirstName('Gregoire');
        $admin->setLastName('Rondet');

        $manager->persist($admin);

        $manager->flush();

        // Root
        $root = (new Admin())
            ->setUsername('root@phoenix.com')
            ->setFirstName('Phoenix')
            ->setLastName('Grégoire')
            ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
            ->setRoles((array)'ROLE_ADMIN');


        $this->addReference(self::class . 'root', $root);
        $manager->persist($root);

        // Users
        foreach (range(1, 20) as $i) {
            $admin = (new Admin())
                ->setUsername($faker->unique()->safeEmail())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC')
                ->setRoles((array)'ROLE_USER');

            $this->addReference(self::class . "boss$i", $admin);
            $manager->persist($admin);
        }

        // Boss
        foreach (range(1, 20) as $i) {
            $admin = (new Admin())
                ->setUsername($faker->unique()->safeEmail())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setPassword('rootroot')
                ->setRoles((array)'ROLE_USER');

            $this->addReference(self::class . "user$i", $admin);
            $manager->persist($admin);
        }

        $manager->flush();
    }
}
