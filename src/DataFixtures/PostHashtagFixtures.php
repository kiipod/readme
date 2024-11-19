<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\PostHashtag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostHashtagFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            PostFixtures::class,
            HashtagFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 40; $i++) {
            $postHashtag = new PostHashtag();

            // Связываем случайный пост с случайным хэштегом
            $postHashtag->setPost($this->getReference('post_' . $faker->numberBetween(1, 20)));
            $postHashtag->setHashtag($this->getReference('hashtag_' . $faker->numberBetween(1, 5)));

            $manager->persist($postHashtag);
        }

        $manager->flush();
    }
}
