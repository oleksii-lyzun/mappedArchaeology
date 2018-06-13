<?php

namespace App\Controller;

use App\Entity\Periods;
use App\Entity\Sites;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapsController extends Controller
{
    /**
     * @Route("/maps", name="maps")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Sites::class);
        //$allSites = $repository->find(1);
        ///$allEras = $allSites->getEra()->getValues();
        $allSites = $repository->getAllSitesWithTimes();
        dump($allSites);


        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
        ]);
    }
}
