<?php

namespace App\Controller;

use App\Entity\User;
use App\Provider\SmtpProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users/send_notification/{id}", name="user.send_notification")
     *
     * Envía notificación a usuario
     *
     * @param int $id
     * @return JsonResponse
     *
     */
    public function sendNotification($id)
    {
        //Establezco el proveedor de envío
        $mailerProvider = new SmtpProvider();
        $this->container->set('app.provider.mailer_provider', $mailerProvider);

        //Creo el servicio de notificación
        $notificationService = $this->get('app.service.notification');

        //Creo usuario. En esta prueba el usuario siempre tiene ID 1
        $user = new User();

        //Creo mensaje
        $message = 'Bienvenido a esta aplicación de prueba, ' . $user->getName() . '. Esto es un mensaje enviado desde un controlador.';

        //Envío notificación a usuario
        $notifyResult = $notificationService->notify($user, $message);

        //Devuelvo datos en formato json
        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'message' => $message,
            'result' => $notifyResult
        ]);
    }
}
