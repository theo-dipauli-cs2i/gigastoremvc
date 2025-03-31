<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BookController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(EntityManagerInterface $em): Response
    {
        $livres = $em->getRepository(Livre::class)->findAll();
        return $this->render('book/catalog.html.twig', [
            'livres' => $livres,
        ]);
    }

    #[Route('/detail-livre/{id}', name: 'app_detail_livre')]
    public function detailLivre(EntityManagerInterface $em,$id): Response
    {
        $livre = $em->getRepository(Livre::class)->find($id);
        return $this->render('book/book-detail.html.twig', [
            'livre' => $livre,
        ]);
    }
}
