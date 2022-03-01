<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class PortfolioFixtures extends Fixture
{

    public const Portfolio_REFERENCE = 'Portfolio_';

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 4; $i++) {
            $portfolio[$i] = new Portfolio();
            $portfolio[$i]->setName('Mon portfolio n°' . $i);

            $this->setReference(self::Portfolio_REFERENCE .$i, $portfolio[$i]);

            $manager->persist($portfolio[$i]);
            $manager->flush();
        }
    }
}
