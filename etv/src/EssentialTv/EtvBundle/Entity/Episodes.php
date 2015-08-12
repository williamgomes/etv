<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Episodes
 *
 * @ORM\Table(name="episodes", indexes={@ORM\Index(name="episode_show_id", columns={"episode_show_id"}), @ORM\Index(name="episode_season_id", columns={"episode_season_id"})})
 * @ORM\Entity
 */
class Episodes
{
    /**
     * @var string
     *
     * @ORM\Column(name="episode_tms_id", type="string", length=255, nullable=false)
     */
    private $episodeTmsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode_api_id", type="integer", nullable=false)
     */
    private $episodeApiId;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode_number", type="integer", nullable=true)
     */
    private $episodeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_title", type="string", length=255, nullable=false)
     */
    private $episodeTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_original_summary", type="text", nullable=true)
     */
    private $episodeOriginalSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_api_summary", type="text", nullable=false)
     */
    private $episodeApiSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_original_images", type="text", nullable=false)
     */
    private $episodeOriginalImages;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_api_images", type="text", nullable=false)
     */
    private $episodeApiImages;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_banner_image", type="text", nullable=false)
     */
    private $episodeBannerImage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="episode_screening_date", type="datetime", nullable=true)
     */
    private $episodeScreeningDate;

    /**
     * @var string
     *
     * @ORM\Column(name="original_data_supersede", type="string", nullable=false)
     */
    private $originalDataSupersede;

    /**
     * @var float
     *
     * @ORM\Column(name="episode_essential_count_total", type="float", precision=10, scale=0, nullable=true)
     */
    private $episodeEssentialCountTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="episode_not_essential_count_total", type="float", precision=10, scale=0, nullable=true)
     */
    private $episodeNotEssentialCountTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="episode_status", type="string", nullable=false)
     */
    private $episodeStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode_create_by", type="integer", nullable=true)
     */
    private $episodeCreateBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="episode_created_on", type="datetime", nullable=true)
     */
    private $episodeCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode_updated_by", type="integer", nullable=true)
     */
    private $episodeUpdatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="episode_updated_on", type="datetime", nullable=true)
     */
    private $episodeUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $episodeId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Seasons
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Seasons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="episode_season_id", referencedColumnName="season_id")
     * })
     */
    private $episodeSeason;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Shows
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Shows")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="episode_show_id", referencedColumnName="show_id")
     * })
     */
    private $episodeShow;



    /**
     * Set episodeTmsId
     *
     * @param string $episodeTmsId
     * @return Episodes
     */
    public function setEpisodeTmsId($episodeTmsId)
    {
        $this->episodeTmsId = $episodeTmsId;

        return $this;
    }

    /**
     * Get episodeTmsId
     *
     * @return string 
     */
    public function getEpisodeTmsId()
    {
        return $this->episodeTmsId;
    }

    /**
     * Set episodeApiId
     *
     * @param integer $episodeApiId
     * @return Episodes
     */
    public function setEpisodeApiId($episodeApiId)
    {
        $this->episodeApiId = $episodeApiId;

        return $this;
    }

    /**
     * Get episodeApiId
     *
     * @return integer 
     */
    public function getEpisodeApiId()
    {
        return $this->episodeApiId;
    }

    /**
     * Set episodeNumber
     *
     * @param integer $episodeNumber
     * @return Episodes
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = $episodeNumber;

        return $this;
    }

    /**
     * Get episodeNumber
     *
     * @return integer 
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * Set episodeTitle
     *
     * @param string $episodeTitle
     * @return Episodes
     */
    public function setEpisodeTitle($episodeTitle)
    {
        $this->episodeTitle = $episodeTitle;

        return $this;
    }

    /**
     * Get episodeTitle
     *
     * @return string 
     */
    public function getEpisodeTitle()
    {
        return $this->episodeTitle;
    }

    /**
     * Set episodeOriginalSummary
     *
     * @param string $episodeOriginalSummary
     * @return Episodes
     */
    public function setEpisodeOriginalSummary($episodeOriginalSummary)
    {
        $this->episodeOriginalSummary = $episodeOriginalSummary;

        return $this;
    }

    /**
     * Get episodeOriginalSummary
     *
     * @return string 
     */
    public function getEpisodeOriginalSummary()
    {
        return $this->episodeOriginalSummary;
    }

    /**
     * Set episodeApiSummary
     *
     * @param string $episodeApiSummary
     * @return Episodes
     */
    public function setEpisodeApiSummary($episodeApiSummary)
    {
        $this->episodeApiSummary = $episodeApiSummary;

        return $this;
    }

    /**
     * Get episodeApiSummary
     *
     * @return string 
     */
    public function getEpisodeApiSummary()
    {
        return $this->episodeApiSummary;
    }

    /**
     * Set episodeOriginalImages
     *
     * @param string $episodeOriginalImages
     * @return Episodes
     */
    public function setEpisodeOriginalImages($episodeOriginalImages)
    {
        $this->episodeOriginalImages = $episodeOriginalImages;

        return $this;
    }

    /**
     * Get episodeOriginalImages
     *
     * @return string 
     */
    public function getEpisodeOriginalImages()
    {
        return $this->episodeOriginalImages;
    }

    /**
     * Set episodeApiImages
     *
     * @param string $episodeApiImages
     * @return Episodes
     */
    public function setEpisodeApiImages($episodeApiImages)
    {
        $this->episodeApiImages = $episodeApiImages;

        return $this;
    }

    /**
     * Get episodeApiImages
     *
     * @return string 
     */
    public function getEpisodeApiImages()
    {
        return $this->episodeApiImages;
    }

    /**
     * Set episodeBannerImage
     *
     * @param string $episodeBannerImage
     * @return Episodes
     */
    public function setEpisodeBannerImage($episodeBannerImage)
    {
        $this->episodeBannerImage = $episodeBannerImage;

        return $this;
    }

    /**
     * Get episodeBannerImage
     *
     * @return string 
     */
    public function getEpisodeBannerImage()
    {
        return $this->episodeBannerImage;
    }

    /**
     * Set episodeScreeningDate
     *
     * @param \DateTime $episodeScreeningDate
     * @return Episodes
     */
    public function setEpisodeScreeningDate($episodeScreeningDate)
    {
        $this->episodeScreeningDate = $episodeScreeningDate;

        return $this;
    }

    /**
     * Get episodeScreeningDate
     *
     * @return \DateTime 
     */
    public function getEpisodeScreeningDate()
    {
        return $this->episodeScreeningDate;
    }

    /**
     * Set originalDataSupersede
     *
     * @param string $originalDataSupersede
     * @return Episodes
     */
    public function setOriginalDataSupersede($originalDataSupersede)
    {
        $this->originalDataSupersede = $originalDataSupersede;

        return $this;
    }

    /**
     * Get originalDataSupersede
     *
     * @return string 
     */
    public function getOriginalDataSupersede()
    {
        return $this->originalDataSupersede;
    }

    /**
     * Set episodeEssentialCountTotal
     *
     * @param float $episodeEssentialCountTotal
     * @return Episodes
     */
    public function setEpisodeEssentialCountTotal($episodeEssentialCountTotal)
    {
        $this->episodeEssentialCountTotal = $episodeEssentialCountTotal;

        return $this;
    }

    /**
     * Get episodeEssentialCountTotal
     *
     * @return float 
     */
    public function getEpisodeEssentialCountTotal()
    {
        return $this->episodeEssentialCountTotal;
    }

    /**
     * Set episodeNotEssentialCountTotal
     *
     * @param float $episodeNotEssentialCountTotal
     * @return Episodes
     */
    public function setEpisodeNotEssentialCountTotal($episodeNotEssentialCountTotal)
    {
        $this->episodeNotEssentialCountTotal = $episodeNotEssentialCountTotal;

        return $this;
    }

    /**
     * Get episodeNotEssentialCountTotal
     *
     * @return float 
     */
    public function getEpisodeNotEssentialCountTotal()
    {
        return $this->episodeNotEssentialCountTotal;
    }

    /**
     * Set episodeStatus
     *
     * @param string $episodeStatus
     * @return Episodes
     */
    public function setEpisodeStatus($episodeStatus)
    {
        $this->episodeStatus = $episodeStatus;

        return $this;
    }

    /**
     * Get episodeStatus
     *
     * @return string 
     */
    public function getEpisodeStatus()
    {
        return $this->episodeStatus;
    }

    /**
     * Set episodeCreateBy
     *
     * @param integer $episodeCreateBy
     * @return Episodes
     */
    public function setEpisodeCreateBy($episodeCreateBy)
    {
        $this->episodeCreateBy = $episodeCreateBy;

        return $this;
    }

    /**
     * Get episodeCreateBy
     *
     * @return integer 
     */
    public function getEpisodeCreateBy()
    {
        return $this->episodeCreateBy;
    }

    /**
     * Set episodeCreatedOn
     *
     * @param \DateTime $episodeCreatedOn
     * @return Episodes
     */
    public function setEpisodeCreatedOn($episodeCreatedOn)
    {
        $this->episodeCreatedOn = $episodeCreatedOn;

        return $this;
    }

    /**
     * Get episodeCreatedOn
     *
     * @return \DateTime 
     */
    public function getEpisodeCreatedOn()
    {
        return $this->episodeCreatedOn;
    }

    /**
     * Set episodeUpdatedBy
     *
     * @param integer $episodeUpdatedBy
     * @return Episodes
     */
    public function setEpisodeUpdatedBy($episodeUpdatedBy)
    {
        $this->episodeUpdatedBy = $episodeUpdatedBy;

        return $this;
    }

    /**
     * Get episodeUpdatedBy
     *
     * @return integer 
     */
    public function getEpisodeUpdatedBy()
    {
        return $this->episodeUpdatedBy;
    }

    /**
     * Set episodeUpdatedOn
     *
     * @param \DateTime $episodeUpdatedOn
     * @return Episodes
     */
    public function setEpisodeUpdatedOn($episodeUpdatedOn)
    {
        $this->episodeUpdatedOn = $episodeUpdatedOn;

        return $this;
    }

    /**
     * Get episodeUpdatedOn
     *
     * @return \DateTime 
     */
    public function getEpisodeUpdatedOn()
    {
        return $this->episodeUpdatedOn;
    }

    /**
     * Get episodeId
     *
     * @return integer 
     */
    public function getEpisodeId()
    {
        return $this->episodeId;
    }

    /**
     * Set episodeSeason
     *
     * @param \EssentialTv\EtvBundle\Entity\Seasons $episodeSeason
     * @return Episodes
     */
    public function setEpisodeSeason(\EssentialTv\EtvBundle\Entity\Seasons $episodeSeason = null)
    {
        $this->episodeSeason = $episodeSeason;

        return $this;
    }

    /**
     * Get episodeSeason
     *
     * @return \EssentialTv\EtvBundle\Entity\Seasons 
     */
    public function getEpisodeSeason()
    {
        return $this->episodeSeason;
    }

    /**
     * Set episodeShow
     *
     * @param \EssentialTv\EtvBundle\Entity\Shows $episodeShow
     * @return Episodes
     */
    public function setEpisodeShow(\EssentialTv\EtvBundle\Entity\Shows $episodeShow = null)
    {
        $this->episodeShow = $episodeShow;

        return $this;
    }

    /**
     * Get episodeShow
     *
     * @return \EssentialTv\EtvBundle\Entity\Shows 
     */
    public function getEpisodeShow()
    {
        return $this->episodeShow;
    }
        
    /**
     * @var integer
     */
    public $episodeSeasonId;


    /**
     * Set episodeSeasonId
     *
     * @param integer $episodeSeasonId
     * @return Episodes
     */
    public function setEpisodeSeasonId($episodeSeasonId)
    {
        $this->episodeSeasonId = $episodeSeasonId;

        return $this;
    }

    /**
     * Get episodeSeasonId
     *
     * @return integer 
     */
    public function getEpisodeSeasonId()
    {
        return $this->episodeSeasonId;
    }
    /**
     * @var integer
     */
    public $episodeShowId;


    /**
     * Set episodeShowId
     *
     * @param integer $episodeShowId
     * @return Episodes
     */
    public function setEpisodeShowId($episodeShowId)
    {
        $this->episodeShowId = $episodeShowId;

        return $this;
    }

    /**
     * Get episodeShowId
     *
     * @return integer 
     */
    public function getEpisodeShowId()
    {
        return $this->episodeShowId;
    }
    
    /**
     * @var string
     */
    public $episodeVideoUrl;


    /**
     * Set episodeVideoUrl
     *
     * @param string $episodeShowId
     * @return Episodes
     */
    public function setEpisodeVideoUrl($episodeVideoUrl)
    {
        $this->episodeVideoUrl = $episodeVideoUrl;

        return $this;
    }

    /**
     * Get episodeVideoUrl
     *
     * @return string 
     */
    public function getEpisodeVideoUrl()
    {
        return $this->episodeVideoUrl;
    }
}
