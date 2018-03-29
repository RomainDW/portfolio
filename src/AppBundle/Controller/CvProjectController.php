<?php

namespace AppBundle\Controller;


use AppBundle\Entity\CvProject;
use AppBundle\Form\CvProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CvProjectController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-project/{id}", name="Edit CV projet")
     * @Method ({"GET", "POST"})
     */
    public function editCvProjectAction (Request $request, CvProject $project) {
        $editForm = $this->createForm(CvProjectType::class, $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV projet', ['id' => $project->getId()]);
        }

        return $this->render('back/edit_cv_project.html.twig', [
            'cv_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/add-cv-project", name="Add CV Projet")
     */
    public function addCvProject(Request $request)
    {
        $project = new CvProject();

        $form = $this->createForm(CvProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le projet a bien été ajouté !"
            );

            return $this->redirectToRoute('Add CV Projet');
        }

        return $this->render('back/add_cv_project.html.twig', [
            'cv_form' => $form->createView()
        ]);
    }

    /**
     * Delete a CvProject Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-cv-project/{id}", name="Delete CV project")
     */
    public function deleteCvProjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:CvProject')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Projet supprimé !'
        );

        return $this->redirectToRoute('Edit CV projet');
    }
}