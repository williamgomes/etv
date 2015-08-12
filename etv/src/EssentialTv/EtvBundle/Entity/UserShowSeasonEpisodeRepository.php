<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * RegisterRepository
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserShowSeasonEpisodeRepository extends EntityRepository {

    /**
     * Get Reaction & Response against that reaction
     *
     * @return \EssentialTv\EtvBundle\Entity\UserShowSeasonEpisode 
     */
    public function getRecentShowInfo() {
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("USSE.usseUserId")
                ->addSelect("S.showId,S.showTitle,S.showBannerImage")
                ->from('EssentialTvEtvBundle:UserShowSeasonEpisode', 'USSE')
                ->leftJoin("EssentialTvEtvBundle:Shows", "S", "WITH", "S.showId=USSE.usseShowId")
                ->orderBy('USSE.usseCreatedOn', 'DESC');

        $strQuery = $query->getQuery();

        return $strQuery->execute();
    }
    
    
    
    public function getMaxViewedShowUser() {
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("COUNT(USSE.usseId) AS USSECount")
                ->addSelect("USSE.usseUserId")
                ->addSelect("S.showId,S.showTitle")
                ->from('EssentialTvEtvBundle:UserShowSeasonEpisode', 'USSE')
                ->leftJoin("EssentialTvEtvBundle:Shows", "S", "WITH", "S.showId=USSE.usseShowId")
                ->groupBy("USSE.usseShowId")
                ->addGroupBy("USSE.usseUserId");

        $strQuery = $query->getQuery();

        return $strQuery->execute();
    }
    
    
    public function getRecentShowInfoPerUser($userId) {
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("USSE.usseUserId")
                ->addSelect("S.showId,S.showTitle,S.showBannerImage")
                ->from('EssentialTvEtvBundle:UserShowSeasonEpisode', 'USSE')
                ->leftJoin("EssentialTvEtvBundle:Shows", "S", "WITH", "S.showId=USSE.usseShowId")
                ->where("USSE.usseUserId = :userId")
                ->setParameter("userId", $userId)
                ->orderBy('USSE.usseCreatedOn', 'DESC');

        $strQuery = $query->getQuery();

        return $strQuery->execute();
    }
    
    
    
    public function getMaxViewedShowPerUser($userId) {
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("COUNT(USSE.usseId) AS USSECount")
                ->addSelect("USSE.usseUserId")
                ->addSelect("S.showId,S.showTitle,S.showBannerImage")
                ->from('EssentialTvEtvBundle:UserShowSeasonEpisode', 'USSE')
                ->leftJoin("EssentialTvEtvBundle:Shows", "S", "WITH", "S.showId=USSE.usseShowId")
                ->where("USSE.usseUserId = :userId")
                ->setParameter("userId", $userId)
                ->orderBy("USSECount", "DESC")
                ->groupBy("USSE.usseShowId");

        $strQuery = $query->getQuery();

        return $strQuery->execute();
    }

}