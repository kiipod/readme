<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Hashtag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HashtagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $hashtag = new Hashtag();
            $hashtag->setTitle($faker->unique()->word());
            $manager->persist($hashtag);

            // Сохраняем ссылку для других фикстур
            $this->addReference('hashtag_' . $i, $hashtag);
        }

        $manager->flush();
    }
}
