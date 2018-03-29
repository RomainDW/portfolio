<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="niv", type="string", length=15)
     */
    private $niv;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="school", type="string", length=20)
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=15)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="cv_id", type="integer")
     */
    private $cvId = 1;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set niv
     *
     * @param string $niv
     *
     * @return Formation
     */
    public function setNiv($niv)
    {
        $this->niv = $niv;

        return $this;
    }

    /**
     * Get niv
     *
     * @return string
     */
    public function getNiv()
    {
        return $this->niv;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Formation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set school
     *
     * @param string $school
     *
     * @return Formation
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Formation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set cvId
     *
     * @param integer $cvId
     *
     * @return Formation
     */
    public function setCvId($cvId)
    {
        $this->cvId = $cvId;

        return $this;
    }

    /**
     * Get cvId
     *
     * @return int
     */
    public function getCvId()
    {
        return $this->cvId;
    }
}
