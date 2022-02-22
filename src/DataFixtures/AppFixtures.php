<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Budget;
use App\Entity\Portfolio;
use App\Entity\Status;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Projet;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 4; $i++) {
            $status[$i] = new Status();
            $status[$i]->setName('test');
            $status[$i]->setSlug('test');
            $status[$i]->setValue(1);

            $manager->persist($status[$i]);
        }

        $portfolio = new Portfolio();

        foreach(range(0, 20) as $i) {
            $budget = (new Budget())
                ->setInitialValue($faker->randomFloat(111, 500, 100000))
                ->setConsumedValue($faker->randomFloat(111, 1, 20000));
            $budget->setRemainingBudget($budget->getInitialValue() - $budget->getConsumedValue());

            $project = (new Projet())
                ->setTitle($faker->text(80))
                ->setDescription($faker->realTextBetween($minNbChars = 200, $maxNbChars = 450, $indexSize = 2))
                ->setEndedAt($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->setStartDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
                ->setCode('red')
                ->setDone($faker->boolean)
                ->setPortfolio($portfolio);

            $manager->persist($project);
        }

        for ($i = 0; $i < 15; $i++) {
            $users[$i] = new User();
            $users[$i]->setFirstname($faker->firstName);
            $users[$i]->setLastname($faker->lastName);

            $manager->persist($users[$i]);
        }

        $admin = new Admin();
        $admin->setUsername('root');
        $admin->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC');
        $admin->setRoles((array)'ROLE_ADMIN');
        $manager->persist($admin);

        $manager->flush();
    }
}
