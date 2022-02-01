<?php

namespace App\DataFixtures;

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
        $projects = array();
        for ($i = 0; $i < 50; $i++) {
            $projects[$i] = new Projet();
            $projects[$i]->setTitle($faker->text(80));
            $projects[$i]->setDescription($faker->realTextBetween($minNbChars = 200, $maxNbChars = 450, $indexSize = 2));
            $projects[$i]->setCreatedAt($date);
            $projects[$i]->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris') );
            $projects[$i]->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris') );

            $manager->persist($projects[$i]);
        }

        $manager->flush();
    }
}
