<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Status;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Projet;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $date = new DateTimeImmutable('2022-01-01');
        for ($i = 0; $i < 4; $i++) {
            $status[$i] = new Status();
            $status[$i]->setName('test');
            $status[$i]->setSlug('test');
            $status[$i]->setValue(1);

            $manager->persist($status[$i]);
        }
        for ($i = 0; $i < 20; $i++) {
            $projects[$i] = new Projet();
            $projects[$i]->setTitle($faker->text(80));
            $projects[$i]->setDescription($faker->realTextBetween($minNbChars = 200, $maxNbChars = 450, $indexSize = 2));
            $projects[$i]->setCreatedAt($date);
            $projects[$i]->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris') );
            $projects[$i]->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris') );

            $manager->persist($projects[$i]);
        }
        for ($i = 0; $i < 15; $i++) {
            $users[$i] = new User();
            $users[$i]->setFirstname($faker->firstName);
            $users[$i]->setLastname($faker->lastName);

            $manager->persist($users[$i]);
        }
        $admin = new Admin();
        $admin->setUsername('root');
        $admin->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC');
        $admin->setRoles((array)'ROLE_ADMIN');
        $manager->persist($admin);

        $manager->flush();
    }
}
