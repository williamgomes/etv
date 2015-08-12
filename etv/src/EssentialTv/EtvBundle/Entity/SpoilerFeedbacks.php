<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpoilerFeedbacks
 *
 * @ORM\Table(name="spoiler_feedbacks", indexes={@ORM\Index(name="spoiler_feedback_user_id", columns={"spoiler_feedback_user_id"}), @ORM\Index(name="spoiler_feedback_spoiler_id", columns={"spoiler_feedback_spoiler_id"})})
 * @ORM\Entity
 */
class SpoilerFeedbacks
{
    /**
     * @var string
     *
     * @ORM\Column(name="spoiler_feedback_feedback", type="string", nullable=false)
     */
    private $spoilerFeedbackFeedback;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spoiler_feedback_created_on", type="datetime", nullable=false)
     */
    private $spoilerFeedbackCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="spoiler_feedback_created_by", type="integer", nullable=false)
     */
    private $spoilerFeedbackCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spoiler_feedback_updated_on", type="datetime", nullable=false)
     */
    private $spoilerFeedbackUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="spoiler_feedback_updated_by", type="integer", nullable=false)
     */
    private $spoilerFeedbackUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="spoiler_feedback_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $spoilerFeedbackId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Spoilers
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Spoilers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="spoiler_feedback_spoiler_id", referencedColumnName="spoiler_id")
     * })
     */
    private $spoilerFeedbackSpoiler;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="spoiler_feedback_user_id", referencedColumnName="user_id")
     * })
     */
    private $spoilerFeedbackUser;



    /**
     * Set spoilerFeedbackFeedback
     *
     * @param string $spoilerFeedbackFeedback
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackFeedback($spoilerFeedbackFeedback)
    {
        $this->spoilerFeedbackFeedback = $spoilerFeedbackFeedback;

        return $this;
    }

    /**
     * Get spoilerFeedbackFeedback
     *
     * @return string 
     */
    public function getSpoilerFeedbackFeedback()
    {
        return $this->spoilerFeedbackFeedback;
    }

    /**
     * Set spoilerFeedbackCreatedOn
     *
     * @param \DateTime $spoilerFeedbackCreatedOn
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackCreatedOn($spoilerFeedbackCreatedOn)
    {
        $this->spoilerFeedbackCreatedOn = $spoilerFeedbackCreatedOn;

        return $this;
    }

    /**
     * Get spoilerFeedbackCreatedOn
     *
     * @return \DateTime 
     */
    public function getSpoilerFeedbackCreatedOn()
    {
        return $this->spoilerFeedbackCreatedOn;
    }

    /**
     * Set spoilerFeedbackCreatedBy
     *
     * @param integer $spoilerFeedbackCreatedBy
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackCreatedBy($spoilerFeedbackCreatedBy)
    {
        $this->spoilerFeedbackCreatedBy = $spoilerFeedbackCreatedBy;

        return $this;
    }

    /**
     * Get spoilerFeedbackCreatedBy
     *
     * @return integer 
     */
    public function getSpoilerFeedbackCreatedBy()
    {
        return $this->spoilerFeedbackCreatedBy;
    }

    /**
     * Set spoilerFeedbackUpdatedOn
     *
     * @param \DateTime $spoilerFeedbackUpdatedOn
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackUpdatedOn($spoilerFeedbackUpdatedOn)
    {
        $this->spoilerFeedbackUpdatedOn = $spoilerFeedbackUpdatedOn;

        return $this;
    }

    /**
     * Get spoilerFeedbackUpdatedOn
     *
     * @return \DateTime 
     */
    public function getSpoilerFeedbackUpdatedOn()
    {
        return $this->spoilerFeedbackUpdatedOn;
    }

    /**
     * Set spoilerFeedbackUpdatedBy
     *
     * @param integer $spoilerFeedbackUpdatedBy
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackUpdatedBy($spoilerFeedbackUpdatedBy)
    {
        $this->spoilerFeedbackUpdatedBy = $spoilerFeedbackUpdatedBy;

        return $this;
    }

    /**
     * Get spoilerFeedbackUpdatedBy
     *
     * @return integer 
     */
    public function getSpoilerFeedbackUpdatedBy()
    {
        return $this->spoilerFeedbackUpdatedBy;
    }

    /**
     * Get spoilerFeedbackId
     *
     * @return integer 
     */
    public function getSpoilerFeedbackId()
    {
        return $this->spoilerFeedbackId;
    }

    /**
     * Set spoilerFeedbackSpoiler
     *
     * @param \EssentialTv\EtvBundle\Entity\Spoilers $spoilerFeedbackSpoiler
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackSpoiler(\EssentialTv\EtvBundle\Entity\Spoilers $spoilerFeedbackSpoiler = null)
    {
        $this->spoilerFeedbackSpoiler = $spoilerFeedbackSpoiler;

        return $this;
    }

    /**
     * Get spoilerFeedbackSpoiler
     *
     * @return \EssentialTv\EtvBundle\Entity\Spoilers 
     */
    public function getSpoilerFeedbackSpoiler()
    {
        return $this->spoilerFeedbackSpoiler;
    }

    /**
     * Set spoilerFeedbackUser
     *
     * @param \EssentialTv\EtvBundle\Entity\Users $spoilerFeedbackUser
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackUser(\EssentialTv\EtvBundle\Entity\Users $spoilerFeedbackUser = null)
    {
        $this->spoilerFeedbackUser = $spoilerFeedbackUser;

        return $this;
    }

    /**
     * Get spoilerFeedbackUser
     *
     * @return \EssentialTv\EtvBundle\Entity\Users 
     */
    public function getSpoilerFeedbackUser()
    {
        return $this->spoilerFeedbackUser;
    }
    /**
     * @var integer
     */
    private $spoilerFeedbackUserId;

    /**
     * @var integer
     */
    private $spoilerFeedbackSpoilerId;


    /**
     * Set spoilerFeedbackUserId
     *
     * @param integer $spoilerFeedbackUserId
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackUserId($spoilerFeedbackUserId)
    {
        $this->spoilerFeedbackUserId = $spoilerFeedbackUserId;

        return $this;
    }

    /**
     * Get spoilerFeedbackUserId
     *
     * @return integer 
     */
    public function getSpoilerFeedbackUserId()
    {
        return $this->spoilerFeedbackUserId;
    }

    /**
     * Set spoilerFeedbackSpoilerId
     *
     * @param integer $spoilerFeedbackSpoilerId
     * @return SpoilerFeedbacks
     */
    public function setSpoilerFeedbackSpoilerId($spoilerFeedbackSpoilerId)
    {
        $this->spoilerFeedbackSpoilerId = $spoilerFeedbackSpoilerId;

        return $this;
    }

    /**
     * Get spoilerFeedbackSpoilerId
     *
     * @return integer 
     */
    public function getSpoilerFeedbackSpoilerId()
    {
        return $this->spoilerFeedbackSpoilerId;
    }
}
