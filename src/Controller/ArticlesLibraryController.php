<?php

namespace App\Controller;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class ArticlesLibraryController extends Controller
{
    /**
     * @var null|\Symfony\Component\Security\Core\User\UserInterface
     */
    private $user;

    /**
     * @var null|string
     */
    private $username = null;

    /**
     * ArticlesLibraryController constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->user = $security->getUser();

        // Checking out if user is logged in
        // If not - $username = null
        if($this->user)
        {
            $this->username = $this->user->getUsername();
        }
    }

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
        $pagerFanta->setMaxPerPage(6);

        // setting up current page to $page
        $pagerFanta->setCurrentPage($page);

        return $this->render('library/articles/articles.html.twig', [
            'title' => 'Бібліотека / Статті',
            'user' => null,
            'fanta' => $pagerFanta
        ]);
    }

    /**
     * @Route("/library/articles/show/{id}", requirements={"id"="\d+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository('App:Articles');
        $article = $repository->find($id);

        if(!$article || !$article->getIsActive())
        {
            throw $this->createNotFoundException("Цієї статті не існує!");
        }

        return $this->render('library/articles/showArticle.html.twig', [
            'title' => $article->getTitle(),
            'username' => $this->username,
            'user' => $this->user,
            'article' => $article,
        ]);
    }
}
