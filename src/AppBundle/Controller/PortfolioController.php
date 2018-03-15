<?php


namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);

        $contactMailer = $this->get('contact_mailer');

        if ($contactMailer->process($form, $request)) {

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirect($request->getUri() . '#contact');

        }

        return $this->render('front/index.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cv", name="cv")
     */
    public function cvAction()
    {
        return $this->render('front/cv.html.twig');
    }
}