<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RegisterRepository
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SpoilersRepository extends EntityRepository {

    /**
     * Get Reaction & Response against that reaction
     *
     * @return \EssentialTv\EtvBundle\Entity\SpoilerFeedbacks 
     */
    public function getAllSpoilerEpisode($episodeId = 0) {
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("S.spoilerId, S.spoilerText")
                ->from('EssentialTvEtvBundle:Spoilers', 'S')
                ->where('S.spoilerEpisodeId = :episodeId')
                ->setParameter('episodeId', $episodeId)
                ->orderBy('S.spoilerCreatedOn', 'DESC');

        return $query->getQuery()->getResult();
    }
    
    public function getAllSpoiler(){
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("S.spoilerCharacterIds, S.spoilerEpisodeId")
                ->from('EssentialTvEtvBundle:Spoilers', 'S');

        return $query->getQuery()->getResult();
    }
    
}
