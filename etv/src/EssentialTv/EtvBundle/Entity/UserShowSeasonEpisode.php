<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserShowSeasonEpisode
 */
class UserShowSeasonEpisode
{
    /**
     * @var integer
     */
    public $usseUserId;

    /**
     * @var integer
     */
    private $usseShowId;

    /**
     * @var integer
     */
    private $usseSeasonId;

    /**
     * @var integer
     */
    private $usseEpisodeId;

    /**
     * @var integer
     */
    private $usseCreatedBy;

    /**
     * @var \DateTime
     */
    private $usseCreatedOn;

    /**
     * @var integer
     */
    private $usseUpdatedBy;

    /**
     * @var \DateTime
     */
    private $usseUpdatedOn;

    /**
     * @var integer
     */
    private $usseId;


    /**
     * Set usseUserId
     *
     * @param integer $usseUserId
     * @return UserShowSeasonEpisode
     */
    public function setUsseUserId($usseUserId)
    {
        $this->usseUserId = $usseUserId;

        return $this;
    }

    /**
     * Get usseUserId
     *
     * @return integer 
     */
    public function getUsseUserId()
    {
        return $this->usseUserId;
    }

    /**
     * Set usseShowId
     *
     * @param integer $usseShowId
     * @return UserShowSeasonEpisode
     */
    public function setUsseShowId($usseShowId)
    {
        $this->usseShowId = $usseShowId;

        return $this;
    }

    /**
     * Get usseShowId
     *
     * @return integer 
     */
    public function getUsseShowId()
    {
        return $this->usseShowId;
    }

    /**
     * Set usseSeasonId
     *
     * @param integer $usseSeasonId
     * @return UserShowSeasonEpisode
     */
    public function setUsseSeasonId($usseSeasonId)
    {
        $this->usseSeasonId = $usseSeasonId;

        return $this;
    }

    /**
     * Get usseSeasonId
     *
     * @return integer 
     */
    public function getUsseSeasonId()
    {
        return $this->usseSeasonId;
    }

    /**
     * Set usseEpisodeId
     *
     * @param integer $usseEpisodeId
     * @return UserShowSeasonEpisode
     */
    public function setUsseEpisodeId($usseEpisodeId)
    {
        $this->usseEpisodeId = $usseEpisodeId;

        return $this;
    }

    /**
     * Get usseEpisodeId
     *
     * @return integer 
     */
    public function getUsseEpisodeId()
    {
        return $this->usseEpisodeId;
    }

    /**
     * Set usseCreatedBy
     *
     * @param integer $usseCreatedBy
     * @return UserShowSeasonEpisode
     */
    public function setUsseCreatedBy($usseCreatedBy)
    {
        $this->usseCreatedBy = $usseCreatedBy;

        return $this;
    }

    /**
     * Get usseCreatedBy
     *
     * @return integer 
     */
    public function getUsseCreatedBy()
    {
        return $this->usseCreatedBy;
    }

    /**
     * Set usseCreatedOn
     *
     * @param \DateTime $usseCreatedOn
     * @return UserShowSeasonEpisode
     */
    public function setUsseCreatedOn($usseCreatedOn)
    {
        $this->usseCreatedOn = $usseCreatedOn;

        return $this;
    }

    /**
     * Get usseCreatedOn
     *
     * @return \DateTime 
     */
    public function getUsseCreatedOn()
    {
        return $this->usseCreatedOn;
    }

    /**
     * Set usseUpdatedBy
     *
     * @param integer $usseUpdatedBy
     * @return UserShowSeasonEpisode
     */
    public function setUsseUpdatedBy($usseUpdatedBy)
    {
        $this->usseUpdatedBy = $usseUpdatedBy;

        return $this;
    }

    /**
     * Get usseUpdatedBy
     *
     * @return integer 
     */
    public function getUsseUpdatedBy()
    {
        return $this->usseUpdatedBy;
    }

    /**
     * Set usseUpdatedOn
     *
     * @param \DateTime $usseUpdatedOn
     * @return UserShowSeasonEpisode
     */
    public function setUsseUpdatedOn($usseUpdatedOn)
    {
        $this->usseUpdatedOn = $usseUpdatedOn;

        return $this;
    }

    /**
     * Get usseUpdatedOn
     *
     * @return \DateTime 
     */
    public function getUsseUpdatedOn()
    {
        return $this->usseUpdatedOn;
    }

    /**
     * Get usseId
     *
     * @return integer 
     */
    public function getUsseId()
    {
        return $this->usseId;
    }
}
