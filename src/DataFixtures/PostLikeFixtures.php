<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\PostLike;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostLikeFixtures extends Fixture implements DependentFixtureInterface
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

        for ($i = 1; $i <= 50; $i++) {
            $postLike = new PostLike();

            // Связываем лайк с публикацией и пользователем
            $postLike->setPost($this->getReference('post_' . $faker->numberBetween(1, 20)));
            $postLike->setLikeUser($this->getReference('user_' . $faker->numberBetween(1, 10)));

            $manager->persist($postLike);
        }

        $manager->flush();
    }
}
