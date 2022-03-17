<?php

namespace App\DataFixtures;

use App\Entity\CrucialFact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;


class CrucialFactFixtures extends Fixture implements DependentFixtureInterface
{
    public const CRUCIALFACT_REFERENCE = 'CrucialFact_';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (range(0, 5) as $i) {
            $crucialFact = (new CrucialFact())
                ->setName(['This incredible thing happened !', 'Waouh cela est fou', 'Cela est marquant'][random_int(0, 2)])
                ->setDateFact($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'))
                ->setMilestone($this->getReference(MilestoneFixtures::MILESTONE_REFERENCE. rand(0, MilestoneFixtures::NUMBER_ELEMENT)));


            $description = $crucialFact->getName();
            switch ($description) {
                case 'This incredible thing happened !':
                    $crucialFact->setDescription("Truly incredible never seen that before :)");
                    break;
                case 'Waouh cela est fou':
                    $crucialFact->setDescription("c'est fou ce qu'il se passe :)");
                    break;
                case 'Cela est marquant':
                    $crucialFact->setDescription("je suis marqué à vie :)");
                    break;
            }

            $this->setReference(self::CRUCIALFACT_REFERENCE .$i, $crucialFact);

            $manager->persist($crucialFact);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MilestoneFixtures::class
        ];
    }
}
