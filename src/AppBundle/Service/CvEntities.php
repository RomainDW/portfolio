<?php

namespace AppBundle\Service;


use AppBundle\Entity\Cv;
use AppBundle\Entity\CvProject;
use AppBundle\Entity\Download;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Hobbie;
use AppBundle\Entity\Language;
use AppBundle\Entity\Skill;
use Doctrine\ORM\EntityManager;

class CvEntities
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAllCvEntities()
    {
        $cv = $this->em
            ->getRepository(Cv::class)
            ->find(1);

        $cvProjects = $this->em
            ->getRepository(CvProject::class)
            ->findAllData();

        $cvExp = $this->em
            ->getRepository(Experience::class)
            ->findAllData();

        $cvSkills = $this->em
            ->getRepository(Skill::class)
            ->findAllData();

        $cvFormations = $this->em
            ->getRepository(Formation::class)
            ->findAllData();

        $cvLanguages = $this->em
            ->getRepository(Language::class)
            ->findAllData();

        $cvHobbies = $this->em
            ->getRepository(Hobbie::class)
            ->findAllData();

        return [
            'cv'            => $cv,
            'cvProjects'    => $cvProjects,
            'cvExp'         => $cvExp,
            'cvSkills'      => $cvSkills,
            'cvFormations'  => $cvFormations,
            'cvLanguages'   => $cvLanguages,
            'cvHobbies'     => $cvHobbies
        ];
    }

    public function parameters()
    {
        $cvEntities = $this->getAllCvEntities();

        $html = [
            'data'              => $cvEntities['cv'],
            'dataProjects'      => $cvEntities['cvProjects'],
            'dataExperiences'   => $cvEntities['cvExp'],
            'dataSkills'        => $cvEntities['cvSkills'],
            'dataFormations'    => $cvEntities['cvFormations'],
            'dataLanguages'     => $cvEntities['cvLanguages'],
            'dataHobbies'       => $cvEntities['cvHobbies']
        ];

        return $html;
    }

    public function oneMoreDownload()
    {
        $download = $this->em
            ->getRepository(Download::class)
            ->findOneBy(['name' => 'cv']);
        $nbr = $download->getNumber();
        $newNbr = $nbr+1;
        $download->setNumber($newNbr);

        $this->em->persist($download);
        $this->em->flush();
    }
}