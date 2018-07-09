<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LibraryController extends Controller
{
    /**
     * @Route("/library", name="library")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }
}
