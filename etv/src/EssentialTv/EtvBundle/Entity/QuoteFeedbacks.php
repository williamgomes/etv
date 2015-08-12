<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuoteFeedbacks
 *
 * @ORM\Table(name="quote_feedbacks", indexes={@ORM\Index(name="quote_feedback_user_id", columns={"quote_feedback_user_id"}), @ORM\Index(name="quote_feedback_spoiler_id", columns={"quote_feedback_spoiler_id"})})
 * @ORM\Entity
 */
class QuoteFeedbacks
{
    /**
     * @var string
     *
     * @ORM\Column(name="quote_feedback_feedback", type="string", nullable=false)
     */
    private $quoteFeedbackFeedback;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="quote_feedback_created_on", type="datetime", nullable=false)
     */
    private $quoteFeedbackCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="quote_feedback_created_by", type="integer", nullable=false)
     */
    private $quoteFeedbackCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="quote_feedback_updated_on", type="datetime", nullable=false)
     */
    private $quoteFeedbackUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="quote_feedback_updated_by", type="integer", nullable=false)
     */
    private $quoteFeedbackUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="quote_feedback_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $quoteFeedbackId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Spoilers
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Spoilers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quote_feedback_spoiler_id", referencedColumnName="spoiler_id")
     * })
     */
    private $quoteFeedbackSpoiler;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quote_feedback_user_id", referencedColumnName="user_id")
     * })
     */
    private $quoteFeedbackUser;



    /**
     * Set quoteFeedbackFeedback
     *
     * @param string $quoteFeedbackFeedback
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackFeedback($quoteFeedbackFeedback)
    {
        $this->quoteFeedbackFeedback = $quoteFeedbackFeedback;

        return $this;
    }

    /**
     * Get quoteFeedbackFeedback
     *
     * @return string 
     */
    public function getQuoteFeedbackFeedback()
    {
        return $this->quoteFeedbackFeedback;
    }

    /**
     * Set quoteFeedbackCreatedOn
     *
     * @param \DateTime $quoteFeedbackCreatedOn
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackCreatedOn($quoteFeedbackCreatedOn)
    {
        $this->quoteFeedbackCreatedOn = $quoteFeedbackCreatedOn;

        return $this;
    }

    /**
     * Get quoteFeedbackCreatedOn
     *
     * @return \DateTime 
     */
    public function getQuoteFeedbackCreatedOn()
    {
        return $this->quoteFeedbackCreatedOn;
    }

    /**
     * Set quoteFeedbackCreatedBy
     *
     * @param integer $quoteFeedbackCreatedBy
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackCreatedBy($quoteFeedbackCreatedBy)
    {
        $this->quoteFeedbackCreatedBy = $quoteFeedbackCreatedBy;

        return $this;
    }

    /**
     * Get quoteFeedbackCreatedBy
     *
     * @return integer 
     */
    public function getQuoteFeedbackCreatedBy()
    {
        return $this->quoteFeedbackCreatedBy;
    }

    /**
     * Set quoteFeedbackUpdatedOn
     *
     * @param \DateTime $quoteFeedbackUpdatedOn
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackUpdatedOn($quoteFeedbackUpdatedOn)
    {
        $this->quoteFeedbackUpdatedOn = $quoteFeedbackUpdatedOn;

        return $this;
    }

    /**
     * Get quoteFeedbackUpdatedOn
     *
     * @return \DateTime 
     */
    public function getQuoteFeedbackUpdatedOn()
    {
        return $this->quoteFeedbackUpdatedOn;
    }

    /**
     * Set quoteFeedbackUpdatedBy
     *
     * @param integer $quoteFeedbackUpdatedBy
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackUpdatedBy($quoteFeedbackUpdatedBy)
    {
        $this->quoteFeedbackUpdatedBy = $quoteFeedbackUpdatedBy;

        return $this;
    }

    /**
     * Get quoteFeedbackUpdatedBy
     *
     * @return integer 
     */
    public function getQuoteFeedbackUpdatedBy()
    {
        return $this->quoteFeedbackUpdatedBy;
    }

    /**
     * Get quoteFeedbackId
     *
     * @return integer 
     */
    public function getQuoteFeedbackId()
    {
        return $this->quoteFeedbackId;
    }

    /**
     * Set quoteFeedbackSpoiler
     *
     * @param \EssentialTv\EtvBundle\Entity\Spoilers $quoteFeedbackSpoiler
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackSpoiler(\EssentialTv\EtvBundle\Entity\Spoilers $quoteFeedbackSpoiler = null)
    {
        $this->quoteFeedbackSpoiler = $quoteFeedbackSpoiler;

        return $this;
    }

    /**
     * Get quoteFeedbackSpoiler
     *
     * @return \EssentialTv\EtvBundle\Entity\Spoilers 
     */
    public function getQuoteFeedbackSpoiler()
    {
        return $this->quoteFeedbackSpoiler;
    }

    /**
     * Set quoteFeedbackUser
     *
     * @param \EssentialTv\EtvBundle\Entity\Users $quoteFeedbackUser
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackUser(\EssentialTv\EtvBundle\Entity\Users $quoteFeedbackUser = null)
    {
        $this->quoteFeedbackUser = $quoteFeedbackUser;

        return $this;
    }

    /**
     * Get quoteFeedbackUser
     *
     * @return \EssentialTv\EtvBundle\Entity\Users 
     */
    public function getQuoteFeedbackUser()
    {
        return $this->quoteFeedbackUser;
    }
    /**
     * @var integer
     */
    private $quoteFeedbackUserId;

    /**
     * @var integer
     */
    private $quoteFeedbackSpoilerId;


    /**
     * Set quoteFeedbackUserId
     *
     * @param integer $quoteFeedbackUserId
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackUserId($quoteFeedbackUserId)
    {
        $this->quoteFeedbackUserId = $quoteFeedbackUserId;

        return $this;
    }

    /**
     * Get quoteFeedbackUserId
     *
     * @return integer 
     */
    public function getQuoteFeedbackUserId()
    {
        return $this->quoteFeedbackUserId;
    }

    /**
     * Set quoteFeedbackSpoilerId
     *
     * @param integer $quoteFeedbackSpoilerId
     * @return QuoteFeedbacks
     */
    public function setQuoteFeedbackSpoilerId($quoteFeedbackSpoilerId)
    {
        $this->quoteFeedbackSpoilerId = $quoteFeedbackSpoilerId;

        return $this;
    }

    /**
     * Get quoteFeedbackSpoilerId
     *
     * @return integer 
     */
    public function getQuoteFeedbackSpoilerId()
    {
        return $this->quoteFeedbackSpoilerId;
    }
}
