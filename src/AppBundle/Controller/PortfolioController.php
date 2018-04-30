<?php


namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Category;
use AppBundle\Entity\Project;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="Portfolio")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->get('doctrine')
            ->getRepository(Category::class)
            ->findBy([], ['name' => 'ASC']);

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
            'abouts'        => $about,
            'categories'    => $categories
        ]);
    }

    /**
     * @Route("/cv", name="Mon CV")
     */
    public function cvAction()
    {
        $parameters = $this->get('cv_entities')->parameters();

        return $this->render('front/cv.html.twig', $parameters);
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
            $getProjects = $em->getRepository(Project::class)->findByCategory($slug);
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

    /**
     * @return Response
     * @Route("/cv-pdf", name="CV")
     */
    public function PdfAction()
    {
        $servicePdf = $this->get('cv_entities');
        $parameters = $servicePdf->parameters();
        $servicePdf->oneMoreDownload();

        $html = $this->renderView('front/cv-pdf.html.twig', $parameters);

        $filename = "CV Romain Ollier";

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, [
                'margin-top'        => 0,
                'margin-bottom'     => 0,
                'margin-right'      => 0,
                'margin-left'       => 0,
                'enable-javascript' => true
            ]),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$filename.'.pdf"'
            ]
        );
    }
}