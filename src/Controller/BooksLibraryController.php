<?php

namespace App\Controller;

use App\Entity\Books;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class BooksLibraryController extends Controller
{
    /**
     * @Route("library/books", name="books")
     * @param Security $security
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Security $security, Request $request)
    {
        $user = $security->getUser();

        if($user)
        {
            $username = $user->getUsername();
        } else {
            $username = null;
        }

        // equivalent of GET
        $page = $request->query->get('page', 1);

        // we're getting all the messages
        $qb = $this->getDoctrine()
            ->getRepository('App:Books')
            ->findAllQueryBuilder();

        $adapter = new ArrayAdapter($qb);
        $pagerFanta = new Pagerfanta($adapter);

        // setting up maximum messages from users per page
        $pagerFanta->setMaxPerPage(5);

        // setting up current page to $page
        $pagerFanta->setCurrentPage($page);

        return $this->render('library/books/books.html.twig', [
            'title' => 'Бібліотека / Книги',
            'user' => $user,
            'username' => $username,
            'fanta' => $pagerFanta,
        ]);
    }
}
