<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class PortfolioFixtures extends Fixture implements DependentFixtureInterface
{

    public const Portfolio_REFERENCE = 'Portfolio_';

    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 6) as $i) {
            $portfolio[$i] = new Portfolio();
            $portfolio[$i]->setName('Mon portfolio n°' . $i);

            $this->setReference(self::Portfolio_REFERENCE . $i, $portfolio[$i]);
            $manager->persist($portfolio[$i]);

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
