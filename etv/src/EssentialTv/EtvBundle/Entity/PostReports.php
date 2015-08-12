<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostReports
 */
class PostReports
{
    /**
     * @var integer
     */
    private $prPostId;

    /**
     * @var string
     */
    private $prType;

    /**
     * @var string
     */
    private $prDetails;

    /**
     * @var integer
     */
    private $prReportedBy;

    /**
     * @var \DateTime
     */
    private $prReportedOn;

    /**
     * @var integer
     */
    private $prId;


    /**
     * Set prPostId
     *
     * @param integer $prPostId
     * @return PostReports
     */
    public function setPrPostId($prPostId)
    {
        $this->prPostId = $prPostId;

        return $this;
    }

    /**
     * Get prPostId
     *
     * @return integer 
     */
    public function getPrPostId()
    {
        return $this->prPostId;
    }

    /**
     * Set prType
     *
     * @param string $prType
     * @return PostReports
     */
    public function setPrType($prType)
    {
        $this->prType = $prType;

        return $this;
    }

    /**
     * Get prType
     *
     * @return string 
     */
    public function getPrType()
    {
        return $this->prType;
    }

    /**
     * Set prDetails
     *
     * @param string $prDetails
     * @return PostReports
     */
    public function setPrDetails($prDetails)
    {
        $this->prDetails = $prDetails;

        return $this;
    }

    /**
     * Get prDetails
     *
     * @return string 
     */
    public function getPrDetails()
    {
        return $this->prDetails;
    }

    /**
     * Set prReportedBy
     *
     * @param integer $prReportedBy
     * @return PostReports
     */
    public function setPrReportedBy($prReportedBy)
    {
        $this->prReportedBy = $prReportedBy;

        return $this;
    }

    /**
     * Get prReportedBy
     *
     * @return integer 
     */
    public function getPrReportedBy()
    {
        return $this->prReportedBy;
    }

    /**
     * Set prReportedOn
     *
     * @param \DateTime $prReportedOn
     * @return PostReports
     */
    public function setPrReportedOn($prReportedOn)
    {
        $this->prReportedOn = $prReportedOn;

        return $this;
    }

    /**
     * Get prReportedOn
     *
     * @return \DateTime 
     */
    public function getPrReportedOn()
    {
        return $this->prReportedOn;
    }

    /**
     * Get prId
     *
     * @return integer 
     */
    public function getPrId()
    {
        return $this->prId;
    }
}
