<?php

namespace App\Controller;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\DefaultView;
use Pagerfanta\View\OptionableView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesLibraryController extends Controller
{
    /**
     * @Route("/library/articles", name="articles")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        // equivalent of GET
        $page = $request->query->get('page', 1);

        // we're getting all the messages
        $qb = $this->getDoctrine()
            ->getRepository('App:Articles')
            ->findAllQueryBuilder();

        $adapter = new ArrayAdapter($qb);
        $pagerFanta = new Pagerfanta($adapter);

        // setting up maximum messages from users per page
        $pagerFanta->setMaxPerPage(5);

        // setting up current page to $page
        $pagerFanta->setCurrentPage($page);

        return $this->render('library/articles/articles.html.twig', [
            'title' => 'Бібліотека / Статті',
            'user' => null,
            'fanta' => $pagerFanta
        ]);
    }
}
