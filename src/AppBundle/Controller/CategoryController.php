<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/admin/add-category", name="Add category")
     */
    public function AddCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'notice',
                "La catégorie a bien été ajouté !"
            );

            return $this->redirectToRoute('Add category');
        }

        return $this->render('back/add_category.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/edit-category/{id}", name="Edit category")
     * @Method ({"GET", "POST"})
     */
    public function editCategoryAction (Request $request, Category $category)
    {
        $editForm = $this->createForm(CategoryType::class, $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'notice',
                "La catégorie a bien été modifiée !"
            );

            return $this->redirectToRoute('Edit category', ['id' => $category->getId()]);
        }

        return $this->render('back/edit_category.html.twig', [
            'category_form'  => $editForm->createView(),
        ]);
    }

    /**
     * @return Response
     * @Route("/admin/edit-categories", name="Edit categories")
     */
    public function editCategoriesAction ()
    {
        $categories = $this->get('doctrine')
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('back/edit_categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * Delete a Category Entity
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/admin/delete-category/{id}", name="Delete category")
     */
    public function deleteCategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->find($id);


        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'notice',
            'Catégorie supprimé !'
        );

        return $this->redirectToRoute('Edit categories');
    }
}