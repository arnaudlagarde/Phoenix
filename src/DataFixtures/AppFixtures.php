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

    }
}
