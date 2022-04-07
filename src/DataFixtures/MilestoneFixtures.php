<?php

namespace App\DataFixtures;

use App\Entity\Milestone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

class MilestoneFixtures extends Fixture implements DependentFixtureInterface
{
    public const MILESTONE_REFERENCE = 'MILESTONE_';
    public const NUMBER_ELEMENT = 10;

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (range(1, 30) as $i) {
            $milestone = (new Milestone())
                ->setName('milestone-' . $faker->randomNumber(5, 6))
                ->setValue(random_int(0, 3))
                ->setMandatory($faker->boolean())
                ->setProjet($this->getReference(ProjetFixtures::PROJET_REFERENCE . $i));


            $this->setReference(self::MILESTONE_REFERENCE . $i, $milestone);
            $manager->persist($milestone);


        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjetFixtures::class,
        ];
    }
}
