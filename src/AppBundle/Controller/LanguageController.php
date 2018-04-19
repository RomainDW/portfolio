<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Language;
use AppBundle\Form\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-language/{id}", name="Edit CV Langue")
     * @Method ({"GET", "POST"})
     */
    public function editCvLanguageAction (Request $request, Language $language) {
        $editForm = $this->createForm(LanguageType::class, $language);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($language);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV Langue', ['id' => $language->getId()]);
        }

        return $this->render('back/edit_cv_language.html.twig', [
            'cv_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/add-cv-language", name="Add CV Langue")
     */
    public function addCvLanguage(Request $request)
    {
        $language = new Language();

        $form = $this->createForm(LanguageType::class, $language);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($language);
            $em->flush();

            $this->addFlash(
                'notice',
                "La langue a bien été ajouté !"
            );

            return $this->redirectToRoute('Add CV Langue');
        }

        return $this->render('back/add_cv_language.html.twig', [
            'cv_form' => $form->createView()
        ]);
    }

    /**
     * Delete a Language Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-language/{id}", name="Delete language")
     */
    public function deleteLanguageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Language')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Langue supprimée !'
        );

        return $this->redirectToRoute('Edit CV general', ['id' => 1]);
    }
}