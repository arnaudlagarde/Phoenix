<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Budget;
use App\Entity\CrucialFact;
use App\Entity\Portfolio;
use App\Entity\Risk;
use App\Entity\Status;
use App\Entity\Tag;
use App\Entity\Team;
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

        for ($i = 0; $i < 4; $i++) {
            $portfolio[$i] = new Portfolio();
            $portfolio[$i]->setName('Mon portfolio n°'. $i);

            $manager->persist($portfolio[$i]);
        }



        foreach(range(0, 20) as $i) {
            $budget = (new Budget())
                ->setInitialValue($faker->randomFloat(111, 500, 100000))
                ->setConsumedValue($faker->randomFloat(111, 1, 20000));
            $budget->setRemainingBudget($budget->getInitialValue() - $budget->getConsumedValue());

            $manager->persist($budget);


            $crucialFact = (new CrucialFact())
                ->setName('aaaa')
                ->setDescription('aaaaaaaaaaaaaaaaa')
                ->setDateFact($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));

            $tag = (new Tag())
                ->setName('My tag')
                ->addCrucialFact($crucialFact)
                ->setValue(1)
                ->setMandatory(1);


            $manager->persist($tag);

            $risk = (new Risk())
                ->setName('testrisk')
                ->setCritical('testcritical')
                ->setProbability(1)
                ->setIdentificationDate($faker->dateTimeThisDecade($max = 'now', $timezone = 'Europe/Paris'))
                ->setResolutionDate($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->getProjet();


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

            $team = (new Team())
                ->setName('team oe');
            $manager->persist($team);



            $manager->persist($project);
        }

        for ($i = 0; $i < 15; $i++) {
            $users[$i] = new User();
            $users[$i]->setFirstname($faker->firstName);
            $users[$i]->setLastname($faker->lastName);
            $users[$i]->setEmail($faker->email);
            $users[$i]->setTeam($team);

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
