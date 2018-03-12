<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name',TextType::class, array('label' => 'Nom', 'label_attr' => array('class' => 'text-white'), 'attr' => array('placeholder' => 'Entrez votre Nom')) )
            ->add('from', EmailType::class, array('label' => 'Email', 'label_attr' => array('class' => 'text-white') , 'attr' => array('placeholder' => 'Entrez votre adresse email')))
            ->add('message', TextareaType::class, array('label_attr' => array('class' => 'text-white'), 'attr' => array('placeholder' => 'Entrez votre message', 'rows' => '5')))
            ->add('send', SubmitType::class, array('label' => 'Envoyer', 'attr' => array('class' => 'btn-xl btn-light sr-button')))
            ->getForm()
        ;

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

            return $this->redirect($request->getUri());

        }

        return $this->render('front/index.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }
}