<?php

namespace App\DataFixtures;

use App\Entity\Fact;
use App\Repository\MilestoneRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;


class FactFixtures extends Fixture implements DependentFixtureInterface
{
    public const FACT_REFERENCE = 'FACT_';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (range(1, 20) as $i) {
            $fact = (new Fact())
                ->setName($faker->text(50))
                ->setDescription($faker->text(100))
                ->setDateFact($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->setMilestone($this->getReference(MilestoneFixtures::MILESTONE_REFERENCE . $i));


            $this->setReference(self::FACT_REFERENCE, $fact);

            $manager->persist($fact);

        }

        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            MilestoneFixtures::class
        ];
    }
}
