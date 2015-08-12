<?php

namespace EssentialTv\EtvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 */
class City
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $district;

    /**
     * @var integer
     */
    private $population;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \EssentialTv\EtvBundle\Entity\Country
     */
    private $countrycode;


    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return City
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set population
     *
     * @param integer $population
     * @return City
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return integer 
     */
    public function getPopulation()
    {
        return $this->population;
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

    /**
     * Set countrycode
     *
     * @param \EssentialTv\EtvBundle\Entity\Country $countrycode
     * @return City
     */
    public function setCountrycode(\EssentialTv\EtvBundle\Entity\Country $countrycode = null)
    {
        $this->countrycode = $countrycode;

        return $this;
    }

    /**
     * Get countrycode
     *
     * @return \EssentialTv\EtvBundle\Entity\Country 
     */
    public function getCountrycode()
    {
        return $this->countrycode;
    }
}
