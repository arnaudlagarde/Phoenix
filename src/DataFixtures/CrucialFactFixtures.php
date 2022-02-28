<?php

namespace App\DataFixtures;

use App\Entity\CrucialFact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class CrucialFactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $crucialFact = (new CrucialFact())
            ->setName('aaaa')
            ->setDescription('aaaaaaaaaaaaaaaaa')
            ->setDateFact($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));

        $manager->persist($crucialFact);
        $manager->flush();
    }
}
