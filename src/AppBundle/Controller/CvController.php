<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Cv;
use AppBundle\Entity\CvProject;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Hobbie;
use AppBundle\Entity\Language;
use AppBundle\Entity\Skill;
use AppBundle\Form\CvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CvController extends Controller
{
    /**
     * @Route ("/admin/edit-cv-general/{id}", name="Edit CV general")
     * @Method ({"GET", "POST"})
     */
    public function editCvGeneralAction (Request $request, Cv $cv) {

        $editForm = $this->createForm(CvType::class, $cv);
        $editForm->handleRequest($request);

        $formations = $this->get('doctrine')
            ->getRepository(Formation::class)
            ->findAll();

        $language = $this->get('doctrine')
            ->getRepository(Language::class)
            ->findAll();

        $hobbie = $this->get('doctrine')
            ->getRepository(Hobbie::class)
            ->findAll();

        $experience = $this->get('doctrine')
            ->getRepository(Experience::class)
            ->findAll();

        $project = $this->get('doctrine')
            ->getRepository(CvProject::class)
            ->findAll();

        $skill = $this->get('doctrine')
            ->getRepository(Skill::class)
            ->findAll();



        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($cv);
            $em->flush();

            $this->addFlash(
                'notice',
                "Le cv a bien été modifié !"
            );

            return $this->redirectToRoute('Edit CV general', ['id' => $cv->getId()]);
        }

        return $this->render('back/edit_cv_general.html.twig', [
            'cv_form'  => $editForm->createView(),
            'formations' => $formations,
            'languages' => $language,
            'hobbies' => $hobbie,
            'experiences' => $experience,
            'projects' => $project,
            'skills' => $skill,
        ]);
    }
}