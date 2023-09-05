<?php

namespace App\DataFixtures;

use App\Entity\Estate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->addEstate($manager);
    }

    private function addEstate(ObjectManager $manager){
        $faker = Factory::create('fr_FR');

        for($i = 0; $i<200; $i++){
            $estate = new Estate();
            $hasOutdoor = $faker->boolean;

            $estate
                ->setArea($faker->randomFloat(2, 20, 500))
                ->setRoom($faker->numberBetween(1, 20))
                ->setType($faker->randomElement(['House', 'Flat', 'Yurt']))
                ->setAdress($faker->address())
                ->setCity($faker->city)
                ->setPool($faker->boolean)
                ->setOutdoor($hasOutdoor)  // Set the Outdoor value
                ->setGarage($faker->boolean)
                ->setTransaction($faker->randomElement(['Sell','Rent']))
                ->setPrice($faker->randomFloat(2, 60000, 1000000))
                ->setCreatedAt($faker->dateTimeBetween('-5 years', new \DateTime()))
                ->setPicture($faker->randomElement(['house.avif', 'maison1.jpg', 'maison2.jpg'
                    , 'maison3.jpg', 'maison4.jpg', 'maison5.jpg', 'maison6.webp', 'maison7.jpg'
                    , 'maison8.jpg', 'maison9.webp', 'maison10.jpg', 'maison11.jpg', 'maison13.webp', 'maison14.jpg', 'maison15.jpg', 'maison16.jpg', 'maison17.jpg', 'maison18.webp', 'maison19.jpg', 'maison20.jpg', 'maison12.webp']));

            if ($hasOutdoor) {
                $estate->setOutdoorArea($faker->randomFloat(2,10,2000)); // Set OutdoorArea if Outdoor is true
            }
            $manager->persist($estate);
        }
        $manager->flush();
    }
}
