<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserShowResume
 *
 * @ORM\Table(name="user_show_resume", indexes={@ORM\Index(name="USR_user", columns={"USR_user_id"}), @ORM\Index(name="USR_show", columns={"USR_show_id"}), @ORM\Index(name="USR_episode", columns={"USR_episode_id"})})
 * @ORM\Entity
 */
class UserShowResume
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="USR_created_on", type="datetime", nullable=true)
     */
    private $usrCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="USR_created_by", type="integer", nullable=true)
     */
    private $usrCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="USR_updated_on", type="datetime", nullable=true)
     */
    private $usrUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="USR_updated_by", type="integer", nullable=true)
     */
    private $usrUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="USR_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usrId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="USR_user_id", referencedColumnName="user_id")
     * })
     */
    private $usrUser;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Shows
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Shows")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="USR_show_id", referencedColumnName="show_id")
     * })
     */
    private $usrShow;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Episodes
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Episodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="USR_episode_id", referencedColumnName="episode_id")
     * })
     */
    private $usrEpisode;



    /**
     * Set usrCreatedOn
     *
     * @param \DateTime $usrCreatedOn
     * @return UserShowResume
     */
    public function setUsrCreatedOn($usrCreatedOn)
    {
        $this->usrCreatedOn = $usrCreatedOn;

        return $this;
    }

    /**
     * Get usrCreatedOn
     *
     * @return \DateTime 
     */
    public function getUsrCreatedOn()
    {
        return $this->usrCreatedOn;
    }

    /**
     * Set usrCreatedBy
     *
     * @param integer $usrCreatedBy
     * @return UserShowResume
     */
    public function setUsrCreatedBy($usrCreatedBy)
    {
        $this->usrCreatedBy = $usrCreatedBy;

        return $this;
    }

    /**
     * Get usrCreatedBy
     *
     * @return integer 
     */
    public function getUsrCreatedBy()
    {
        return $this->usrCreatedBy;
    }

    /**
     * Set usrUpdatedOn
     *
     * @param \DateTime $usrUpdatedOn
     * @return UserShowResume
     */
    public function setUsrUpdatedOn($usrUpdatedOn)
    {
        $this->usrUpdatedOn = $usrUpdatedOn;

        return $this;
    }

    /**
     * Get usrUpdatedOn
     *
     * @return \DateTime 
     */
    public function getUsrUpdatedOn()
    {
        return $this->usrUpdatedOn;
    }

    /**
     * Set usrUpdatedBy
     *
     * @param integer $usrUpdatedBy
     * @return UserShowResume
     */
    public function setUsrUpdatedBy($usrUpdatedBy)
    {
        $this->usrUpdatedBy = $usrUpdatedBy;

        return $this;
    }

    /**
     * Get usrUpdatedBy
     *
     * @return integer 
     */
    public function getUsrUpdatedBy()
    {
        return $this->usrUpdatedBy;
    }

    /**
     * Get usrId
     *
     * @return integer 
     */
    public function getUsrId()
    {
        return $this->usrId;
    }

    /**
     * Set usrUser
     *
     * @param \EssentialTv\EtvBundle\Entity\Users $usrUser
     * @return UserShowResume
     */
    public function setUsrUser(\EssentialTv\EtvBundle\Entity\Users $usrUser = null)
    {
        $this->usrUser = $usrUser;

        return $this;
    }

    /**
     * Get usrUser
     *
     * @return \EssentialTv\EtvBundle\Entity\Users 
     */
    public function getUsrUser()
    {
        return $this->usrUser;
    }

    /**
     * Set usrShow
     *
     * @param \EssentialTv\EtvBundle\Entity\Shows $usrShow
     * @return UserShowResume
     */
    public function setUsrShow(\EssentialTv\EtvBundle\Entity\Shows $usrShow = null)
    {
        $this->usrShow = $usrShow;

        return $this;
    }

    /**
     * Get usrShow
     *
     * @return \EssentialTv\EtvBundle\Entity\Shows 
     */
    public function getUsrShow()
    {
        return $this->usrShow;
    }

    /**
     * Set usrEpisode
     *
     * @param \EssentialTv\EtvBundle\Entity\Episodes $usrEpisode
     * @return UserShowResume
     */
    public function setUsrEpisode(\EssentialTv\EtvBundle\Entity\Episodes $usrEpisode = null)
    {
        $this->usrEpisode = $usrEpisode;

        return $this;
    }

    /**
     * Get usrEpisode
     *
     * @return \EssentialTv\EtvBundle\Entity\Episodes 
     */
    public function getUsrEpisode()
    {
        return $this->usrEpisode;
    }
}
