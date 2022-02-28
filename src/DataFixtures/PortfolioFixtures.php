<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class PortfolioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 4; $i++) {
            $portfolio[$i] = new Portfolio();
            $portfolio[$i]->setName('Mon portfolio n°'. $i);

            $manager->persist($portfolio[$i]);
        }
    }
}
