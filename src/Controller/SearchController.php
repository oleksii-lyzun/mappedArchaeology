<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            // AJAX Request header: Content-Type : application/x-www-form-urlencoded
            // Key-word is 'user-search', here we get value of key (input search field oh home page)
            $userSearch = $request->request->get('userSearch');

            // answerFromSites can be array or null
            $answerFromSites = $this->getResultFromSitesEntity($userSearch);

            // Send back Response in JSON format
            return new Response(json_encode($answerFromSites, JSON_UNESCAPED_UNICODE));
        }

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    /**
     * @param $request
     * @return mixed|null
     */
    private function getResultFromSitesEntity($request)
    {

        // Entity Manager
        $em = $this->getDoctrine()->getManager();

        // Prepare access to repo
        $repository = $em->getRepository('App:Sites');

        // Do not start search until the length of a query 'll be > 2
        if(mb_strlen($request) > 2)
        {
            // Result as array from SitesRepo with id and site_name_ua
            $entityAnswer = $repository->getSitesLike("{$request}");

            // Adding third key => value to every array in result from SiteRepo
            // Key => value === 'controller' => '/site/show/'
            // & allows to change items of $answer array directly
            foreach ($entityAnswer as &$answer)
            {
                $answer['controller'] = '/sites/show/';
            }
            unset($answer);

            return $entityAnswer;
        } else {
            return null;
        }
    }
}
