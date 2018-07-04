<?php

namespace App\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     * @param Security $security
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Security $security, Request $request)
    {
        $user = $security->getUser();

        if($user)
        {
            $username = $user->getUsername();
        } else {
            $username = null;
        }

        if($request->isXmlHttpRequest())
        {
            return new Response($request->request->get('name'));
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user,
            'username' => $username,
        ]);
    }
}
