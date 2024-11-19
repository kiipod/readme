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
            ['name' => 'Post', 'class' => 'post'],
            ['name' => 'Image', 'class' => 'image'],
            ['name' => 'Video', 'class' => 'video'],
            ['name' => 'Quote', 'class' => 'quote'],
            ['name' => 'Link', 'class' => 'link']
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
