<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Repost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RepostFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            PostFixtures::class,
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            $repost = new Repost();

            // Выбираем случайный пост и пользователя
            $repost->setPost($this->getReference('post_' . $faker->numberBetween(1, 20)));
            $repost->setRepostUser($this->getReference('user_' . $faker->numberBetween(1, 10)));

            $manager->persist($repost);
        }

        $manager->flush();
    }
}
