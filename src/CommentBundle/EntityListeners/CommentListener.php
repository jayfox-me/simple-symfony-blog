<?php

namespace CommentBundle\EntityListeners;

use CommentBundle\Entity\Comment;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CommentListener extends Controller
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function prePersist(Comment $comment, LifecycleEventArgs $event)
    {
        $message = (new \Swift_Message('Hello Email'));
        $message ->setFrom('web-server@e-krit.ru')
            ->setTo('simkin@e-krit.ru')
            ->setBody('hi');

        $f = $this->mailer->send($message);
    }
}