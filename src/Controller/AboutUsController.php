<?php

namespace App\Controller;

use Pagerfanta\Adapter\ArrayAdapter;
use App\Entity\MessagesFromUsers;
use App\Form\MessageType;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class AboutUsController extends Controller
{
    private $user;
    private $username;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();

        // Checking out if user is logged in
        // If not - $username = null
        if($this->user)
        {
            $this->username = $this->user->getUsername();
        } else {
            $username = null;
        }
    }

    /**
     * @Route("/about-us", name="about_us")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        //Let's build a form
        $messages = new MessagesFromUsers();
        $form = $this->createForm(MessageType::Class, $messages);

        //uses a NativeRequestHandler object to read data off of the correct PHP superglobals (i.e. $_POST or $_GET)
        // based on the HTTP method configured on the form (POST is default)
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($messages);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            // redirects user on the same page
            return $this->redirectToRoute('about_us');
        }

        // equivalent of GET
        $page = $request->query->get('page', 1);

        // we're getting all the messages
        $qb = $this->getDoctrine()
            ->getRepository('App:MessagesFromUsers')
            ->findAllQueryBuilder();

        $adapter = new ArrayAdapter($qb);
        $pagerFanta = new Pagerfanta($adapter);

        // setting up maximum messages from users per page
        $pagerFanta->setMaxPerPage(5);

        // setting up current page to $page
        $pagerFanta->setCurrentPage($page);

        return $this->render(
            'about_us/index.html.twig',
            array('form' => $form->createView(),
                'user' => $this->user,
                'username' => $this->username,
                'fanta' => $pagerFanta,
                'title' => 'Про нас')
        );
    }
}
