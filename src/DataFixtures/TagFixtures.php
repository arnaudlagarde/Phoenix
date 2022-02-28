<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TagFixtures extends Fixture
{
    public const TAG_REFERENCE = 'TAG';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $tag = (new Tag())
            ->setName('My tag')
            ->setValue(1)
            ->setMandatory(1);

        $this->setReference(self::TAG_REFERENCE, $tag);

        $manager->persist($tag);
        $manager->flush();
    }
}
