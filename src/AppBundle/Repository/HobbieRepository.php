<?php

namespace AppBundle\Repository;

/**
 * HobbieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HobbieRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllData()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT h
                      FROM AppBundle:Hobbie h
                      JOIN AppBundle:Cv cv
                      WHERE h.cvId = cv.id
                      ORDER BY h.name DESC'
            )
            ->getResult();
    }
}
