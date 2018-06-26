<?php

namespace TermBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use TermBundle\Entity\Term;

class TermLoad extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=3; $i++) {
            $term = new Term();
            $term->setName("Category $i");
            $term->setDescription("Description $i");
            $manager->persist($term);
        }

        $manager->flush();
    }
}