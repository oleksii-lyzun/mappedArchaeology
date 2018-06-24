<?php

namespace App\Controller;

use App\Entity\Cultures;
use App\Entity\Eras;
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
        $repositoryEras = $this->getDoctrine()->getRepository(Eras::class);
        $repositoryPeriods = $this->getDoctrine()->getRepository(Periods::class);
        $repositoryCultures = $this->getDoctrine()->getRepository(Cultures::class);

        $allSites = $repository->getAllSitesWithTimes();
        $sites = json_encode($allSites, JSON_UNESCAPED_UNICODE);
        $eras = $repositoryEras->getAllEras();
        $periods = $repositoryPeriods->getAllPeriods();
        $cultures = $repositoryCultures->getAllCultures();

        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
            'sites' => $sites,
            'eras' => $eras,
            'periods' => $periods,
            'cultures' => $cultures,
        ]);
    }
}
