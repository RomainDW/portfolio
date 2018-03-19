<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Project;
use AppBundle\Form\AboutType;
use AppBundle\Form\ProjectType;
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


        return $this->render('back/dashboard.html.twig', [
            'projects'      => $projectData,
            'abouts'        => $about,
        ]);
    }

    /**
     * @Route("/admin/add-project", name="Add project")
     */
    public function addProjectAction(Request $request)
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le projet a bien été ajouté !"
            );

            return $this->redirectToRoute('Add project');
        }

        return $this->render('back/add_project.html.twig', [
            'project_form' => $form->createView()
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
     * @Route ("/admin/edit-project/{id}", name="Edit project")
     * @Method ({"GET", "POST"})
     */
    public function editProjectAction (Request $request, Project $project)
    {
        $editForm = $this->createForm(ProjectType::class, $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $project->setEditDate(new \DateTime('Now', new \DateTimeZone('Europe/Paris')));

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le projet a bien été modifié !"
            );

            return $this->redirectToRoute('Edit project', ['id' => $project->getId()]);
        }

        return $this->render('back/edit_project.html.twig', [
            'project_form'  => $editForm->createView(),
        ]);
    }

    /**
     * Delete a Project Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-project/{id}", name="Delete project")
     */
    public function deleteProjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Project')->find($id);

        $em->remove($project);
        $em->flush();

        $this->addFlash(
            'notice',
            'Projet supprimé !'
        );

        return $this->redirectToRoute('Dashboard');
    }
}