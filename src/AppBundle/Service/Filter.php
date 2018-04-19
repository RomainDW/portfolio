<?php

namespace AppBundle\Service;


use AppBundle\Entity\CvProject;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Hobbie;
use AppBundle\Entity\Language;
use AppBundle\Entity\Skill;
use AppBundle\Form\CvProjectType;
use AppBundle\Form\ExperienceType;
use AppBundle\Form\FormationType;
use AppBundle\Form\HobbieType;
use AppBundle\Form\LanguageType;
use AppBundle\Form\SkillType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;

class Filter
{
    private $formFactory;
    private $em;

    public function __construct(FormFactory $formFactory, EntityManager $em)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
    }

    public function getEntity($slug){
        if ($slug == 'formation'){
            return new Formation();
        }
        elseif ($slug == 'language'){
            return new Language();
        }
        elseif ($slug == 'hobbie'){
            return new Hobbie();
        }
        elseif ($slug == 'experience'){
            return new Experience();
        }
        elseif ($slug == 'skill'){
            return new Skill();
        }
        elseif ($slug == 'cv-project'){
            return new CvProject();
        }
        else {
            return null;
        }
    }

    public function getForm($slug, $entity){
        if ($slug == 'formation'){
            return $form = $this->formFactory->create(FormationType::class, $entity);
        }
        elseif ($slug == 'language'){
            return $form = $this->formFactory->create(LanguageType::class, $entity);
        }
        elseif ($slug == 'hobbie'){
            return $form = $this->formFactory->create(HobbieType::class, $entity);
        }
        elseif ($slug == 'experience'){
            return $form = $this->formFactory->create(ExperienceType::class, $entity);
        }
        elseif ($slug == 'skill'){
            return $form = $this->formFactory->create(SkillType::class, $entity);
        }
        elseif ($slug == 'cv-project'){
            return $form = $this->formFactory->create(CvProjectType::class, $entity);
        }
        else {
            return null;
        }
    }

    public function getRepo($slug){
        if ($slug == 'formation'){
            return $repo = $this->em->getRepository(Formation::class);
        }
        elseif ($slug == 'language'){
           return $repo = $this->em->getRepository(Language::class);
        }
        elseif ($slug == 'hobbie'){
            return $repo = $this->em->getRepository(Hobbie::class);
        }
        elseif ($slug == 'experience'){
            return $repo = $this->em->getRepository(Experience::class);
        }
        elseif ($slug == 'skill'){
            return $repo = $this->em->getRepository(Skill::class);
        }
        elseif ($slug == 'cv-project'){
            return $repo = $this->em->getRepository(CvProject::class);
        }
        else {
            return null;
        }
    }
}