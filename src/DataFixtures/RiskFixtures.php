<?php

namespace App\DataFixtures;

use App\Entity\Risk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;


class RiskFixtures extends Fixture implements DependentFixtureInterface
{
    public const RISK_REFERENCE = 'RISK_';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (range(0, 5) as $i) {
            $project = random_int(1, 6);
            $risk = (new Risk())
                ->setName(['Low', 'Medium', 'High'][random_int(0, 2)])
                ->setProbability($faker->randomFloat(2, 0, 100))
                ->setIdentificationDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
                ->setResolutionDate($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->setProjet($this->getReference(ProjetFixtures::PROJET_REFERENCE . $project));
            $tqt = $risk->getName();
            switch ($tqt) {
                case 'Low':
                    $risk->setCritical(0);
                    break;
                case 'Medium':
                    $risk->setCritical(1);
                    break;
                case 'High':
                    $risk->setCritical(2);
                    break;
            }

            $manager->persist($risk);
            $this->setReference(self::RISK_REFERENCE . $i, $risk);
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
