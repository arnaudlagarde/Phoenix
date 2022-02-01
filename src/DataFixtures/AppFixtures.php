<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Projet;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // on crée 4 auteurs avec noms et prénoms "aléatoires" en français
        $projects = array();
        for ($i = 0; $i < 15; $i++) {
            $projects[$i] = new Projet();
            $projects[$i]->setTitle($faker->title);
            $projects[$i]->setDescription($faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2));
            $projects[$i]->setCreatedAt($faker->dateTimeThisCentury($format = 'Y-m-d', $max = 'now'));
            $projects[$i]->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris') );
            $projects[$i]->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris') );

            $manager->persist($projects[$i]);
        }

        $manager->flush();
    }
}
