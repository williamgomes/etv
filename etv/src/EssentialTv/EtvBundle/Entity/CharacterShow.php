<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharacterShow
 */
class CharacterShow
{
    /**
     * @var integer
     */
    private $csCharacterId;

    /**
     * @var integer
     */
    private $csShowId;

    /**
     * @var \DateTime
     */
    private $csCreatedOn;

    /**
     * @var integer
     */
    private $csCreatedBy;

    /**
     * @var \DateTime
     */
    private $csUpdatedOn;

    /**
     * @var integer
     */
    private $csUpdatedBy;

    /**
     * @var integer
     */
    private $csId;


    /**
     * Set csCharacterId
     *
     * @param integer $csCharacterId
     * @return CharacterShow
     */
    public function setCsCharacterId($csCharacterId)
    {
        $this->csCharacterId = $csCharacterId;

        return $this;
    }

    /**
     * Get csCharacterId
     *
     * @return integer 
     */
    public function getCsCharacterId()
    {
        return $this->csCharacterId;
    }

    /**
     * Set csShowId
     *
     * @param integer $csShowId
     * @return CharacterShow
     */
    public function setCsShowId($csShowId)
    {
        $this->csShowId = $csShowId;

        return $this;
    }

    /**
     * Get csShowId
     *
     * @return integer 
     */
    public function getCsShowId()
    {
        return $this->csShowId;
    }

    /**
     * Set csCreatedOn
     *
     * @param \DateTime $csCreatedOn
     * @return CharacterShow
     */
    public function setCsCreatedOn($csCreatedOn)
    {
        $this->csCreatedOn = $csCreatedOn;

        return $this;
    }

    /**
     * Get csCreatedOn
     *
     * @return \DateTime 
     */
    public function getCsCreatedOn()
    {
        return $this->csCreatedOn;
    }

    /**
     * Set csCreatedBy
     *
     * @param integer $csCreatedBy
     * @return CharacterShow
     */
    public function setCsCreatedBy($csCreatedBy)
    {
        $this->csCreatedBy = $csCreatedBy;

        return $this;
    }

    /**
     * Get csCreatedBy
     *
     * @return integer 
     */
    public function getCsCreatedBy()
    {
        return $this->csCreatedBy;
    }

    /**
     * Set csUpdatedOn
     *
     * @param \DateTime $csUpdatedOn
     * @return CharacterShow
     */
    public function setCsUpdatedOn($csUpdatedOn)
    {
        $this->csUpdatedOn = $csUpdatedOn;

        return $this;
    }

    /**
     * Get csUpdatedOn
     *
     * @return \DateTime 
     */
    public function getCsUpdatedOn()
    {
        return $this->csUpdatedOn;
    }

    /**
     * Set csUpdatedBy
     *
     * @param integer $csUpdatedBy
     * @return CharacterShow
     */
    public function setCsUpdatedBy($csUpdatedBy)
    {
        $this->csUpdatedBy = $csUpdatedBy;

        return $this;
    }

    /**
     * Get csUpdatedBy
     *
     * @return integer 
     */
    public function getCsUpdatedBy()
    {
        return $this->csUpdatedBy;
    }

    /**
     * Get csId
     *
     * @return integer 
     */
    public function getCsId()
    {
        return $this->csId;
    }
}
