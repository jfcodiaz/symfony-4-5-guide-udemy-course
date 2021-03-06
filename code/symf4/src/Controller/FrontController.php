<?php

namespace App\Controller;

use App\Entity\Category;
use App\Utils\CategoryTreeFrontPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }

     /**
     * @Route("/video-list/category/{categoryname},{id}", name="video_list")
     */
    public function videoList($id, CategoryTreeFrontPage $categories): Response
    {
        $categories->getCategoryListAndParent($id);
        return $this->render('front/video_list.html.twig',[
            'subcategories' => $categories
        ]);
    }

     /**
     * @Route("/video-details", name="video_details")
     */
    public function videoDetails(): Response
    {
        return $this->render('front/video_details.html.twig');
    }

    /**
     * @Route("/search-result", methods={"POST"}, name="search-results")
     */
    public function searchResults(): Response
    {
        return $this->render('front/search_results.html.twig');
    }

    /**
     * @Route("/pricing", methods={"GET"}, name="pricing")
     */
    public function pricingResults(): Response
    {
        return $this->render('front/pricing.html.twig');
    }

    /**
     * @Route("/register", methods={"GET"}, name="register")
     */
    public function register(): Response
    {
        return $this->render('front/register.html.twig');
    }

    /**
     * @Route("/login", methods={"GET"}, name="login")
     */
    public function login(): Response
    {
        return $this->render('front/login.html.twig');
    }

    /**
     * @Route("/payment", methods={"GET"}, name="payment")
     */
    public function payment(): Response
    {
        return $this->render('front/payment.html.twig');
    }

    public function mainCategories() {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findBy(
            ['parent' => null],
            ['name' => 'ASC']
        );

        return $this->render('front/_main_categories.html.twig', [
            'categories' => $categories
        ]);
    }
}
