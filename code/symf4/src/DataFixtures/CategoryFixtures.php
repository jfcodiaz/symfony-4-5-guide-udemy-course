<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadMainCategories($manager);
        $this->loadSubcategory($manager, 'Electronics', 1);
        $this->loadSubcategory($manager, 'Computers', 6);
        $this->loadSubcategory($manager, 'Laptops', 8);
        $this->loadSubcategory($manager, 'Books', 3);
        $this->loadSubcategory($manager, 'Movies', 4);
        $this->loadSubcategory($manager, 'Romance', 17);
    }

    public function loadMainCategories($manager) {
        foreach ($this->getMainCategoriesData() as [$name]) {
            $category = new Category();        
            $manager->persist($category);
            $category->setName($name);
        }

        $manager->flush();
    }

    public function loadSubcategory($manager, $category, $parent_id) {
        $parent = $manager->getRepository(Category::class)->find($parent_id);
        $methodName = "get{$category}Data";
        foreach ($this->$methodName() as [$name]) {
            $category = new Category();            
            $manager->persist($category);
            $category->setName($name);
            $category->setParent($parent);
        }

        $manager->flush();
    }

    public function getMainCategoriesData() {
        return [
            ['Electronics', 1],
            ['Toys', 2], 
            ['Books', 3], 
            ['Movies', 4]
        ];
    }

    public function getElectronicsData() {
        return [
            ['Cameras', 5],
            ['Computers', 6], 
            ['Cell phones', 7], 
            
        ];
    }

    public function getComputersData() {
        return [
            ['Laptos', 8],
            ['Desktop', 9]
            
        ];
    }

    public function getLaptopsData() {
        return [
            ['Apple', 10],
            ['Asus', 11],
            ['Lenovo', 12],
            ['HP', 13]
        ];
    }

    public function getBooksData() {
        return [
            ['Children\'s Books', 14],
            ['Kindle eBooks', 15]
        ];
    }

    public function getMoviesData() {
        return [
            ['Family', 16],
            ['Romance', 17]
        ];
    }

    public function getRomanceData() {
        return [
            ['Romantic Comedy', 18],
            ['Romantic Drama', 19]
        ];
    }

}
