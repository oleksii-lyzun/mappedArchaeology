<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     * @param EntityManager $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('App:Sites')->getSitesLike('р');

        dump($repo);

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
