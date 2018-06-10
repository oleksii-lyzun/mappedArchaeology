<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapsController extends Controller
{
    /**
     * @Route("/maps", name="maps")
     */
    public function index()
    {
        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
        ]);
    }
}
