<?php

namespace App\Controller;

use App\Entity\Sites;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitesController extends Controller
{
    /**
     * @Route("/sites", name="sites")
     */
    public function index()
    {
        return $this->render('sites/index.html.twig', [
            'controller_name' => 'SitesController',
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
        $site = $repository->find($id);

        if(!$site)
        {
            throw $this->createNotFoundException("Цієї пам'ятки не існує!");
        }

        return $this->render('sites/show.html.twig', [
            'controller_name' => 'SitesController',
        ]);
    }
}
