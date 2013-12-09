<?php

namespace Shareit\MainBundle\Services\Manager;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\User\UserInterface;
use Shareit\MainBundle\Entity\User;

class UserManager
{
    private $encoderFactory;
    private $em;
    private $kernel;

    public function __construct(EncoderFactory $encoderFactory, $em, $kernel)
    {
        $this->encoderFactory = $encoderFactory;
        $this->em = $em;
        $this->kernel = $kernel;
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

    public function handleFileUpload($file, $dir = '')
    {
        $allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($file->guessExtension(), $allowedExtensions)) {
            $uploadDir = $this->kernel . '/../web/uploads/' . $dir;
            $filename = sha1(uniqid(mt_rand(), true)) . '.' . $file->guessExtension();
            $file->move($uploadDir, $filename);

            return $filename;
        }

        return '';
    }
}

