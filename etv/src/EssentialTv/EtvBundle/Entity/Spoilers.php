<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spoilers
 *
 * @ORM\Table(name="spoilers", indexes={@ORM\Index(name="spoiler_episode_id", columns={"spoiler_episode_id"}), @ORM\Index(name="spoiler_user_id", columns={"spoiler_user_id"})})
 * @ORM\Entity
 */
class Spoilers
{
    /**
     * @var string
     *
     * @ORM\Column(name="spoiler_text", type="text", nullable=false)
     */
    private $spoilerText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spoiler_created_on", type="datetime", nullable=true)
     */
    private $spoilerCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="spoiler_created_by", type="integer", nullable=false)
     */
    private $spoilerCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spoiler_updated_on", type="datetime", nullable=false)
     */
    private $spoilerUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="spoiler_updated_by", type="integer", nullable=false)
     */
    private $spoilerUpdatedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="spoiler_status", type="string", nullable=false)
     */
    private $spoilerStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="spoiler_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $spoilerId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="spoiler_user_id", referencedColumnName="user_id")
     * })
     */
    private $spoilerUser;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Episodes
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Episodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="spoiler_episode_id", referencedColumnName="episode_id")
     * })
     */
    private $spoilerEpisode;



    /**
     * Set spoilerText
     *
     * @param string $spoilerText
     * @return Spoilers
     */
    public function setSpoilerText($spoilerText)
    {
        $this->spoilerText = $spoilerText;

        return $this;
    }

    /**
     * Get spoilerText
     *
     * @return string 
     */
    public function getSpoilerText()
    {
        return $this->spoilerText;
    }

    /**
     * Set spoilerCreatedOn
     *
     * @param \DateTime $spoilerCreatedOn
     * @return Spoilers
     */
    public function setSpoilerCreatedOn($spoilerCreatedOn)
    {
        $this->spoilerCreatedOn = $spoilerCreatedOn;

        return $this;
    }

    /**
     * Get spoilerCreatedOn
     *
     * @return \DateTime 
     */
    public function getSpoilerCreatedOn()
    {
        return $this->spoilerCreatedOn;
    }

    /**
     * Set spoilerCreatedBy
     *
     * @param integer $spoilerCreatedBy
     * @return Spoilers
     */
    public function setSpoilerCreatedBy($spoilerCreatedBy)
    {
        $this->spoilerCreatedBy = $spoilerCreatedBy;

        return $this;
    }

    /**
     * Get spoilerCreatedBy
     *
     * @return integer 
     */
    public function getSpoilerCreatedBy()
    {
        return $this->spoilerCreatedBy;
    }

    /**
     * Set spoilerUpdatedOn
     *
     * @param \DateTime $spoilerUpdatedOn
     * @return Spoilers
     */
    public function setSpoilerUpdatedOn($spoilerUpdatedOn)
    {
        $this->spoilerUpdatedOn = $spoilerUpdatedOn;

        return $this;
    }

    /**
     * Get spoilerUpdatedOn
     *
     * @return \DateTime 
     */
    public function getSpoilerUpdatedOn()
    {
        return $this->spoilerUpdatedOn;
    }

    /**
     * Set spoilerUpdatedBy
     *
     * @param integer $spoilerUpdatedBy
     * @return Spoilers
     */
    public function setSpoilerUpdatedBy($spoilerUpdatedBy)
    {
        $this->spoilerUpdatedBy = $spoilerUpdatedBy;

        return $this;
    }

    /**
     * Get spoilerUpdatedBy
     *
     * @return integer 
     */
    public function getSpoilerUpdatedBy()
    {
        return $this->spoilerUpdatedBy;
    }

    /**
     * Set spoilerStatus
     *
     * @param string $spoilerStatus
     * @return Spoilers
     */
    public function setSpoilerStatus($spoilerStatus)
    {
        $this->spoilerStatus = $spoilerStatus;

        return $this;
    }

    /**
     * Get spoilerStatus
     *
     * @return string 
     */
    public function getSpoilerStatus()
    {
        return $this->spoilerStatus;
    }

    /**
     * Get spoilerId
     *
     * @return integer 
     */
    public function getSpoilerId()
    {
        return $this->spoilerId;
    }

    /**
     * Set spoilerUser
     *
     * @param \EssentialTv\EtvBundle\Entity\Users $spoilerUser
     * @return Spoilers
     */
    public function setSpoilerUser(\EssentialTv\EtvBundle\Entity\Users $spoilerUser = null)
    {
        $this->spoilerUser = $spoilerUser;

        return $this;
    }

    /**
     * Get spoilerUser
     *
     * @return \EssentialTv\EtvBundle\Entity\Users 
     */
    public function getSpoilerUser()
    {
        return $this->spoilerUser;
    }

    /**
     * Set spoilerEpisode
     *
     * @param \EssentialTv\EtvBundle\Entity\Episodes $spoilerEpisode
     * @return Spoilers
     */
    public function setSpoilerEpisode(\EssentialTv\EtvBundle\Entity\Episodes $spoilerEpisode = null)
    {
        $this->spoilerEpisode = $spoilerEpisode;

        return $this;
    }

    /**
     * Get spoilerEpisode
     *
     * @return \EssentialTv\EtvBundle\Entity\Episodes 
     */
    public function getSpoilerEpisode()
    {
        return $this->spoilerEpisode;
    }
    /**
     * @var integer
     */
    private $spoilerEpisodeId;

    /**
     * @var integer
     */
    private $spoilerUserId;


    /**
     * Set spoilerEpisodeId
     *
     * @param integer $spoilerEpisodeId
     * @return Spoilers
     */
    public function setSpoilerEpisodeId($spoilerEpisodeId)
    {
        $this->spoilerEpisodeId = $spoilerEpisodeId;

        return $this;
    }

    /**
     * Get spoilerEpisodeId
     *
     * @return integer 
     */
    public function getSpoilerEpisodeId()
    {
        return $this->spoilerEpisodeId;
    }

    /**
     * Set spoilerUserId
     *
     * @param integer $spoilerUserId
     * @return Spoilers
     */
    public function setSpoilerUserId($spoilerUserId)
    {
        $this->spoilerUserId = $spoilerUserId;

        return $this;
    }

    /**
     * Get spoilerUserId
     *
     * @return integer 
     */
    public function getSpoilerUserId()
    {
        return $this->spoilerUserId;
    }
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="spoiler_character_ids", type="text", nullable=true)
     */
    private $spoilerCharacterIds;
    
    
    /**
     * Set spoilerCharacterIds
     *
     * @param string $spoilerCharacterIds
     * @return Spoilers
     */
    public function setSpoilerCharacterIds($spoilerCharacterIds)
    {
        $this->spoilerCharacterIds = $spoilerCharacterIds;

        return $this;
    }

    /**
     * Get spoilerCharacterIds
     *
     * @return string 
     */
    public function getSpoilerCharacterIds()
    {
        return $this->spoilerCharacterIds;
    }
    
}
