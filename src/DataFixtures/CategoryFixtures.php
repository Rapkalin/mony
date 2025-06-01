<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ['Groceries', 'Bar/Restaurant', 'Holidays/Weekends', 'Kitty', 'Entertainment', 'Transports', 'Monthly costs'];
        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setIsDefault(true);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
