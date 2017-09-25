<?php

namespace Als\PlateformBundle\DoctrineListener;


use Als\PlateformBundle\Entity\Application;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ApplicationNotification
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!($entity instanceof Application)) return ;

        $message = new \Swift_Mailer(
            'Nouvelle Candidature',
            'Bonjour, \n vous avez une nouvelle candidature'
        );

        $message
            ->addTo('amly212782@gmail.com')
            ->addFrom('amlei212782@gmail.com')
        ;

        $this->mailer->send($message);
    }

}