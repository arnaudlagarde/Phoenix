<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJET_REFERENCE = 'PROJET_';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (range(1, 30) as $i) {
            $team = random_int(1, 8);
            $portfolio = random_int(1,6);
            $status = random_int(0,2);
            $project = (new Projet())
                ->setTitle("Projet n°$i")
                ->setDescription($faker->realTextBetween($minNbChars = 120, $maxNbChars = 450, $indexSize = 2))
                ->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
                ->setCode(['red', 'blue', 'green'][random_int(0, 2)])
                ->setDone($faker->boolean(7))
                ->setBudget($this->getReference(BudgetFixtures::BUDGET_REFERENCE . $i))
                ->setStatus($this->getReference(StatusFixtures::STATUS_REFERENCE.$status))
                ->setTeam($this->getReference(TeamFixtures::TEAM_REFERENCE.$team))
                ->setPortfolio($this->getReference(PortfolioFixtures::Portfolio_REFERENCE.$portfolio));



            $this->setReference(self::PROJET_REFERENCE . $i, $project);

            $manager->persist($project);

        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StatusFixtures::class,
            TeamFixtures::class,
            BudgetFixtures::class,
            PortfolioFixtures::class
        ];
    }
}
