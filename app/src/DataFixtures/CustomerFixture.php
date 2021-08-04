<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixture extends Fixture {

    private $faker;

    public function __construct() {

        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getCustomer());
        }
        $manager->flush();
    }

//    private function getCustomer(): Customer
//    {
//
//        return new Customer(
//            $this->faker->firstName(),
//            $this->faker->lastName(),
//            $this->faker->email(),
//            $this->faker->phoneNumber(),
//        );
//    }
}
