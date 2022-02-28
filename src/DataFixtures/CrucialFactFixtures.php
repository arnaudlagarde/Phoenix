<?php

namespace App\DataFixtures;

use App\Entity\CrucialFact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class CrucialFactFixtures extends Fixture
{
    public const CRUCIALFACT_REFERENCE = 'CrucialFact';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $crucialFact = (new CrucialFact())
            ->setName('aaaa')
            ->setDescription('aaaaaaaaaaaaaaaaa')
            ->setDateFact($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));

        $this->setReference(self::CRUCIALFACT_REFERENCE, $crucialFact);

        $manager->persist($crucialFact);
        $manager->flush();
    }
}
