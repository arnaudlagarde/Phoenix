<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;


class StatusFixtures extends Fixture
{
    public const STATUS_REFERENCE = 'STATUS_';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        foreach (range(0, 10) as $i) {
            $status = new Status();
            $status->setName(['Done', 'In progress', 'Created'][random_int(0, 2)]);
            $status->setValue(random_int(0, 3));

            $color = $status->getName();
            switch ($color) {
                case 'Done':
                    $status->setColor('green');
                    break;
                case 'In progress':
                    $status->setColor('yellow');
                    break;
                case 'Created':
                    $status->setColor('blue');
                    break;
            }

            $name = $status->getName();
            switch ($name) {
                case 'Done':
                    $status->setSlug('done');
                    break;
                case 'In progress':
                    $status->setSlug('in-progress');
                    break;
                case 'Created':
                    $status->setSlug('created');
                    break;
            }

            $manager->persist($status);

            $this->setReference(self::STATUS_REFERENCE, $status);
        }

        $manager->flush();

    }
}
