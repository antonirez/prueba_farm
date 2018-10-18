<?php

namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SendNotificationCommand extends Command
{
    protected static $defaultName = 'send:notification';

    protected function configure()
    {
        $this
            ->setName($this::$defaultName)
            ->setDescription('Envía notificación a un usuario.')
            ->addArgument('user_id', InputArgument::REQUIRED, 'ID de usuario')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getArgument('user_id');

        //Creo el servicio de notificación
        $notificationService = $this->getApplication()->getKernel()->getContainer()->get('app.service.notification.ses');

        //Creo usuario. En esta prueba el usuario siempre tiene ID 1
        $user = new User();

        //Creo mensaje
        $message = 'Bienvenido a esta aplicación de prueba, ' . $user->getName() . '. Esto es un mensaje enviado desde un comando.';

        //Envío notificación a usuario
        $notifyResult = $notificationService->notify($user, $message);

        //Devuelvo datos en formato json
        $output->writeln([
            'id: ' . $user->getId(),
            'email: ' . $user->getEmail(),
            'message: ' . $message,
            'result: ' . (($notifyResult) ? 'sent' : 'not sent')
        ]);
    }
}
