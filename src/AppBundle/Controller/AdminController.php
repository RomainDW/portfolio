<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Project;
use AppBundle\Form\AboutType;
use AppBundle\Form\TweeterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="Dashboard")
     */
    public function dashboardAction(Request $request)
    {
        $projectData = $this->get('doctrine')
            ->getRepository(Project::class)
            ->findAll();

        $about = $this->get('doctrine')
            ->getRepository(About::class)
            ->findAll();

        $form = $this->createForm(TweeterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app_core.twitter')->tweeter($form->getData()['tweet']);
            $this->addFlash('notice', 'Votre tweet a bien été envoyé !');
            return $this->redirect($request->getUri());
        }

        $twitterData = $this->get('app_core.twitter')->twitterData();
        $numberOfFriends = $this->get('app_core.facebook')->connexion()->getField('friends')->getTotalCount();
        $numberOfFeed = count($this->get('app_core.facebook')->connexion()->getField('feed')->getFieldNames());

        return $this->render('back/dashboard.html.twig', [
            'projects'      => $projectData,
            'abouts'        => $about,
            'form'          => $form->createView(),
            'twitter'       => $twitterData,
            'nbrFriends'    => $numberOfFriends,
            'nbrFeed'       => $numberOfFeed
        ]);
    }

    /**
     * @Route("/admin/edit-about/{id}", name="Edit about")
     * @Method({"GET", "POST"})
     */
    public function aboutEdit (Request $request, About $about)
    {
        $editForm = $this->createForm(AboutType::class, $about);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $about->setUpdatedDate(new \DateTime('Now', new \DateTimeZone('Europe/Paris')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($about);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le texte a bien été modifié !"
            );

            return $this->redirectToRoute('Edit about', ['id' => $about->getId()]);
        }

        return $this->render('back/edit_about.html.twig', [
            'about_form' => $editForm->createView()
        ]);
    }
}