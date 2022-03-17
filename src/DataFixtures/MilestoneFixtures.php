<?php

namespace App\DataFixtures;

use App\Entity\Milestone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

class MilestoneFixtures extends Fixture
{
    public const MILESTONE_REFERENCE = 'MILESTONE_';
    public const NUMBER_ELEMENT = 10;

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach(range(0, 9) as $i) {
            $milestone = (new Milestone())
                ->setName('milestone-' . $faker->randomNumber(5, 6))
                ->setValue(random_int(0, 3))
                ->setMandatory(random_int(0, 1));
            $this->setReference(self::MILESTONE_REFERENCE .$i, $milestone);

            $manager->persist($milestone);


        }
        $manager->flush();
    }
}
