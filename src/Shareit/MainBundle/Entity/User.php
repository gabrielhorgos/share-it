<?php

namespace Shareit\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class User
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $plainPassword;
    protected $createdAt;
    protected $updatedAt;
    protected $passwordUpdatedAt;
    protected $roles;
    protected $profile;
    protected $posts;
    protected $comments;

    public function __toString()
    {
        return $this->username;
    }

    function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->updatedAt = new \Datetime();
        $this->passwordUpdatedAt = new \Datetime();
        $this->roles = array("ROLE_USER");
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setPasswordUpdatedAt($passwordUpdatedAt)
    {
        $this->passwordUpdatedAt = $passwordUpdatedAt;

        return $this;
    }

    public function getPasswordUpdatedAt()
    {
        return $this->passwordUpdatedAt;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}
