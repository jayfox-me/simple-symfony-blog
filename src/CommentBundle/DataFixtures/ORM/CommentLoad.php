<?php

namespace CommentBundle\DataFixtures\ORM;

use CommentBundle\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use PageBundle\DataFixtures\ORM\PageLoad;
use PageBundle\Entity\Page;

class CommentLoad extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $pageRepo = $manager->getRepository(Page::class);
        $response = file_get_contents('https://jsonplaceholder.typicode.com/comments');

        foreach (json_decode($response, true) as $index => $commentData) {
            $comment = new Comment();
            $comment->setBody($commentData['body']);
            $comment->setEmail($commentData['email']);
            $page =  $pageRepo->findOneByExternalId($commentData['postId']);
            $comment->setPage($page);
            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PageLoad::class
        ];
    }
}