<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Skill;
use AppBundle\Form\SkillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SkillController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-skill/{id}", name="Edit CV compétence")
     * @Method ({"GET", "POST"})
     */
    public function editCvSkillAction (Request $request, Skill $skill) {
        $editForm = $this->createForm(SkillType::class, $skill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV compétence', ['id' => $skill->getId()]);
        }

        return $this->render('back/edit_cv_skill.html.twig', [
            'cv_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/add-cv-skill", name="Add CV Compétence")
     */
    public function addCvSkill(Request $request)
    {
        $skill = new Skill();

        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            $this->addFlash(
                'notice',
                "La compétence a bien été ajouté !"
            );

            return $this->redirectToRoute('Add CV Compétence');
        }

        return $this->render('back/add_cv_skill.html.twig', [
            'cv_form' => $form->createView()
        ]);
    }

    /**
     * Delete a Skill Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-skill/{id}", name="Delete skill")
     */
    public function deleteSkillAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Skill')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Compétence supprimée !'
        );

        return $this->redirectToRoute('Edit CV general', ['id' => 1]);
    }
}