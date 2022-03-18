<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public const TEAM_REFERENCE = 'Team_';

    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 8) as $i) {
            $team = (new Team())
                ->setName('team n°' . $i);


            $manager->persist($team);
            $this->setReference(self::TEAM_REFERENCE . $i, $team);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
