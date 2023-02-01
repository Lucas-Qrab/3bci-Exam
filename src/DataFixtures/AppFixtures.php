<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Medias;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < 3; $i++) {
            $medias = new Medias();
            $medias->setName("La vie de " . $faker->name);
            $medias->setSynopsis($faker->realText(200));
            $medias->setType("Film");
            $medias->setCreationDate($faker->dateTimeBetween('- 20 year', 'now'));
            $medias->setImageUrl($faker->imageUrl(640, 480, 'people', true, true ));
            $medias->setAuthor($faker->name);
            $medias->setActors([$faker->name, $faker->name, $faker->name]);
            $manager->persist($medias);
        }

        for ($i = 0; $i < 3; $i++) {
            $medias = new Medias();
            $medias->setName("La vengence du " . $faker->word);
            $medias->setSynopsis($faker->realText(200));
            $medias->setType("Film");
            $medias->setCreationDate($faker->dateTimeBetween('- 20 year', 'now'));
            $medias->setImageUrl($faker->imageUrl(640, 480, 'animals', true, true));
            $medias->setAuthor($faker->name);
            $medias->setActors([$faker->name, $faker->name, $faker->name]);
            $manager->persist($medias);
        }

        for ($i = 0; $i < 10; $i++) {
            $medias = new Medias();
            $medias->setName($faker->realText(20));
            $medias->setSynopsis($faker->realText(200));
            $medias->setType("Serie");
            $medias->setCreationDate($faker->dateTimeBetween('- 20 year', 'now'));
            $medias->setImageUrl($faker->imageUrl(640, 480, null, true, true));
            $medias->setAuthor($faker->name);
            $medias->setActors([$faker->name, $faker->name, $faker->name]);
            $manager->persist($medias);
        }



        $manager->flush();
    }
}
