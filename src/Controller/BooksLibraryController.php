<?php

namespace App\Controller;

use App\Entity\Books;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class BooksLibraryController extends Controller
{
    /**
     * @Route("library/books", name="books")
     * @param Security $security
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Security $security)
    {
        $user = $security->getUser();

        if($user)
        {
            $username = $user->getUsername();
        } else {
            $username = null;
        }

        $repository = $this->getDoctrine()->getRepository(Books::class);
        $allBooks = $repository->findAll();
        dump($allBooks);

        return $this->render('library/books/index.html.twig', [
            'controller_name' => 'BooksLibraryController',
            'allBooks' => $allBooks,
            'user' => $user,
            'username' => $username
        ]);
    }
}
