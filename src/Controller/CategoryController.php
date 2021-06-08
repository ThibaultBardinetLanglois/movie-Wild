<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Program;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;

/**
 * @Route("/categories", name="categorie_")
 */

class CategoryController extends AbstractController 
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{name}", methods={"GET"}, requirements={"name" = "Horreur|Action|Aventure|Animation|Fantastique"}, name="show")
     */
    /* USE PARAM CONVERTER
    public function show(Category $category): Response
    { 
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }*/


    /**
     * @Route("/{name}", methods={"GET"}, name="show")
     */
    public function show(string $name, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneByName($name);
        
        if ($category === null) {
            throw $this->createNotFoundException('Category not found');
        }

        $programs = $programRepository->findBy(
            ['category' => $category],
            ['id' => 'DESC'], 
            3
        );


        return $this->render('category/show.html.twig', [
            'programs' => $programs,
        ]);
    }
}