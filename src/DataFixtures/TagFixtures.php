<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

class TagFixtures extends Fixture
{
    public const TAG_REFERENCE = 'TAG_';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach(range(0, 9) as $i) {
            $tag = (new Tag())
                ->setName('tag-' . $faker->randomNumber(5, 6))
                ->setValue(random_int(0, 3))
                ->setMandatory(random_int(0, 1));
            $this->setReference(self::TAG_REFERENCE .$i, $tag);

            $manager->persist($tag);

            $manager->flush();
        }
    }
}
