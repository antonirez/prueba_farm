<?php

/**
 * Envía una notificación por email a un usuario
 */

namespace App\Service;

use App\Entity\User;
use App\Provider\SesProvider;
use App\Provider\SmtpProvider;

class NotificationService
{
    private $mailerProvider;

    //Establece proveedor de envío a smtp
    public function setSmtp(SmtpProvider $mailerProvider)
    {
        $this->mailerProvider = $mailerProvider;
    }

    //Establece proveedor de envío a ses
    public function setSes(SesProvider $mailerProvider)
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