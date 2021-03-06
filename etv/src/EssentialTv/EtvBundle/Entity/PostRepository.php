<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RegisterRepository
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository {

    /**
     * Get Reaction & Response against that reaction
     *
     * @return \EssentialTv\EtvBundle\Entity\Episodes 
     */
    public function getMostPopularPost() {
        return $this->getEntityManager()
                        ->createQuery(
                            'SELECT p.postId, p.postTitle,p.postShowIds,p.postCoverImage,p.postPrimaryType,p.postShowIds,s.showTitle
                            FROM EssentialTvEtvBundle:Posts p
                            LEFT JOIN EssentialTvEtvBundle:Shows s With p.postShowIds = s.showId
                            Order By p.postPopularity DESC')
                        ->setMaxResults(1)
                        ->setFirstResult(0)
                        ->getResult();
    }

    public function getPostList($filter, $offset, $limit) {
        if ($filter == "Popular") {
            $orderBy = "WHERE p.postStatus = 'active' Order By p.postPopularity DESC";
        } else if ($filter == "Newest") {
            $orderBy = "WHERE p.postStatus = 'active' Order By p.postCreatedOn DESC";
        } else if ($filter == "Trending") {
            $backDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month"));
            $orderBy = "WHERE p.postStatus = 'active' AND p.postCreatedOn > " . $backDate . " Order By p.postPopularity DESC";
        }
        return $this->getEntityManager()
                        ->createQuery(
                                'SELECT p.postId, p.postTitle,p.postShowIds,
                            p.postCoverImage,p.postAbout,p.postCreatedOn
                            FROM EssentialTvEtvBundle:Posts p ' . $orderBy)
                        ->setMaxResults($limit)
                        ->setFirstResult($offset)
                        ->getResult();
    }

    public function getPostsByCharactersOrderDesc($characterID) {

        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select("P.postTitle,P.postCoverImage,P.postPrimaryType,S.showTitle")
//                ->addSelect("S")
                ->from('EssentialTvEtvBundle:Posts', 'P')
                ->leftJoin("EssentialTvEtvBundle:Shows", "S", "WITH", "S.showId=P.postShowIds");

        $query->where(
                        $query->expr()->in('P.postCharacterIds', ':characterID')
                )
                ->setParameter('characterID', $characterID)
                ->andWhere("P.postStatus = 'active'")
                ->orderBy('P.postCreatedOn', 'DESC');


        $strQuery = $query->getQuery();

        return $strQuery->execute();
    }
    
    public function getShowsInPost($showIds){
        return $this->getEntityManager()
                        ->createQuery(
                           'SELECT s.showId, s.showTitle,s.showBannerImage,s.showOriginalSummary,s.showApiSummary,s.showOriginalDataSupersede,s.showTheme
                            FROM EssentialTvEtvBundle:Shows s where s.showId in (:showId)')
                        ->setParameter('showId', $showIds)
                        ->getResult();
    }
    
    public function getEpisodesInPost($episodeIds)
    {
            return $this->getEntityManager()
                        ->createQuery(
                           'SELECT e.episodeId,e.episodeSeasonId,e.episodeNumber, e.episodeTitle,e.episodeBannerImage,e.episodeApiSummary,e.episodeOriginalSummary,e.originalDataSupersede,(e.episodeEssentialCountTotal * 100) / (e.episodeEssentialCountTotal + e.episodeNotEssentialCountTotal) as percent
                            FROM EssentialTvEtvBundle:Episodes e where e.episodeId in (:episodeId)')
                        ->setParameter('episodeId', $episodeIds)
                        ->getResult();
    }
    
    public function getCharactersInPost($characterIds)
    {
            return $this->getEntityManager()
                        ->createQuery(
                           'SELECT c.characterId, c.characterTitle,c.characterBannerImage,c.characterOriginalSummary,c.characterApiSummary,c.characterOriginalDataSupersede
                            FROM EssentialTvEtvBundle:Characters c where c.characterId in (:characterId)')
                        ->setParameter('characterId', $characterIds)
                        ->getResult();
    }

}
