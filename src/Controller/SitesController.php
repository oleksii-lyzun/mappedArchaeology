<?php

namespace App\Controller;

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
}
