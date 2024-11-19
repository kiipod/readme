<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->email());
            $user->setLogin($faker->unique()->userName());
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password123'));
            $user->setAvatarFile($faker->imageUrl(100, 100, 'people', true, 'avatar'));
            $user->setRoles(['ROLE_USER']);
            $user->setCreatedAt($faker->dateTime());

            $manager->persist($user);

            // Добавляем ссылку для других фикстур
            $this->addReference('user_' . $i, $user);
        }

        $manager->flush();
    }
}
