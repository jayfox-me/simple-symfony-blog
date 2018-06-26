<?php

namespace PageBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use PageBundle\Entity\Page;
use TermBundle\DataFixtures\ORM\CommentLoad;
use TermBundle\Entity\Term;

class PageLoad extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $termRepo = $manager->getRepository(Term::class);
        $response = file_get_contents('https://jsonplaceholder.typicode.com/posts');

        foreach (json_decode($response, true) as $index => $post) {
            $i = $index%3 + 1;
            $page = new Page();
            $page->setTitle($post['title']);
            $page->setBody($post['body']);
            $page->setExternalId($post['id']);
            $term = $termRepo->findOneByName("Category $i");

            if ($term) {
                $page->setCategory($term);
            }
            $manager->persist($page);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TermLoad::class
        ];
    }
}