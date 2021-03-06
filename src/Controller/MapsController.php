<?php

namespace App\Controller;

use App\Entity\Cultures;
use App\Entity\Eras;
use App\Entity\Periods;
use App\Entity\Sites;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class MapsController extends Controller
{
    /**
     * @Route("/maps", name="maps")
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

        $repository = $this->getDoctrine()->getRepository(Sites::class);
        $repositoryEras = $this->getDoctrine()->getRepository(Eras::class);
        $repositoryPeriods = $this->getDoctrine()->getRepository(Periods::class);
        $repositoryCultures = $this->getDoctrine()->getRepository(Cultures::class);

        $allSites = $repository->getAllSitesWithTimes();

        dump($allSites);

        $sites = json_encode($allSites, JSON_UNESCAPED_UNICODE);
        $eras = $repositoryEras->getAllEras();
        $periods = $repositoryPeriods->getAllPeriods();
        $cultures = $repositoryCultures->getAllCultures();

        return $this->render('maps/index.html.twig', [
            'title' => 'Мапа',
            'sites' => $sites,
            'eras' => $eras,
            'periods' => $periods,
            'cultures' => $cultures,
            'user' => $user,
            'username' => $username,
        ]);
    }
}
