<?php

namespace App\Controller;

use App\Entity\Eras;
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
        $eras = [];

        $repository = $this->getDoctrine()->getRepository(Sites::class);
        $repositoryEras = $this->getDoctrine()->getRepository(Eras::class);

        $allSites = $repository->getAllSitesWithTimes();
        $sites = json_encode($allSites, JSON_UNESCAPED_UNICODE);

        dump($repositoryEras->getAllEras());
        //dump($repositoryEras->findAll());

        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
            'sites' => $sites,
        ]);
    }
}
