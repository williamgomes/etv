<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharacterSeasonEpisode
 */
class CharacterSeasonEpisode
{
    /**
     * @var integer
     */
    private $cseCharacterId;

    /**
     * @var integer
     */
    private $cseSeasonId;

    /**
     * @var integer
     */
    private $cseEpisodeId;

    /**
     * @var integer
     */
    private $cseApperanceCount;

    /**
     * @var \DateTime
     */
    private $cseCreatedOn;

    /**
     * @var integer
     */
    private $cseCreatedBy;

    /**
     * @var \DateTime
     */
    private $cseUpdatedOn;

    /**
     * @var integer
     */
    private $cseUpdatedBy;

    /**
     * @var integer
     */
    private $cseId;


    /**
     * Set cseCharacterId
     *
     * @param integer $cseCharacterId
     * @return CharacterSeasonEpisode
     */
    public function setCseCharacterId($cseCharacterId)
    {
        $this->cseCharacterId = $cseCharacterId;

        return $this;
    }

    /**
     * Get cseCharacterId
     *
     * @return integer 
     */
    public function getCseCharacterId()
    {
        return $this->cseCharacterId;
    }

    /**
     * Set cseSeasonId
     *
     * @param integer $cseSeasonId
     * @return CharacterSeasonEpisode
     */
    public function setCseSeasonId($cseSeasonId)
    {
        $this->cseSeasonId = $cseSeasonId;

        return $this;
    }

    /**
     * Get cseSeasonId
     *
     * @return integer 
     */
    public function getCseSeasonId()
    {
        return $this->cseSeasonId;
    }

    /**
     * Set cseEpisodeId
     *
     * @param integer $cseEpisodeId
     * @return CharacterSeasonEpisode
     */
    public function setCseEpisodeId($cseEpisodeId)
    {
        $this->cseEpisodeId = $cseEpisodeId;

        return $this;
    }

    /**
     * Get cseEpisodeId
     *
     * @return integer 
     */
    public function getCseEpisodeId()
    {
        return $this->cseEpisodeId;
    }

    /**
     * Set cseApperanceCount
     *
     * @param integer $cseApperanceCount
     * @return CharacterSeasonEpisode
     */
    public function setCseApperanceCount($cseApperanceCount)
    {
        $this->cseApperanceCount = $cseApperanceCount;

        return $this;
    }

    /**
     * Get cseApperanceCount
     *
     * @return integer 
     */
    public function getCseApperanceCount()
    {
        return $this->cseApperanceCount;
    }

    /**
     * Set cseCreatedOn
     *
     * @param \DateTime $cseCreatedOn
     * @return CharacterSeasonEpisode
     */
    public function setCseCreatedOn($cseCreatedOn)
    {
        $this->cseCreatedOn = $cseCreatedOn;

        return $this;
    }

    /**
     * Get cseCreatedOn
     *
     * @return \DateTime 
     */
    public function getCseCreatedOn()
    {
        return $this->cseCreatedOn;
    }

    /**
     * Set cseCreatedBy
     *
     * @param integer $cseCreatedBy
     * @return CharacterSeasonEpisode
     */
    public function setCseCreatedBy($cseCreatedBy)
    {
        $this->cseCreatedBy = $cseCreatedBy;

        return $this;
    }

    /**
     * Get cseCreatedBy
     *
     * @return integer 
     */
    public function getCseCreatedBy()
    {
        return $this->cseCreatedBy;
    }

    /**
     * Set cseUpdatedOn
     *
     * @param \DateTime $cseUpdatedOn
     * @return CharacterSeasonEpisode
     */
    public function setCseUpdatedOn($cseUpdatedOn)
    {
        $this->cseUpdatedOn = $cseUpdatedOn;

        return $this;
    }

    /**
     * Get cseUpdatedOn
     *
     * @return \DateTime 
     */
    public function getCseUpdatedOn()
    {
        return $this->cseUpdatedOn;
    }

    /**
     * Set cseUpdatedBy
     *
     * @param integer $cseUpdatedBy
     * @return CharacterSeasonEpisode
     */
    public function setCseUpdatedBy($cseUpdatedBy)
    {
        $this->cseUpdatedBy = $cseUpdatedBy;

        return $this;
    }

    /**
     * Get cseUpdatedBy
     *
     * @return integer 
     */
    public function getCseUpdatedBy()
    {
        return $this->cseUpdatedBy;
    }

    /**
     * Get cseId
     *
     * @return integer 
     */
    public function getCseId()
    {
        return $this->cseId;
    }
}
