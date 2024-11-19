<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture
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
            $comment = new Comment();
            $comment->setText($faker->sentence(10));
            $comment->setCreatedAt($faker->dateTime());

            // Связываем комментарии со случайными пользователями и публикациями
            $comment->setPost($this->getReference('post_' . $faker->numberBetween(1, 20)));
            $comment->setCommentator($this->getReference('user_' . $faker->numberBetween(1, 10)));

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
