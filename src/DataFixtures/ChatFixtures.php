<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Chat;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ChatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 30; $i++) {
            $message = new Chat();
            $message->setText($faker->paragraph());
            $message->setCreatedAt($faker->dateTime());

            // Выбираем случайных отправителя и получателя
            $senderId = $faker->numberBetween(1, 10);
            $recipientId = $faker->numberBetween(1, 10);
            while ($recipientId === $senderId) {
                $recipientId = $faker->numberBetween(1, 10);
            }

            $message->setSender($this->getReference('user_' . $senderId, User::class));
            $message->setRecipient($this->getReference('user_' . $recipientId, User::class));

            $manager->persist($message);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
