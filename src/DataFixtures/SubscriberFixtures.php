<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Subscriber;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SubscriberFixtures extends Fixture implements DependentFixtureInterface
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
            $subscriber = new Subscriber();

            // Выбираем случайных подписчика и подписываемого
            $subscriberId = $faker->numberBetween(1, 10);
            $subscribedId = $faker->numberBetween(1, 10);

            while ($subscriberId === $subscribedId) {
                $subscribedId = $faker->numberBetween(1, 10);
            }

            $subscriber->setSubscriber($this->getReference('user_' . $subscriberId));
            $subscriber->setSubscribed($this->getReference('user_' . $subscribedId));

            $manager->persist($subscriber);
        }

        $manager->flush();
    }
}
