<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="EssentialTv\EtvBundle\Entity\PostReactionsRepository")
 */

/**
 * Reactions
 *
 * @ORM\Table(name="reactions", indexes={@ORM\Index(name="reaction_episode_id", columns={"reaction_episode_id"}), @ORM\Index(name="reaction_user_id", columns={"reaction_user_id"}), @ORM\Index(name="reaction_parent_id", columns={"reaction_parent_id"})})
 * @ORM\Entity
 */
class PostReactions {

    /**
     * @var string
     *
     * @ORM\Column(name="reaction_text", type="text", nullable=false)
     */
    private $reactionText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reaction_created_on", type="datetime", nullable=true)
     */
    private $reactionCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="reaction_created_by", type="integer", nullable=false)
     */
    private $reactionCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reaction_updated_on", type="datetime", nullable=false)
     */
    private $reactionUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="reaction_updated_by", type="integer", nullable=false)
     */
    private $reactionUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="reaction_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reactionId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Reactions
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Reactions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reaction_parent_id", referencedColumnName="reaction_id")
     * })
     */
    private $reactionParent;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reaction_user_id", referencedColumnName="user_id")
     * })
     */
    private $reactionUser;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Episodes
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Episodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reaction_episode_id", referencedColumnName="episode_id")
     * })
     */
    private $reactionEpisode;

    /**
     * Set reactionText
     *
     * @param string $reactionText
     * @return Reactions
     */
    public function setReactionText($reactionText) {
        $this->reactionText = $reactionText;

        return $this;
    }

    /**
     * Get reactionText
     *
     * @return string 
     */
    public function getReactionText() {
        return $this->reactionText;
    }

    /**
     * Set reactionCreatedOn
     *
     * @param \DateTime $reactionCreatedOn
     * @return Reactions
     */
    public function setReactionCreatedOn($reactionCreatedOn) {
        $this->reactionCreatedOn = $reactionCreatedOn;

        return $this;
    }

    /**
     * Get reactionCreatedOn
     *
     * @return \DateTime 
     */
    public function getReactionCreatedOn() {
        return $this->reactionCreatedOn;
    }

    /**
     * Set reactionCreatedBy
     *
     * @param integer $reactionCreatedBy
     * @return Reactions
     */
    public function setReactionCreatedBy($reactionCreatedBy) {
        $this->reactionCreatedBy = $reactionCreatedBy;

        return $this;
    }

    /**
     * Get reactionCreatedBy
     *
     * @return integer 
     */
    public function getReactionCreatedBy() {
        return $this->reactionCreatedBy;
    }

    /**
     * Set reactionUpdatedOn
     *
     * @param \DateTime $reactionUpdatedOn
     * @return Reactions
     */
    public function setReactionUpdatedOn($reactionUpdatedOn) {
        $this->reactionUpdatedOn = $reactionUpdatedOn;

        return $this;
    }

    /**
     * Get reactionUpdatedOn
     *
     * @return \DateTime 
     */
    public function getReactionUpdatedOn() {
        return $this->reactionUpdatedOn;
    }

    /**
     * Set reactionUpdatedBy
     *
     * @param integer $reactionUpdatedBy
     * @return Reactions
     */
    public function setReactionUpdatedBy($reactionUpdatedBy) {
        $this->reactionUpdatedBy = $reactionUpdatedBy;

        return $this;
    }

    /**
     * Get reactionUpdatedBy
     *
     * @return integer 
     */
    public function getReactionUpdatedBy() {
        return $this->reactionUpdatedBy;
    }

    /**
     * Get reactionId
     *
     * @return integer 
     */
    public function getReactionId() {
        return $this->reactionId;
    }

    /**
     * Set reactionParent
     *
     * @param \EssentialTv\EtvBundle\Entity\Reactions $reactionParent
     * @return Reactions
     */
    public function setReactionParent(\EssentialTv\EtvBundle\Entity\Reactions $reactionParent = null) {
        $this->reactionParent = $reactionParent;

        return $this;
    }

    /**
     * Get reactionParent
     *
     * @return \EssentialTv\EtvBundle\Entity\Reactions 
     */
    public function getReactionParent() {
        return $this->reactionParent;
    }

    /**
     * Set reactionUser
     *
     * @param \EssentialTv\EtvBundle\Entity\Users $reactionUser
     * @return Reactions
     */
    public function setReactionUser(\EssentialTv\EtvBundle\Entity\Users $reactionUser = null) {
        $this->reactionUser = $reactionUser;

        return $this;
    }

    /**
     * Get reactionUser
     *
     * @return \EssentialTv\EtvBundle\Entity\Users 
     */
    public function getReactionUser() {
        return $this->reactionUser;
    }

    /**
     * Set reactionEpisode
     *
     * @param \EssentialTv\EtvBundle\Entity\Episodes $reactionEpisode
     * @return Reactions
     */
    public function setReactionEpisode(\EssentialTv\EtvBundle\Entity\Episodes $reactionEpisode = null) {
        $this->reactionEpisode = $reactionEpisode;

        return $this;
    }

    /**
     * Get reactionEpisode
     *
     * @return \EssentialTv\EtvBundle\Entity\Episodes 
     */
    public function getReactionEpisode() {
        return $this->reactionEpisode;
    }

    /**
     * @var integer
     */
    private $reactionPostId;

    /**
     * @var integer
     */
    private $reactionUserId;

    /**
     * @var integer
     */
    private $reactionParentId;


    /**
     * Set reactionPostId
     *
     * @param integer $reactionPostId
     * @return Reactions
     */
    public function setReactionPostId($reactionPostId)
    {
        $this->reactionPostId = $reactionPostId;

        return $this;
    }

    /**
     * Get reactionPostId
     *
     * @return integer 
     */
    public function getReactionPostId()
    {
        return $this->reactionPostId;
    }

    /**
     * Set reactionUserId
     *
     * @param integer $reactionUserId
     * @return Reactions
     */
    public function setReactionUserId($reactionUserId)
    {
        $this->reactionUserId = $reactionUserId;

        return $this;
    }

    /**
     * Get reactionUserId
     *
     * @return integer 
     */
    public function getReactionUserId()
    {
        return $this->reactionUserId;
    }

    /**
     * Set reactionParentId
     *
     * @param integer $reactionParentId
     * @return Reactions
     */
    public function setReactionParentId($reactionParentId)
    {
        $this->reactionParentId = $reactionParentId;

        return $this;
    }

    /**
     * Get reactionParentId
     *
     * @return integer 
     */
    public function getReactionParentId()
    {
        return $this->reactionParentId;
    }
}
