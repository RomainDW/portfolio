<?php


namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Category;
use AppBundle\Entity\Cv;
use AppBundle\Entity\CvProject;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Hobbie;
use AppBundle\Entity\Language;
use AppBundle\Entity\Project;
use AppBundle\Entity\Skill;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{

    /**
     * @Route("/", name="Portfolio")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->get('doctrine')
            ->getRepository(Category::class)
            ->findAll();

        $about = $this->get('doctrine')
            ->getRepository(About::class)
            ->findAll();

        $form = $this->createForm(ContactType::class);

        $contactMailer = $this->get('contact_mailer');

        if ($contactMailer->process($form, $request)) {

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirect($request->getUri() . '#contact');

        }

        return $this->render('front/index.html.twig', [
            'contact_form'  => $form->createView(),
            'abouts'        => $about,
            'categories'    => $categories
        ]);
    }

    /**
     * @Route("/cv", name="Mon CV")
     */
    public function cvAction()
    {
        $cv = $this->get('doctrine')
            ->getRepository(Cv::class)
            ->find(1);

        $cvProjects = $this->get('doctrine')
            ->getRepository(CvProject::class)
            ->findAllData();

        $cvExp = $this->get('doctrine')
            ->getRepository(Experience::class)
            ->findAllData();

        $cvSkills = $this->get('doctrine')
            ->getRepository(Skill::class)
            ->findAllData();

        $cvFormations = $this->get('doctrine')
            ->getRepository(Formation::class)
            ->findAllData();

        $cvLanguages = $this->get('doctrine')
            ->getRepository(Language::class)
            ->findAllData();

        $cvHobbies = $this->get('doctrine')
            ->getRepository(Hobbie::class)
            ->findAllData();

        return $this->render('front/cv.html.twig', [
            'data'              => $cv,
            'dataProjects'      => $cvProjects,
            'dataExperiences'   => $cvExp,
            'dataSkills'        => $cvSkills,
            'dataFormations'    => $cvFormations,
            'dataLanguages'     => $cvLanguages,
            'dataHobbies'       => $cvHobbies
        ]);
    }

    /**
     * @Route ("/portfolio/{slug}", name="filter", options = { "expose" = true },)
     * @Method({"POST"})
     */
    public function filterAction($slug, Request $request)
    {
        $em = $this->get('doctrine')->getManager();


        if ($slug == 'all') {
            $getProjects = $em->getRepository(Project::class)->findAll();
        }
        else {
//            $getCategory = $em->getRepository(Category::class)->findOneBy(['name' => $slug]);
            $getProjects = $em->getRepository(Project::class)->findByCategory($slug);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination_project = $paginator->paginate(
            $getProjects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('inc/portfolio_gallery.html.twig', [
            'projects' => $pagination_project,
        ]);
    }
}