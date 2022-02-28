<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $project = (new Projet())
            ->setTitle($faker->text(80))
            ->setDescription($faker->realTextBetween($minNbChars = 200, $maxNbChars = 450, $indexSize = 2))
            ->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
            ->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
            ->setCode('red')
            ->setDone($faker->boolean)
            ->setPortfolio($portfolio)
            ->setBudget($budget)
            ->addCrucialFact($crucialFact);
    }
}
