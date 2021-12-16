<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact ->setName('bell');
        $contact->setPrenom('magalie clementine');
        $contact->setEmail('sincere@gmail.com');
        $contact->setMessage('je ne sais pas');
        $contact->setSujet('concours');
        $contact->setNewsletter('rien');

        $manager->persist($contact);


        for ($i = 1; $i <= 4; $i++)
        {
            $article = new Article;
            $article->setNom("Bref $i");
            $article->setSlug("Bienv $i");
            $article->setContenu("sijdijdi $i");
            $manager->persist($article);
        }




        $manager->flush();
    }
}
