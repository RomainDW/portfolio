<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Hobbie;
use AppBundle\Form\HobbieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HobbieController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-hobbie/{id}", name="Edit CV Hobbie")
     * @Method ({"GET", "POST"})
     */
    public function editCvHobbieAction (Request $request, Hobbie $hobbie) {
        $editForm = $this->createForm(HobbieType::class, $hobbie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($hobbie);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV Hobbie', ['id' => $hobbie->getId()]);
        }

        return $this->render('back/edit_cv_hobbie.html.twig', [
            'cv_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/add-cv-hobbie", name="Add CV Hobbie")
     */
    public function addCvHobbie(Request $request)
    {
        $hobbie = new Hobbie();

        $form = $this->createForm(HobbieType::class, $hobbie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hobbie);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le hobbie a bien été ajouté !"
            );

            return $this->redirectToRoute('Add CV Hobbie');
        }

        return $this->render('back/add_cv_hobbie.html.twig', [
            'cv_form' => $form->createView()
        ]);
    }

    /**
     * Delete a Hobbie Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-hobbie/{id}", name="Delete hobbie")
     */
    public function deleteHobbieAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Hobbie')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Hobbie supprimé !'
        );

        return $this->redirectToRoute('Edit CV general', ['id' => 1]);
    }
}