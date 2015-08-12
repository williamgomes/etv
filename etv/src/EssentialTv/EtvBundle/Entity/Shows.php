<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Shows
 *
 * @ORM\Table(name="shows")
 * @ORM\Entity
 */
class Shows
{
    /**
     * @var string
     *
     * @ORM\Column(name="show_tms_id", type="string", length=255, nullable=false)
     */
    private $showTmsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_api_id", type="integer", nullable=false)
     */
    private $showApiId;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_season_total", type="integer", nullable=false)
     */
    private $showSeasonTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_episode_total", type="integer", nullable=false)
     */
    private $showEpisodeTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="show_genres", type="text", nullable=false)
     */
    private $showGenres;

    /**
     * @var string
     *
     * @ORM\Column(name="show_theme", type="text", nullable=false)
     */
    private $showTheme;

    /**
     * @var string
     *
     * @ORM\Column(name="show_title", type="text", nullable=false)
     */
    private $showTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="show_original_summary", type="text", nullable=false)
     */
    private $showOriginalSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="show_api_summary", type="text", nullable=false)
     */
    private $showApiSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="show_original_images", type="text",length=255, nullable=true)
     */
    private $showOriginalImages;

    /**
     * @var string
     *
     * @ORM\Column(name="show_api_images", type="text", nullable=false)
     */
    private $showApiImages;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_banner_image", type="text", nullable=false)
     */
    private $showBannerImage;

    /**
     * @var string
     *
     * @ORM\Column(name="show_alias_one", type="string", length=255, nullable=false)
     */
    private $showAliasOne;

    /**
     * @var string
     *
     * @ORM\Column(name="show_alias_two", type="string", length=255, nullable=false)
     */
    private $showAliasTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="show_status", type="string", nullable=false)
     */
    private $showStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="show_original_data_supersede", type="string", nullable=false)
     */
    private $showOriginalDataSupersede;

    /**
     * @var string
     *
     * @ORM\Column(name="show_auto_data_refresh", type="string", nullable=false)
     */
    private $showAutoDataRefresh;
    
     /**
     * @var Decimal
     *
     * @ORM\Column(name="shows_popularity", type="decimal", nullable=false)
     */
    private $showPopularity;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="shows_created_on", type="datetime", nullable=false)
     */
    private $showsCreatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="shows_created_by", type="integer", nullable=false)
     */
    private $showsCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="shows_updated_on", type="datetime", nullable=false)
     */
    private $showsUpdatedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="shows_updated_by", type="integer", nullable=false)
     */
    private $showsUpdatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $showId;

    

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Set showTmsId
     *
     * @param string $showTmsId
     * @return Shows
     */
    public function setShowTmsId($showTmsId)
    {
        $this->showTmsId = $showTmsId;

        return $this;
    }

    /**
     * Get showTmsId
     *
     * @return string 
     */
    public function getShowTmsId()
    {
        return $this->showTmsId;
    }

    /**
     * Set showApiId
     *
     * @param integer $showApiId
     * @return Shows
     */
    public function setShowApiId($showApiId)
    {
        $this->showApiId = $showApiId;

        return $this;
    }

    /**
     * Get showApiId
     *
     * @return integer 
     */
    public function getShowApiId()
    {
        return $this->showApiId;
    }

    /**
     * Set showSeasonTotal
     *
     * @param integer $showSeasonTotal
     * @return Shows
     */
    public function setShowSeasonTotal($showSeasonTotal)
    {
        $this->showSeasonTotal = $showSeasonTotal;

        return $this;
    }

    /**
     * Get showSeasonTotal
     *
     * @return integer 
     */
    public function getShowSeasonTotal()
    {
        return $this->showSeasonTotal;
    }

    /**
     * Set showEpisodeTotal
     *
     * @param integer $showEpisodeTotal
     * @return Shows
     */
    public function setShowEpisodeTotal($showEpisodeTotal)
    {
        $this->showEpisodeTotal = $showEpisodeTotal;

        return $this;
    }

    /**
     * Get showEpisodeTotal
     *
     * @return integer 
     */
    public function getShowEpisodeTotal()
    {
        return $this->showEpisodeTotal;
    }

    /**
     * Set showGenres
     *
     * @param string $showGenres
     * @return Shows
     */
    public function setShowGenres($showGenres)
    {
        $this->showGenres = $showGenres;

        return $this;
    }

    /**
     * Get showGenres
     *
     * @return string 
     */
    public function getShowGenres()
    {
        return $this->showGenres;
    }

    /**
     * Set showTheme
     *
     * @param string $showTheme
     * @return Shows
     */
    public function setShowTheme($showTheme)
    {
        $this->showTheme = $showTheme;

        return $this;
    }

    /**
     * Get showTheme
     *
     * @return string 
     */
    public function getShowTheme()
    {
        return $this->showTheme;
    }

    /**
     * Set showTitle
     *
     * @param string $showTitle
     * @return Shows
     */
    public function setShowTitle($showTitle)
    {
        $this->showTitle = $showTitle;

        return $this;
    }

    /**
     * Get showTitle
     *
     * @return string 
     */
    public function getShowTitle()
    {
        return $this->showTitle;
    }

    /**
     * Set showOriginalSummary
     *
     * @param string $showOriginalSummary
     * @return Shows
     */
    public function setShowOriginalSummary($showOriginalSummary)
    {
        $this->showOriginalSummary = $showOriginalSummary;

        return $this;
    }

    /**
     * Get showOriginalSummary
     *
     * @return string 
     */
    public function getShowOriginalSummary()
    {
        return $this->showOriginalSummary;
    }

    /**
     * Set showApiSummary
     *
     * @param string $showApiSummary
     * @return Shows
     */
    public function setShowApiSummary($showApiSummary)
    {
        $this->showApiSummary = $showApiSummary;

        return $this;
    }

    /**
     * Get showApiSummary
     *
     * @return string 
     */
    public function getShowApiSummary()
    {
        return $this->showApiSummary;
    }

    /**
     * Set showOriginalImages
     *
     * @param string $showOriginalImages
     * @return Shows
     */
    public function setShowOriginalImages($showOriginalImages)
    {
        $this->showOriginalImages = $showOriginalImages;

        return $this;
    }

    /**
     * Get showOriginalImages
     *
     * @return string 
     */
    public function getShowOriginalImages()
    {
        return $this->showOriginalImages;
    }

    /**
     * Set showApiImages
     *
     * @param string $showApiImages
     * @return Shows
     */
    public function setShowApiImages($showApiImages)
    {
        $this->showApiImages = $showApiImages;

        return $this;
    }

    /**
     * Get showApiImages
     *
     * @return string 
     */
    public function getShowApiImages()
    {
        return $this->showApiImages;
    }

    /**
     * Set showBannerImage
     *
     * @param integer $showBannerImage
     * @return Shows
     */
    public function setShowBannerImage($showBannerImage)
    {
        $this->showBannerImage = $showBannerImage;

        return $this;
    }

    /**
     * Get showBannerImage
     *
     * @return integer 
     */
    public function getShowBannerImage()
    {
        return $this->showBannerImage;
    }

    /**
     * Set showAliasOne
     *
     * @param string $showAliasOne
     * @return Shows
     */
    public function setShowAliasOne($showAliasOne)
    {
        $this->showAliasOne = $showAliasOne;

        return $this;
    }

    /**
     * Get showAliasOne
     *
     * @return string 
     */
    public function getShowAliasOne()
    {
        return $this->showAliasOne;
    }

    /**
     * Set showAliasTwo
     *
     * @param string $showAliasTwo
     * @return Shows
     */
    public function setShowAliasTwo($showAliasTwo)
    {
        $this->showAliasTwo = $showAliasTwo;

        return $this;
    }

    /**
     * Get showAliasTwo
     *
     * @return string 
     */
    public function getShowAliasTwo()
    {
        return $this->showAliasTwo;
    }

    /**
     * Set showStatus
     *
     * @param string $showStatus
     * @return Shows
     */
    public function setShowStatus($showStatus)
    {
        $this->showStatus = $showStatus;

        return $this;
    }

    /**
     * Get showStatus
     *
     * @return string 
     */
    public function getShowStatus()
    {
        return $this->showStatus;
    }

    /**
     * Set showOriginalDataSupersede
     *
     * @param string $showOriginalDataSupersede
     * @return Shows
     */
    public function setShowOriginalDataSupersede($showOriginalDataSupersede)
    {
        $this->showOriginalDataSupersede = $showOriginalDataSupersede;

        return $this;
    }

    /**
     * Get showOriginalDataSupersede
     *
     * @return string 
     */
    public function getShowOriginalDataSupersede()
    {
        return $this->showOriginalDataSupersede;
    }

    /**
     * Set showAutoDataRefresh
     *
     * @param string $showAutoDataRefresh
     * @return Shows
     */
    public function setShowAutoDataRefresh($showAutoDataRefresh)
    {
        $this->showAutoDataRefresh = $showAutoDataRefresh;

        return $this;
    }

    /**
     * Get showAutoDataRefresh
     *
     * @return string 
     */
    public function getShowAutoDataRefresh()
    {
        return $this->showAutoDataRefresh;
    }

    /**
     * Set showsCreatedOn
     *
     * @param \DateTime $showsCreatedOn
     * @return Shows
     */
    public function setShowsCreatedOn($showsCreatedOn)
    {
        $this->showsCreatedOn = $showsCreatedOn;

        return $this;
    }

    /**
     * Get showsCreatedOn
     *
     * @return \DateTime 
     */
    public function getShowsCreatedOn()
    {
        return $this->showsCreatedOn;
    }

    /**
     * Set showsCreatedBy
     *
     * @param integer $showsCreatedBy
     * @return Shows
     */
    public function setShowsCreatedBy($showsCreatedBy)
    {
        $this->showsCreatedBy = $showsCreatedBy;

        return $this;
    }

    /**
     * Get showsCreatedBy
     *
     * @return integer 
     */
    public function getShowsCreatedBy()
    {
        return $this->showsCreatedBy;
    }

    /**
     * Set showsUpdatedOn
     *
     * @param \DateTime $showsUpdatedOn
     * @return Shows
     */
    public function setShowsUpdatedOn($showsUpdatedOn)
    {
        $this->showsUpdatedOn = $showsUpdatedOn;

        return $this;
    }

    /**
     * Get showsUpdatedOn
     *
     * @return \DateTime 
     */
    public function getShowsUpdatedOn()
    {
        return $this->showsUpdatedOn;
    }

    /**
     * Set showsUpdatedBy
     *
     * @param integer $showsUpdatedBy
     * @return Shows
     */
    public function setShowsUpdatedBy($showsUpdatedBy)
    {
        $this->showsUpdatedBy = $showsUpdatedBy;

        return $this;
    }

    /**
     * Get showsUpdatedBy
     *
     * @return integer 
     */
    public function getShowsUpdatedBy()
    {
        return $this->showsUpdatedBy;
    }
        /**
     * Set showPopularity
     *
     * @param decimal showPopularity
     * @return Shows
     */
    public function setShowPopularity($showPopularity)
    {
        $this->showPopularity = $showPopularity;

        return $this;
    }

    /**
     * Get showPopularity
     *
     * @return decimal 
     */
    public function getShowPopularity()
    {
        return $this->showPopularity;
    }
    
    
    

    /**
     * Get showId
     *
     * @return integer 
     */
    public function getShowId()
    {
        return $this->showId;
    }
    
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->showOriginalImages
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'images/uploads/shows';
    }
    
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $filearry = json_decode($this->showOriginalImages);
        if(!is_array($filearry))
        {
            $filearry = [];
        }
        $filearry[] = $this->getWebPath().$this->getFile()->getClientOriginalName();
        $this->showOriginalImages = json_encode($filearry);

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
