<?php


namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Project;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="Portfolio")
     */
    public function indexAction(Request $request)
    {
        $projects = $this->get('doctrine')
            ->getRepository(Project::class)
            ->findAll();

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
            'projects'      => $projects,
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
}