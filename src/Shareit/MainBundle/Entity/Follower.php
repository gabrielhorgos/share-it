<?php

namespace Shareit\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Follower
{
    protected $id;
    protected $followedAt;
    protected $domain;
    protected $user;

    function __construct()
    {
        $this->followedAt= new \DateTime();
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFollowedAt($followedAt)
    {
        $this->followedAt = $followedAt;
    }

    public function getFollowedAt()
    {
        return $this->followedAt;
    }

}
