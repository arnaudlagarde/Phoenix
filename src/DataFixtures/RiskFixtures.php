<?php

namespace App\DataFixtures;

use App\Entity\Risk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;
use PhpParser\Node\Stmt\Case_;


class RiskFixtures extends Fixture
{
    public const RISK_REFERENCE = 'RISK_';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach(range(0, 5) as $i) {
            $risk = (new Risk())
                ->setName(['Low', 'Medium', 'High'][random_int(0,2)])
                ->setProbability($faker->randomFloat(2, 0, 100))
                ->setIdentificationDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
                ->setResolutionDate($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));
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

            $this->setReference(self::RISK_REFERENCE .$i, $risk);

            $manager->persist($risk);
        }


        $manager->flush();
    }
}
