<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\TypePost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypePostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Примеры фиксированных типов, которые можно использовать в приложении
        $typeNames = [
            ['name' => 'post', 'class' => 'post'],
            ['name' => 'image', 'class' => 'image'],
            ['name' => 'video', 'class' => 'video'],
            ['name' => 'quote', 'class' => 'quote'],
            ['name' => 'link', 'class' => 'link']
        ];

        foreach ($typeNames as $key => $typeData) {
            $typePost = new TypePost();
            $typePost->setName($typeData['name']);
            $typePost->setClass($typeData['class']);

            $manager->persist($typePost);

            // Сохраняем ссылку для использования в других фикстурах
            $this->addReference('type_' . strtolower($typeData['name']), $typePost);
        }

        $manager->flush();
    }
}
