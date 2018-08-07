<?php

namespace App\Controller;

use App\Entity\Sites;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class SitesController extends Controller
{
    private $user;
    private $username;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();

        // Checking out if user is logged in
        // If not - $username = null
        if($this->user)
        {
            $this->username = $this->user->getUsername();
        } else {
            $username = null;
        }
    }

    /**
     * @Route("/sites", name="sites")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {

        // equivalent of GET
        $page = $request->query->get('page', 1);

        // we're getting all the messages
        $qb = $this->getDoctrine()
            ->getRepository('App:Sites')
            ->findAllQueryBuilder();

        $adapter = new ArrayAdapter($qb);
        $pagerFanta = new Pagerfanta($adapter);

        // setting up maximum messages from users per page
        $pagerFanta->setMaxPerPage(5);

        // setting up current page to $page
        $pagerFanta->setCurrentPage($page);

        return $this->render('sites/index.html.twig', [
            'title' => "Пам'ятки",
            'fanta' => $pagerFanta,
            'user' => $this->user,
            'username' => $this->username
        ]);
    }

    /**
     * @Route("/sites/show/{id}", requirements={"id"="\d+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Sites::class);
        $site = $repository->getOneSiteById($id);

        if(!$site || !$site->getIsPublished())
        {
            throw $this->createNotFoundException("Цієї пам'ятки не існує!");
        }

        return $this->render('sites/show.html.twig', [
            'title' => $site->getSiteNameUa(),
            'site' => $site,
            'user' => $this->user,
            'username' => $this->username,
        ]);
    }
}
