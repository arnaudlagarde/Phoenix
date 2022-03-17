<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new Admin();
        $admin->setUsername('root');
        $admin->setPassword('$2y$13$FGiCHNf3B6IqQcQEOigk8uR70qBaTT0OragQdwKPVC4ou0tJZSYJC');
        $admin->setRoles((array)'ROLE_ADMIN');

        $manager->persist($admin);

        $manager->flush();
    }
}
