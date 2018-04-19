<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Category;
use AppBundle\Entity\Download;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Project;
use AppBundle\Form\AboutType;
use AppBundle\Form\CategoryType;
use AppBundle\Form\FormationType;
use AppBundle\Form\ProjectType;
use AppBundle\Form\TweeterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

        $cvDownload = $this->get('doctrine')
            ->getRepository(Download::class)
            ->findOneBy(['name' => 'cv']);

        $nbrCvDownload = $cvDownload->getNumber();

        return $this->render('back/dashboard.html.twig', [
            'projects'      => $projectData,
            'abouts'        => $about,
            'form'          => $form->createView(),
            'twitter'       => $twitterData,
            'nbrFriends'    => $numberOfFriends,
            'nbrFeed'       => $numberOfFeed,
            'nbrCvDownload' => $nbrCvDownload
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

    /**
     * @Route("/ajax-add/{slug}", name="Ajax Add", options = { "expose" = true })
     * @Method({"POST"})
     */
    public function ajaxAddAction(Request $request, $slug)
    {
        $entity = $this->get('filter_service')->getEntity($slug);
        $form = $this->get('filter_service')->getForm($slug, $entity);
        $repo = $this->get('filter_service')->getRepo($slug);

        $form->handleRequest($request);

        $cancel = $this->createFormBuilder()
            ->add('cancel', SubmitType::class, ['label' => 'Annuler'])
            ->getForm();

        $cancel->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $entities = $repo->findAll();

            return $this->render("ajax/list_" . $slug . ".html.twig", [
                'entities' => $entities
            ]);
        }

        if ($cancel->isSubmitted() && $cancel->isValid()) {

            $entities = $repo->findAll();

            return $this->render("ajax/list_" . $slug . ".html.twig", [
                'entities' => $entities
            ]);

        }

        return $this->render("ajax/form_" . $slug . ".html.twig", [
            'form' => $form->createView(),
            'cancel'  => $cancel->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/ajax-edit/{slug}/{id}", name="Ajax Edit", options={ "expose" = true })
     * @Method({"POST"})
     */
    public function AjaxEditAction(Request $request, $slug, $id)
    {
        $repo = $this->get('filter_service')->getRepo($slug);
        $entity = $repo->findOneBy(['id' => $id]);

        $editForm = $this->get('filter_service')->getForm($slug, $entity);
        $editForm->handleRequest($request);

        $cancel = $this->createFormBuilder()
            ->add('cancel', SubmitType::class, ['label' => 'Annuler'])
            ->getForm();

        $cancel->handleRequest($request);

        if ($cancel->isSubmitted() && $cancel->isValid()) {

            $entities = $repo->findAll();

            return $this->render("ajax/list_" . $slug . ".html.twig", [
                'entities' => $entities
            ]);

        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $entities = $repo->findAll();

            return $this->render("ajax/list_" . $slug . ".html.twig", [
                'entities' => $entities
            ]);
        }

        return $this->render('ajax/form_' . $slug . '.html.twig', [
            'edit_form' => $editForm->createView(),
            'edit_cancel'  => $cancel->createView(),
            'id' => $id
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/ajax-add-category", name="Ajax Add Category", options={ "expose" = true })
     */
    public function AjaxAddCategoryAction (Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $project = new Project();
            $projectForm = $this->createForm(ProjectType::class, $project);

            return $this->render("ajax/list_category_btn.html.twig", [
                'project_form' => $projectForm->createView()
            ]);
        }


        return $this->render('ajax/add-category.html.twig', [
            'form' => $form->createView()
        ]);
    }
}