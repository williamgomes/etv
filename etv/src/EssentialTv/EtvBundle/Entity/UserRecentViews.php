<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRecentViews
 */
class UserRecentViews
{
    /**
     * @var integer
     */
    private $urvUserId;

    /**
     * @var integer
     */
    private $urvElementId;

    /**
     * @var string
     */
    private $urvElementType;

    /**
     * @var \DateTime
     */
    private $urvViewedOn;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set urvUserId
     *
     * @param integer $urvUserId
     * @return UserRecentViews
     */
    public function setUrvUserId($urvUserId)
    {
        $this->urvUserId = $urvUserId;

        return $this;
    }

    /**
     * Get urvUserId
     *
     * @return integer 
     */
    public function getUrvUserId()
    {
        return $this->urvUserId;
    }

    /**
     * Set urvElementId
     *
     * @param integer $urvElementId
     * @return UserRecentViews
     */
    public function setUrvElementId($urvElementId)
    {
        $this->urvElementId = $urvElementId;

        return $this;
    }

    /**
     * Get urvElementId
     *
     * @return integer 
     */
    public function getUrvElementId()
    {
        return $this->urvElementId;
    }

    /**
     * Set urvElementType
     *
     * @param string $urvElementType
     * @return UserRecentViews
     */
    public function setUrvElementType($urvElementType)
    {
        $this->urvElementType = $urvElementType;

        return $this;
    }

    /**
     * Get urvElementType
     *
     * @return string 
     */
    public function getUrvElementType()
    {
        return $this->urvElementType;
    }

    /**
     * Set urvViewedOn
     *
     * @param \DateTime $urvViewedOn
     * @return UserRecentViews
     */
    public function setUrvViewedOn($urvViewedOn)
    {
        $this->urvViewedOn = $urvViewedOn;

        return $this;
    }

    /**
     * Get urvViewedOn
     *
     * @return \DateTime 
     */
    public function getUrvViewedOn()
    {
        return $this->urvViewedOn;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
