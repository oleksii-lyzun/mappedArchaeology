<?php

namespace App\Controller;

use App\Entity\Books;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BooksLibraryController extends Controller
{
    /**
     * @Route("library/books", name="books")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Books::class);
        $allBooks = $repository->findAll();
        dump($allBooks);

        return $this->render('library/books/index.html.twig', [
            'controller_name' => 'BooksLibraryController',
            'allBooks' => $allBooks
        ]);
    }
}
