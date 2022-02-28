<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            $status = new Status();
            $status->setName('In progress');
            $status->setSlug('in-progress');
            $status->setValue(1);

            $manager->persist($status);

    }
}
