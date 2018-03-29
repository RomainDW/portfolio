<?php

namespace AppBundle\Repository;

/**
 * LanguageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LanguageRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllData()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l
                      FROM AppBundle:Language l
                      JOIN AppBundle:Cv cv
                      WHERE l.cvId = cv.id'
            )
            ->getResult();
    }
}
