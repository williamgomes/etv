<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seasons
 *
 * @ORM\Table(name="seasons", indexes={@ORM\Index(name="season_show_id", columns={"season_show_id"})})
 * @ORM\Entity
 */
class Seasons
{
    /**
     * @var string
     *
     * @ORM\Column(name="season_tms_id", type="string", length=255, nullable=false)
     */
    private $seasonTmsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="season_api_id", type="integer", nullable=false)
     */
    private $seasonApiId;

    /**
     * @var integer
     *
     * @ORM\Column(name="season_episode_total", type="integer", nullable=false)
     */
    private $seasonEpisodeTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="season_title", type="text", nullable=false)
     */
    private $seasonTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="season_original_summary", type="text", nullable=false)
     */
    private $seasonOriginalSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="season_api_summary", type="text", nullable=false)
     */
    private $seasonApiSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="season_original_images", type="text", nullable=false)
     */
    public $seasonOriginalImages;

    /**
     * @var string
     *
     * @ORM\Column(name="season_api_images", type="text", nullable=false)
     */
    private $seasonApiImages;

    /**
     * @var string
     *
     * @ORM\Column(name="season_banner_image", type="text", nullable=false)
     */
    private $seasonBannerImage;

    /**
     * @var string
     *
     * @ORM\Column(name="season_status", type="string", nullable=false)
     */
    private $seasonStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="season_original_data_supersede", type="string", nullable=false)
     */
    private $seasonOriginalDataSupersede;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season_created_on", type="datetime", nullable=false)
     */
    private $seasonCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="season_created_by", type="integer", nullable=false)
     */
    private $seasonCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season_updated_on", type="datetime", nullable=false)
     */
    private $seasonUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="season_updated_by", type="integer", nullable=false)
     */
    private $seasonUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="season_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $seasonId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Shows
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Shows")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="season_show_id", referencedColumnName="show_id")
     * })
     */
    private $seasonShow;



    /**
     * Set seasonTmsId
     *
     * @param string $seasonTmsId
     * @return Seasons
     */
    public function setSeasonTmsId($seasonTmsId)
    {
        $this->seasonTmsId = $seasonTmsId;

        return $this;
    }

    /**
     * Get seasonTmsId
     *
     * @return string 
     */
    public function getSeasonTmsId()
    {
        return $this->seasonTmsId;
    }

    /**
     * Set seasonApiId
     *
     * @param integer $seasonApiId
     * @return Seasons
     */
    public function setSeasonApiId($seasonApiId)
    {
        $this->seasonApiId = $seasonApiId;

        return $this;
    }

    /**
     * Get seasonApiId
     *
     * @return integer 
     */
    public function getSeasonApiId()
    {
        return $this->seasonApiId;
    }

    /**
     * Set seasonEpisodeTotal
     *
     * @param integer $seasonEpisodeTotal
     * @return Seasons
     */
    public function setSeasonEpisodeTotal($seasonEpisodeTotal)
    {
        $this->seasonEpisodeTotal = $seasonEpisodeTotal;

        return $this;
    }

    /**
     * Get seasonEpisodeTotal
     *
     * @return integer 
     */
    public function getSeasonEpisodeTotal()
    {
        return $this->seasonEpisodeTotal;
    }

    /**
     * Set seasonTitle
     *
     * @param string $seasonTitle
     * @return Seasons
     */
    public function setSeasonTitle($seasonTitle)
    {
        $this->seasonTitle = $seasonTitle;

        return $this;
    }

    /**
     * Get seasonTitle
     *
     * @return string 
     */
    public function getSeasonTitle()
    {
        return $this->seasonTitle;
    }

    /**
     * Set seasonOriginalSummary
     *
     * @param string $seasonOriginalSummary
     * @return Seasons
     */
    public function setSeasonOriginalSummary($seasonOriginalSummary)
    {
        $this->seasonOriginalSummary = $seasonOriginalSummary;

        return $this;
    }

    /**
     * Get seasonOriginalSummary
     *
     * @return string 
     */
    public function getSeasonOriginalSummary()
    {
        return $this->seasonOriginalSummary;
    }

    /**
     * Set seasonApiSummary
     *
     * @param string $seasonApiSummary
     * @return Seasons
     */
    public function setSeasonApiSummary($seasonApiSummary)
    {
        $this->seasonApiSummary = $seasonApiSummary;

        return $this;
    }

    /**
     * Get seasonApiSummary
     *
     * @return string 
     */
    public function getSeasonApiSummary()
    {
        return $this->seasonApiSummary;
    }

    /**
     * Set seasonOriginalImages
     *
     * @param string $seasonOriginalImages
     * @return Seasons
     */
    public function setSeasonOriginalImages($seasonOriginalImages)
    {
        $this->seasonOriginalImages = $seasonOriginalImages;

        return $this;
    }

    /**
     * Get seasonOriginalImages
     *
     * @return string 
     */
    public function getSeasonOriginalImages()
    {
        return $this->seasonOriginalImages;
    }

    /**
     * Set seasonApiImages
     *
     * @param string $seasonApiImages
     * @return Seasons
     */
    public function setSeasonApiImages($seasonApiImages)
    {
        $this->seasonApiImages = $seasonApiImages;

        return $this;
    }

    /**
     * Get seasonApiImages
     *
     * @return string 
     */
    public function getSeasonApiImages()
    {
        return $this->seasonApiImages;
    }

    /**
     * Set seasonBannerImage
     *
     * @param string $seasonBannerImage
     * @return Seasons
     */
    public function setSeasonBannerImage($seasonBannerImage)
    {
        $this->seasonBannerImage = $seasonBannerImage;

        return $this;
    }

    /**
     * Get seasonBannerImage
     *
     * @return string 
     */
    public function getSeasonBannerImage()
    {
        return $this->seasonBannerImage;
    }

    /**
     * Set seasonStatus
     *
     * @param string $seasonStatus
     * @return Seasons
     */
    public function setSeasonStatus($seasonStatus)
    {
        $this->seasonStatus = $seasonStatus;

        return $this;
    }

    /**
     * Get seasonStatus
     *
     * @return string 
     */
    public function getSeasonStatus()
    {
        return $this->seasonStatus;
    }

    /**
     * Set seasonOriginalDataSupersede
     *
     * @param string $seasonOriginalDataSupersede
     * @return Seasons
     */
    public function setSeasonOriginalDataSupersede($seasonOriginalDataSupersede)
    {
        $this->seasonOriginalDataSupersede = $seasonOriginalDataSupersede;

        return $this;
    }

    /**
     * Get seasonOriginalDataSupersede
     *
     * @return string 
     */
    public function getSeasonOriginalDataSupersede()
    {
        return $this->seasonOriginalDataSupersede;
    }

    /**
     * Set seasonCreatedOn
     *
     * @param \DateTime $seasonCreatedOn
     * @return Seasons
     */
    public function setSeasonCreatedOn($seasonCreatedOn)
    {
        $this->seasonCreatedOn = $seasonCreatedOn;

        return $this;
    }

    /**
     * Get seasonCreatedOn
     *
     * @return \DateTime 
     */
    public function getSeasonCreatedOn()
    {
        return $this->seasonCreatedOn;
    }

    /**
     * Set seasonCreatedBy
     *
     * @param integer $seasonCreatedBy
     * @return Seasons
     */
    public function setSeasonCreatedBy($seasonCreatedBy)
    {
        $this->seasonCreatedBy = $seasonCreatedBy;

        return $this;
    }

    /**
     * Get seasonCreatedBy
     *
     * @return integer 
     */
    public function getSeasonCreatedBy()
    {
        return $this->seasonCreatedBy;
    }

    /**
     * Set seasonUpdatedOn
     *
     * @param \DateTime $seasonUpdatedOn
     * @return Seasons
     */
    public function setSeasonUpdatedOn($seasonUpdatedOn)
    {
        $this->seasonUpdatedOn = $seasonUpdatedOn;

        return $this;
    }

    /**
     * Get seasonUpdatedOn
     *
     * @return \DateTime 
     */
    public function getSeasonUpdatedOn()
    {
        return $this->seasonUpdatedOn;
    }

    /**
     * Set seasonUpdatedBy
     *
     * @param integer $seasonUpdatedBy
     * @return Seasons
     */
    public function setSeasonUpdatedBy($seasonUpdatedBy)
    {
        $this->seasonUpdatedBy = $seasonUpdatedBy;

        return $this;
    }

    /**
     * Get seasonUpdatedBy
     *
     * @return integer 
     */
    public function getSeasonUpdatedBy()
    {
        return $this->seasonUpdatedBy;
    }

    /**
     * Get seasonId
     *
     * @return integer 
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * Set seasonShow
     *
     * @param \EssentialTv\EtvBundle\Entity\Shows $seasonShow
     * @return Seasons
     */
    public function setSeasonShow(\EssentialTv\EtvBundle\Entity\Shows $seasonShow = null)
    {
        $this->seasonShow = $seasonShow;

        return $this;
    }

    /**
     * Get seasonShow
     *
     * @return \EssentialTv\EtvBundle\Entity\Shows 
     */
    public function getSeasonShow()
    {
        return $this->seasonShow;
    }
    /**
     * @var integer
     */
    private $seasonShowId;


    /**
     * Set seasonShowId
     *
     * @param integer $seasonShowId
     * @return Seasons
     */
    public function setSeasonShowId($seasonShowId)
    {
        $this->seasonShowId = $seasonShowId;

        return $this;
    }

    /**
     * Get seasonShowId
     *
     * @return integer 
     */
    public function getSeasonShowId()
    {
        return $this->seasonShowId;
    }
}
