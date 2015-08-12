<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaggedAppearance
 *
 * @ORM\Table(name="tagged_appearance", indexes={@ORM\Index(name="TA_character_id", columns={"TA_character_id", "TA_episode_id"}), @ORM\Index(name="TA_episode_id", columns={"TA_episode_id"}), @ORM\Index(name="TA_show_id", columns={"TA_show_id"}), @ORM\Index(name="IDX_E3A296394B990E6F", columns={"TA_character_id"})})
 * @ORM\Entity
 */
class TaggedAppearance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="TA_apperance_count", type="integer", nullable=false)
     */
    private $taApperanceCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="TA_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taId;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Shows
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Shows")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TA_show_id", referencedColumnName="show_id")
     * })
     */
    private $taShow;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Episodes
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Episodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TA_episode_id", referencedColumnName="episode_id")
     * })
     */
    private $taEpisode;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Characters
     *
     * @ORM\ManyToOne(targetEntity="EssentialTv\EtvBundle\Entity\Characters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TA_character_id", referencedColumnName="character_id")
     * })
     */
    private $taCharacter;



    /**
     * Set taApperanceCount
     *
     * @param integer $taApperanceCount
     * @return TaggedAppearance
     */
    public function setTaApperanceCount($taApperanceCount)
    {
        $this->taApperanceCount = $taApperanceCount;

        return $this;
    }

    /**
     * Get taApperanceCount
     *
     * @return integer 
     */
    public function getTaApperanceCount()
    {
        return $this->taApperanceCount;
    }

    /**
     * Get taId
     *
     * @return integer 
     */
    public function getTaId()
    {
        return $this->taId;
    }

    /**
     * Set taShow
     *
     * @param \EssentialTv\EtvBundle\Entity\Shows $taShow
     * @return TaggedAppearance
     */
    public function setTaShow(\EssentialTv\EtvBundle\Entity\Shows $taShow = null)
    {
        $this->taShow = $taShow;

        return $this;
    }

    /**
     * Get taShow
     *
     * @return \EssentialTv\EtvBundle\Entity\Shows 
     */
    public function getTaShow()
    {
        return $this->taShow;
    }

    /**
     * Set taEpisode
     *
     * @param \EssentialTv\EtvBundle\Entity\Episodes $taEpisode
     * @return TaggedAppearance
     */
    public function setTaEpisode(\EssentialTv\EtvBundle\Entity\Episodes $taEpisode = null)
    {
        $this->taEpisode = $taEpisode;

        return $this;
    }

    /**
     * Get taEpisode
     *
     * @return \EssentialTv\EtvBundle\Entity\Episodes 
     */
    public function getTaEpisode()
    {
        return $this->taEpisode;
    }

    /**
     * Set taCharacter
     *
     * @param \EssentialTv\EtvBundle\Entity\Characters $taCharacter
     * @return TaggedAppearance
     */
    public function setTaCharacter(\EssentialTv\EtvBundle\Entity\Characters $taCharacter = null)
    {
        $this->taCharacter = $taCharacter;

        return $this;
    }

    /**
     * Get taCharacter
     *
     * @return \EssentialTv\EtvBundle\Entity\Characters 
     */
    public function getTaCharacter()
    {
        return $this->taCharacter;
    }
    /**
     * @var integer
     */
    private $taShowId;

    /**
     * @var integer
     */
    private $taCharacterId;

    /**
     * @var integer
     */
    private $taEpisodeId;


    /**
     * Set taShowId
     *
     * @param integer $taShowId
     * @return TaggedAppearance
     */
    public function setTaShowId($taShowId)
    {
        $this->taShowId = $taShowId;

        return $this;
    }

    /**
     * Get taShowId
     *
     * @return integer 
     */
    public function getTaShowId()
    {
        return $this->taShowId;
    }

    /**
     * Set taCharacterId
     *
     * @param integer $taCharacterId
     * @return TaggedAppearance
     */
    public function setTaCharacterId($taCharacterId)
    {
        $this->taCharacterId = $taCharacterId;

        return $this;
    }

    /**
     * Get taCharacterId
     *
     * @return integer 
     */
    public function getTaCharacterId()
    {
        return $this->taCharacterId;
    }

    /**
     * Set taEpisodeId
     *
     * @param integer $taEpisodeId
     * @return TaggedAppearance
     */
    public function setTaEpisodeId($taEpisodeId)
    {
        $this->taEpisodeId = $taEpisodeId;

        return $this;
    }

    /**
     * Get taEpisodeId
     *
     * @return integer 
     */
    public function getTaEpisodeId()
    {
        return $this->taEpisodeId;
    }
}
