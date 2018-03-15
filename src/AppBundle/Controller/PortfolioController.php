<?php


namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form ->add('send', SubmitType::class, array('label' => 'Envoyer', 'attr' => array('class' => 'btn-xl btn-light sr-button')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact depuis le portfolio : ' . $data['name'])
                ->setFrom($data['from'])
                ->setTo('contact@romain-ollier.com')
                ->setBody(
                    $form->getData()['message'],
                    'text/plain'
                )
            ;

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            $this->get('mailer')->send($message);

            return $this->redirect($request->getUri(). '#contact');

        }

        return $this->render('front/index.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cv", name="cv")
     */
    public function cvAction () {
        return $this->render('front/cv.html.twig');
    }
}