<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild-Séries'
        ]);
    }

    #/**
    # * @Route("/blabla/{mots}")
    # */
    #public function show($mots) 
    #{
    #    return new Response(sprintf('That\'s "%s"!', $mots));
    #}

    /**
     * @Route("/show/{id<\d+>}", methods={"GET"}, name="show")
     */
    public function show($id): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => $id
        ]);
    }

}