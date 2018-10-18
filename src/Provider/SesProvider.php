<?php

namespace App\Provider;


class SesProvider implements MailerProviderInterface
{
    /**
     * @param $email
     * @param $message
     * @return bool
     */
    public function send($email, $message)
    {
        //TODO hacer cosas...

        return false; //En esta prueba este proveedor siempre devuelve false
    }
}