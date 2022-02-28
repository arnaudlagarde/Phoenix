<?php

namespace App\DataFixtures;

use App\Entity\Risk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class RiskFixtures extends Fixture
{
    public const RISK_REFERENCE = 'RISK';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $risk = (new Risk())
            ->setName('testrisk')
            ->setCritical('testcritical')
            ->setProbability(1)
            ->setIdentificationDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
            ->setResolutionDate($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));

        $this->addReference(self::RISK_REFERENCE, $risk);

        $manager->persist($risk);
        $manager->flush();
    }
}
