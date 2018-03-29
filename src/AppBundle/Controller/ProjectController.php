<?php

namespace AppBundle\Controller;


use AppBundle\Annotation\Uploadable;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
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
            'project' => $project
        ]);
    }

    /**
     * @return Response
     * @Route("/admin/edit-projects", name="Edit projects")
     */
    public function editCategoriesAction ()
    {
        $projects = $this->get('doctrine')
            ->getRepository(Project::class)
            ->findAll();

        return $this->render('back/edit_projects.html.twig', [
            'projects' => $projects
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