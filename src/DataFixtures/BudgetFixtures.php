<?php

namespace App\DataFixtures;

use App\Entity\Budget;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class BudgetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach(range(0, 20) as $i) {
            $budget = (new Budget())
                ->setInitialValue($faker->randomFloat(111, 500, 100000))
                ->setConsumedValue($faker->randomFloat(111, 1, 20000));
            $budget->setRemainingBudget($budget->getInitialValue() - $budget->getConsumedValue());

            $manager->persist($budget);
            $manager->flush();
        }
    }

}
