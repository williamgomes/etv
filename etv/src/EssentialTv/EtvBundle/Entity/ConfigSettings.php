<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigSettings
 */
class ConfigSettings
{
    /**
     * @var string
     */
    private $csOption;

    /**
     * @var string
     */
    private $csValue;

    /**
     * @var \DateTime
     */
    private $csUpdateDate;

    /**
     * @var string
     */
    private $csUpdatedBy;

    /**
     * @var string
     */
    private $csAutoLoad;

    /**
     * @var integer
     */
    private $csId;


    /**
     * Set csOption
     *
     * @param string $csOption
     * @return ConfigSettings
     */
    public function setCsOption($csOption)
    {
        $this->csOption = $csOption;

        return $this;
    }

    /**
     * Get csOption
     *
     * @return string 
     */
    public function getCsOption()
    {
        return $this->csOption;
    }

    /**
     * Set csValue
     *
     * @param string $csValue
     * @return ConfigSettings
     */
    public function setCsValue($csValue)
    {
        $this->csValue = $csValue;

        return $this;
    }

    /**
     * Get csValue
     *
     * @return string 
     */
    public function getCsValue()
    {
        return $this->csValue;
    }

    /**
     * Set csUpdateDate
     *
     * @param \DateTime $csUpdateDate
     * @return ConfigSettings
     */
    public function setCsUpdateDate($csUpdateDate)
    {
        $this->csUpdateDate = $csUpdateDate;

        return $this;
    }

    /**
     * Get csUpdateDate
     *
     * @return \DateTime 
     */
    public function getCsUpdateDate()
    {
        return $this->csUpdateDate;
    }

    /**
     * Set csUpdatedBy
     *
     * @param string $csUpdatedBy
     * @return ConfigSettings
     */
    public function setCsUpdatedBy($csUpdatedBy)
    {
        $this->csUpdatedBy = $csUpdatedBy;

        return $this;
    }

    /**
     * Get csUpdatedBy
     *
     * @return string 
     */
    public function getCsUpdatedBy()
    {
        return $this->csUpdatedBy;
    }

    /**
     * Set csAutoLoad
     *
     * @param string $csAutoLoad
     * @return ConfigSettings
     */
    public function setCsAutoLoad($csAutoLoad)
    {
        $this->csAutoLoad = $csAutoLoad;

        return $this;
    }

    /**
     * Get csAutoLoad
     *
     * @return string 
     */
    public function getCsAutoLoad()
    {
        return $this->csAutoLoad;
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
