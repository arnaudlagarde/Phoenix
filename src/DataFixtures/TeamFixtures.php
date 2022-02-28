<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TeamFixtures extends Fixture
{
    public const TEAM_REFERENCE = 'Team-One';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (range(0, 2) as $i) {
            $team = (new Team())
                ->setName('team n°' . $i);
            $this->setReference(self::TEAM_REFERENCE, $team);

            $manager->persist($team);
        }
        $manager->flush();
    }
}
