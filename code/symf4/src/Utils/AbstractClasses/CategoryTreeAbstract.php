<?php

namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class CategoryTreeAbstract {

    protected $entityManager;
    public $urlgenerator;

    public $categoriesArrayFromDb;
    public $categoryList;


    protected static $dbconnection;

    public function __construct(EntityManagerInterface $entityManager,
    UrlGeneratorInterface $urlgenerator) {
        $this->entityManager = $entityManager;
        $this->urlgenerator = $urlgenerator;
        $this->categoriesArrayFromDb = $this->getCategories();
    }

    abstract public function  getCategoryList(array $categories_array);

    public function buildTree(int $parent_id = null) : array
    {
        $subcategory = [];
        foreach($this->categoriesArrayFromDb as $category) {
            if($category['parent_id'] == $parent_id) {
                $children = $this->buildTree($category['id']);  
                if($children) {
                    $category['children'] = $children;
                }
                $subcategory[] = $category;
            }
        }
        return $subcategory;
    }

    private function getCategories() : array
    {
        if(!self::$dbconnection) {
            $con = $this->entityManager->getConnection();
            $sql = "SELECT * FROM categories";
            $stm = $con->prepare($sql);
            $result = $stm->executeQuery();
            self::$dbconnection = $result->fetchAllAssociative();
        }
        return self::$dbconnection;   
    }
}