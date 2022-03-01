<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

class ProjetFixtures extends Fixture
{
    public const PROJET_REFERENCE = 'PROJET';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach(range(0, 20) as $i) {
            $project = (new Projet())
                ->setTitle($faker->text(35))
                ->setDescription($faker->realTextBetween($minNbChars = 120, $maxNbChars = 450, $indexSize = 2))
                ->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
                ->setCode(['red', 'blue', 'green'][random_int(0,2)])
                ->setDone($faker->boolean);
                ->setPortfolio($this->getReference(PortfolioFixtures::Portfolio_REFERENCE))
                //->setBudget($this->getReference(BudgetFixtures::BUDGET_REFERENCE))
                //->addCrucialFact($this->getReference(CrucialFactFixtures::CRUCIALFACT_REFERENCE));
                //->setStatus($this->getReference(StatusFixtures::STATUS_REFERENCE));

            $this->setReference(self::PROJET_REFERENCE .$i, $project);

            $manager->persist($project);

        }
        $manager->flush();
    }
}
