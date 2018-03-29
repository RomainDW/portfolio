<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Experience;
use AppBundle\Form\ExperienceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ExperienceController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-experience/{id}", name="Edit CV experience")
     * @Method ({"GET", "POST"})
     */
    public function editCvExperienceAction (Request $request, Experience $experience) {
        $editForm = $this->createForm(ExperienceType::class, $experience);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV experience', ['id' => $experience->getId()]);
        }

        return $this->render('back/edit_cv_experience.html.twig', [
            'cv_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/add-cv-experience", name="Add CV Expérience")
     */
    public function addExperience(Request $request)
    {
        $experience = new Experience();

        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            $this->addFlash(
                'notice',
                "L'expérience a bien été ajouté !"
            );

            return $this->redirectToRoute('Add CV Expérience');
        }

        return $this->render('back/add_cv_experience.html.twig', [
            'cv_form' => $form->createView()
        ]);
    }

    /**
     * Delete an Experience Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-experience/{id}", name="Delete experience")
     */
    public function deleteExperienceAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Experience')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Expérience supprimée !'
        );

        return $this->redirectToRoute('Edit CV experience');
    }
}