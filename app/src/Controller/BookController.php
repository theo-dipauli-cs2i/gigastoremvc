<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;   
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BookController extends AbstractController
{
    #[Route('/catalogue/{genre_actuel?}', name: 'app_catalogue')]
    public function index(EntityManagerInterface $em, ?string $genre_actuel): Response
    {
        $genres = $em->getRepository(Genre::class)->findAll();

        if ($genre_actuel) {
            $livres = $em->getRepository(Livre::class)->findByGenre($genre_actuel);
        } else {
            $livres = $em->getRepository(Livre::class)->findAll();
        }

        return $this->render('book/catalog.html.twig', [
            'livres' => $livres,
            'genre_actuel' => $genre_actuel,
            'genres' => $genres,
            
        ]);
    }


    #[Route('/detail-livre/{id}', name: 'app_detail_livre')]
    public function detailLivre(EntityManagerInterface $em,Request $request, $id): Response
    {
        $livre = $em->getRepository(Livre::class)->find($id);
        $commentaires = $em->getRepository(Commentaire::class)->findCommentaire($id);

        $commentaire = new Commentaire();
        $formulaire = $this->createForm(CommentaireType::class,data: $commentaire);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() and $formulaire->isValid()){
            $commentaire->setDateCommentaire(new \DateTimeImmutable());
            $commentaire->setLivreId($livre);
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('app_detail_livre', ['id' => $id]);
        }

        return $this->render('book/book-detail.html.twig', [
            'livre' => $livre,
            'commentaires' => $commentaires,
            'vueFormulaire' => $formulaire->createView()
        ]);
    }

    #[Route('/nouveautes', name: 'app_nouveautes')]
    public function nouveautes(EntityManagerInterface $em): Response
    {
        $nouveautes = $em->getRepository(Livre::class)->findBy(
            ['nouveaute' => 1],
            ['id' => 'ASC'],
            3
        );
        return $this->render('partials/nouveautes.html.twig', [
           'nouveautes' => $nouveautes
        ]);
    }
}
