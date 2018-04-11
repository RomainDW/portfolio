<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Project;
use AppBundle\Form\AboutType;
use AppBundle\Form\TweeterType;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
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

        $fb = new Facebook([
            'app_id'        => '444713825964663',
            'app_secret'    => '53e84c8c95ab5fcf05382d2692de8468',
            'default_graph_version' => 'v2.10',
        ]);

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me?fields=friends,feed', 'EAAGUdwGfkncBAHZBe5enN2ar59FCaQslQHKVSaWGtCtwngwbJn7lR1H6X9qhiwPLVkYMzm7Vif14ZAqr6KhaFELKDRZAqrh2e3Y894oWtw7Eia2SKCIN1obztzagRqf2i2JB38JgUpu4rKECJaVgKqr1mNapcgADnqN0SFps5pivfLr2cZA69w7JUNTZBBwcjhRjmrnrfdwZDZD');
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();

        $numberOfFriends = $me->getField('friends')->getTotalCount();
        $numberOfFeed = count($me->getField('feed')->getFieldNames());

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