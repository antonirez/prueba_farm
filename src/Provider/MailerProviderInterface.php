<?php

namespace App\Provider;


interface MailerProviderInterface
{
    /**
     * @param $email
     * @param $message
     * @return bool
     */
    public function send($email, $message);
}