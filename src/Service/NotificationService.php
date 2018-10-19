<?php

/**
 * Envía una notificación por email a un usuario
 */

namespace App\Service;

use App\Entity\User;
use App\Provider\MailerProviderInterface;

class NotificationService
{
    private $mailerProvider;

    public function __construct(MailerProviderInterface $mailerProvider)
    {
        $this->mailerProvider = $mailerProvider;
    }

    //Notifica a usuario
    public function notify(User $user, $message)
    {
        //Envía mensaje
        return $this->mailerProvider->send($user->getEmail(), $message);
    }

}