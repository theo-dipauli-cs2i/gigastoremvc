<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $livre = $manager->getRepository(Livre::class)->findOneBy(['id' => 'BK001']);
        $commentaire = new Commentaire();
        $commentaire
            ->setDateCommentaire(new \DateTime())
            ->setPseudonyme('JeanLecteur')
            ->setTitre('Super lecture')
            ->setCommentaire("J'ai adoré ce livre, vraiment captivant !")
            ->setLivreId($livre);

        $manager->persist($commentaire);
        $manager->flush();
    }
}
