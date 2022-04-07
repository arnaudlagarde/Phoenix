<?php

namespace App\DataFixtures;

use App\Entity\Budget;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class BudgetFixtures extends Fixture
{
    public const BUDGET_REFERENCE = 'BUDGET_';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach(range(0, 30) as $i) {
            $budget = (new Budget())
                ->setTurnoverBudget(1500)
                ->setInitialValue($faker->randomFloat(2, 9000, 20000))
                ->setConsumedValue($faker->randomFloat(2, 1, 8000));
            $budget->setRemainingBudget($budget->getInitialValue() - $budget->getConsumedValue());

            $manager->persist($budget);
            $this->setReference(self::BUDGET_REFERENCE .$i, $budget);
        }

        $manager->flush();
    }

}
