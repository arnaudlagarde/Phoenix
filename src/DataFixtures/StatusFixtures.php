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
        foreach (range(0, 2) as $i) {
            $status = new Status();
            $status->setName(['Terminé', 'En cours', 'Prévu'][$i]);
            $status->setValue(random_int(0, 3));

            $color = $status->getName();
            switch ($color) {
                case 'Terminé':
                    $status->setColor('green');
                    break;
                case 'En cours':
                    $status->setColor('yellow');
                    break;
                case 'Prévu':
                    $status->setColor('blue');
                    break;
            }

            $name = $status->getName();
            switch ($name) {
                case 'Terminé':
                    $status->setSlug('Terminé');
                    break;
                case 'En cours':
                    $status->setSlug('En-Cours');
                    break;
                case 'Prévu':
                    $status->setSlug('Prévu');
                    break;
            }

            $manager->persist($status);

            $this->setReference(self::STATUS_REFERENCE . $i, $status);
        }

        $manager->flush();

    }
}
