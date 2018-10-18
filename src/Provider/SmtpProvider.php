<?php

namespace App\Provider;


class SmtpProvider implements MailerProviderInterface
{
    /**
     * @param $email
     * @param $message
     * @return bool
     */
    public function send($email, $message)
    {
        //TODO hacer cosas...

        return true; //En esta prueba este proveedor siempre devuelve true
    }
}