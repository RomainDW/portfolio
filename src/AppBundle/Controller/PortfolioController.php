<?php


namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Project;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="Portfolio")
     */
    public function indexAction(Request $request)
    {

        $about = $this->get('doctrine')
            ->getRepository(About::class)
            ->findAll();

        $form = $this->createForm(ContactType::class);

        $contactMailer = $this->get('contact_mailer');

        if ($contactMailer->process($form, $request)) {

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirect($request->getUri() . '#contact');

        }

        return $this->render('front/index.html.twig', [
            'contact_form'  => $form->createView(),
            'abouts'         => $about
        ]);
    }

    /**
     * @Route("/cv", name="Mon CV")
     */
    public function cvAction()
    {
        return $this->render('front/cv.html.twig');
    }

    /**
     * @Route ("/portfolio/{slug}", name="filter", options = { "expose" = true },)
     * @Method({"POST"})
     */
    public function filterAction($slug, Request $request)
    {
        $em = $this->get('doctrine')->getManager();

        if ($slug == 'all') {
            $getProjects = $em->getRepository(Project::class)->findAll();
        }
        else {
            $getProjects = $em->getRepository(Project::class)->findBy(['categories' => $slug]);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination_project = $paginator->paginate(
            $getProjects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );


        return $this->render('inc/portfolio_gallery.html.twig', [
            'projects' => $pagination_project,
        ]);
    }
}