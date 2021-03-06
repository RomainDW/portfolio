<?php

namespace AppBundle\Repository;

/**
 * FormationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FormationRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllData()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f
                      FROM AppBundle:Formation f
                      JOIN AppBundle:Cv cv
                      WHERE f.cvId = cv.id
                      ORDER BY f.date DESC'
            )
            ->getResult();
    }
}
