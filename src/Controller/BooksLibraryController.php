<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BooksLibraryController extends Controller
{
    /**
     * @Route("library/books", name="books")
     */
    public function index()
    {
        return $this->render('library/books/index.html.twig', [
            'controller_name' => 'BooksLibraryController',
        ]);
    }
}
