<?php

namespace App\DataFixtures;

use App\Entity\Fact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class FactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $fact = (new Fact())
            ->setName('Un fait vraiment marquant')
            ->setDescription('Une description cool')
            ->setDateFact($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));

        $manager->persist($fact);
        $manager->flush();
    }
}
