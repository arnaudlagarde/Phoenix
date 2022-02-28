<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class StatusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
            $status = new Status();
            $status->setName('In progress');
            $status->setSlug('in-progress');
            $status->setValue(1);
            $status->setColor('red');

            $manager->persist($status);
            $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            ProjetFixtures::class,
        ];
    }
}
