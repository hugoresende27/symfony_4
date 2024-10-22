<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // Use Faker to generate random data
        $faker = Factory::create();

        // Create 10 user entries
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setName($faker->userName());
            $user->setEmail ($faker->email());
            $user->setBornDate ($faker->dateTime());

            
            $manager->persist($user);
        }

        // Flush the changes to the database
        $manager->flush();
        $manager->flush();
    }
}
