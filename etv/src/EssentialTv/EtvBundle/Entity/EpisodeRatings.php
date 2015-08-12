<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EpisodeRatings
 *
 * @ORM\Table(name="episode_ratings", indexes={@ORM\Index(name="ER_show_id", columns={"ER_show_id"}), @ORM\Index(name="ER_episode_id", columns={"ER_episode_id"}), @ORM\Index(name="ER_user_id", columns={"ER_user_id"})})
 * @ORM\Entity
 */
class EpisodeRatings
{
    /**
     * @var string
     *
     * @ORM\Column(name="ER_rating_value", type="string", nullable=false)
     */
    private $erRatingValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ER_created_on", type="datetime", nullable=false)
     */
    private $erCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="ER_created_by", type="integer", nullable=false)
     */
    private $erCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ER_updated_on", type="datetime", nullable=true)
     */
    private $erUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="ER_updated_by", type="integer", nullable=true)
     */
    private $erUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="ER_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $erId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ER_user_id", referencedColumnName="user_id")
     * })
     */
    private $erUser;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Episodes
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Episodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ER_episode_id", referencedColumnName="episode_id")
     * })
     */
    private $erEpisode;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Shows
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Shows")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ER_show_id", referencedColumnName="show_id")
     * })
     */
    private $erShow;



    /**
     * Set erRatingValue
     *
     * @param string $erRatingValue
     * @return EpisodeRatings
     */
    public function setErRatingValue($erRatingValue)
    {
        $this->erRatingValue = $erRatingValue;

        return $this;
    }

    /**
     * Get erRatingValue
     *
     * @return string 
     */
    public function getErRatingValue()
    {
        return $this->erRatingValue;
    }

    /**
     * Set erCreatedOn
     *
     * @param \DateTime $erCreatedOn
     * @return EpisodeRatings
     */
    public function setErCreatedOn($erCreatedOn)
    {
        $this->erCreatedOn = $erCreatedOn;

        return $this;
    }

    /**
     * Get erCreatedOn
     *
     * @return \DateTime 
     */
    public function getErCreatedOn()
    {
        return $this->erCreatedOn;
    }

    /**
     * Set erCreatedBy
     *
     * @param integer $erCreatedBy
     * @return EpisodeRatings
     */
    public function setErCreatedBy($erCreatedBy)
    {
        $this->erCreatedBy = $erCreatedBy;

        return $this;
    }

    /**
     * Get erCreatedBy
     *
     * @return integer 
     */
    public function getErCreatedBy()
    {
        return $this->erCreatedBy;
    }

    /**
     * Set erUpdatedOn
     *
     * @param \DateTime $erUpdatedOn
     * @return EpisodeRatings
     */
    public function setErUpdatedOn($erUpdatedOn)
    {
        $this->erUpdatedOn = $erUpdatedOn;

        return $this;
    }

    /**
     * Get erUpdatedOn
     *
     * @return \DateTime 
     */
    public function getErUpdatedOn()
    {
        return $this->erUpdatedOn;
    }

    /**
     * Set erUpdatedBy
     *
     * @param integer $erUpdatedBy
     * @return EpisodeRatings
     */
    public function setErUpdatedBy($erUpdatedBy)
    {
        $this->erUpdatedBy = $erUpdatedBy;

        return $this;
    }

    /**
     * Get erUpdatedBy
     *
     * @return integer 
     */
    public function getErUpdatedBy()
    {
        return $this->erUpdatedBy;
    }

    /**
     * Get erId
     *
     * @return integer 
     */
    public function getErId()
    {
        return $this->erId;
    }

    /**
     * Set erUser
     *
     * @param \EssentialTv\EtvBundle\Entity\Users $erUser
     * @return EpisodeRatings
     */
    public function setErUser(\EssentialTv\EtvBundle\Entity\Users $erUser = null)
    {
        $this->erUser = $erUser;

        return $this;
    }

    /**
     * Get erUser
     *
     * @return \EssentialTv\EtvBundle\Entity\Users 
     */
    public function getErUser()
    {
        return $this->erUser;
    }

    /**
     * Set erEpisode
     *
     * @param \EssentialTv\EtvBundle\Entity\Episodes $erEpisode
     * @return EpisodeRatings
     */
    public function setErEpisode(\EssentialTv\EtvBundle\Entity\Episodes $erEpisode = null)
    {
        $this->erEpisode = $erEpisode;

        return $this;
    }

    /**
     * Get erEpisode
     *
     * @return \EssentialTv\EtvBundle\Entity\Episodes 
     */
    public function getErEpisode()
    {
        return $this->erEpisode;
    }

    /**
     * Set erShow
     *
     * @param \EssentialTv\EtvBundle\Entity\Shows $erShow
     * @return EpisodeRatings
     */
    public function setErShow(\EssentialTv\EtvBundle\Entity\Shows $erShow = null)
    {
        $this->erShow = $erShow;

        return $this;
    }

    /**
     * Get erShow
     *
     * @return \EssentialTv\EtvBundle\Entity\Shows 
     */
    public function getErShow()
    {
        return $this->erShow;
    }
    /**
     * @var integer
     */
    private $erShowId;

    /**
     * @var integer
     */
    private $erEpisodeId;

    /**
     * @var integer
     */
    private $erUserId;


    /**
     * Set erShowId
     *
     * @param integer $erShowId
     * @return EpisodeRatings
     */
    public function setErShowId($erShowId)
    {
        $this->erShowId = $erShowId;

        return $this;
    }

    /**
     * Get erShowId
     *
     * @return integer 
     */
    public function getErShowId()
    {
        return $this->erShowId;
    }

    /**
     * Set erEpisodeId
     *
     * @param integer $erEpisodeId
     * @return EpisodeRatings
     */
    public function setErEpisodeId($erEpisodeId)
    {
        $this->erEpisodeId = $erEpisodeId;

        return $this;
    }

    /**
     * Get erEpisodeId
     *
     * @return integer 
     */
    public function getErEpisodeId()
    {
        return $this->erEpisodeId;
    }

    /**
     * Set erUserId
     *
     * @param integer $erUserId
     * @return EpisodeRatings
     */
    public function setErUserId($erUserId)
    {
        $this->erUserId = $erUserId;

        return $this;
    }

    /**
     * Get erUserId
     *
     * @return integer 
     */
    public function getErUserId()
    {
        return $this->erUserId;
    }
}
