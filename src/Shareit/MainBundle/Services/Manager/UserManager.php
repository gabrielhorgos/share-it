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
    private $container;

    public function __construct(EncoderFactory $encoderFactory, $em, $kernel, $container)
    {
        $this->encoderFactory = $encoderFactory;
        $this->em = $em;
        $this->kernel = $kernel;
        $this->container = $container;
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
        if ($file) {
            if (in_array($file->guessExtension(), $allowedExtensions)) {
                $uploadDir = $this->kernel . '/../web/uploads/' . $dir;
                $filename = sha1(uniqid(mt_rand(), true)) . '.' . $file->guessExtension();
                $file->move($uploadDir, $filename);

                return $filename;
            }
        }

        return '';
    }

    public function resetPassword($user)
    {
        $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
        $user->setPlainPassword($password);
        $this->updatePassword($user);
        $user->setPasswordUpdatedAt(new \DateTime());
        $this->em->flush();

        $this->sendRecoveryEmail($user->getEmail(), $password);
    }

    public function sendRecoveryEmail($email, $password)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('New password')
            ->setFrom('noreply@shareit.com')
            ->setContentType('text / html')
            ->setBody($this->container->get('templating')->render('ShareitMainBundle:Email:password_recovery.html.twig', array(
                'password' => $password,
            )), 'text/html')
            ->setTo($email);

        $this->container->get('mailer')->send($message);
    }
}

