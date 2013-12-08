<?php

namespace Shareit\MainBundle\Services\Manager;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\User\UserInterface;
use Shareit\MainBundle\Entity\User;

class UserManager
{
    private $encoderFactory;
    private $em;

    public function __construct(EncoderFactory $encoderFactory, $em)
    {
        $this->encoderFactory = $encoderFactory;
        $this->em = $em;
    }

    /**
     * Updates a user password if a plain password is set.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function updatePassword(User $user)
    {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $user->setPassword(sha1($user->getPlainPassword()));
            $user->setPlainPassword(null);
        }
    }
}

