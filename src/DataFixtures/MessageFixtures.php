<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixtures extends Fixture
{
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 30; $i++) {
            $message = new Message();
            $message->setText($faker->paragraph());
            $message->setCreatedAt($faker->dateTime());

            // Выбираем случайных отправителя и получателя
            $senderId = $faker->numberBetween(1, 10);
            $recipientId = $faker->numberBetween(1, 10);
            while ($recipientId === $senderId) {
                $recipientId = $faker->numberBetween(1, 10);
            }

            $message->setSender($this->getReference('user_' . $senderId));
            $message->setRecipient($this->getReference('user_' . $recipientId));

            $manager->persist($message);
        }

        $manager->flush();
    }
}
