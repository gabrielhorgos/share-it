<?php

namespace Shareit\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domain
 */
class Domain
{
    private $id;
    private $name;
    private $shortDescription;
    private $description;
    private $createdAt;
    private $nrOfFollowers;

    function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->nrOfFollowers = 0;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
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
     * Set name
     *
     * @param string $name
     * @return Domain
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Domain
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set nrOfFollowers
     *
     * @param integer $nrOfFollowers
     * @return Domain
     */
    public function setNrOfFollowers($nrOfFollowers)
    {
        $this->nrOfFollowers = $nrOfFollowers;

        return $this;
    }

    /**
     * Get nrOfFollowers
     *
     * @return integer
     */
    public function getNrOfFollowers()
    {
        return $this->nrOfFollowers;
    }
}
