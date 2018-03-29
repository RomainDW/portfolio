<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 26/03/2018
 * Time: 09:56
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Formation;
use AppBundle\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-formation/{id}", name="Edit CV formation")
     * @Method ({"GET", "POST"})
     */
    public function editCvFormationAction (Request $request, Formation $formation) {
        $editForm = $this->createForm(FormationType::class, $formation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV formation', ['id' => $formation->getId()]);
        }

        return $this->render('back/edit_cv_formation.html.twig', [
            'cv_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/add-cv-formation", name="Add CV Formation")
     */
    public function addCvFormation(Request $request)
    {
        $formation = new Formation();

        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            $this->addFlash(
                'notice',
                "La formation a bien été ajouté !"
            );

            return $this->redirectToRoute('Add CV Formation');
        }

        return $this->render('back/add_cv_formation.html.twig', [
            'cv_form' => $form->createView()
        ]);
    }

    /**
     * Delete a Formation Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-formation/{id}", name="Delete formation")
     */
    public function deleteFormationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Formation')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Formation supprimée !'
        );

        return $this->redirectToRoute('Edit CV formation');
    }
}