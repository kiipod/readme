<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            TypePostFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence());
            $post->setSlug($faker->unique()->slug());
            $post->setText($faker->paragraphs(3, true));
            $post->setViewStats($faker->numberBetween(0, 1000));
            $post->setImage($faker->optional()->imageUrl(640, 480, 'cats', true, 'post'));
            $post->setVideoLink($faker->optional()->url());
            $post->setLink($faker->optional()->url());
            $post->setAuthorQuote($faker->optional()->name());
            $post->setCreatedAt($faker->dateTime());

            // Устанавливаем случайного пользователя и тип публикации
            $post->setCreator($this->getReference('user_' . $faker->numberBetween(1, 10)));
            $post->setType($this->getReference('type_' . $faker->randomElement(['post', 'image', 'video', 'quote', 'link'])));

            $manager->persist($post);

            // Добавляем ссылку для других фикстур
            $this->addReference('post_' . $i, $post);
        }

        $manager->flush();
    }
}
