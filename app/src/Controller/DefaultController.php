<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', []);
    }

    #[Route('/livres', name: 'app_livres')]
    public function livres(): Response
    {
        return $this->underConstruction();
    }

    #[Route('/dvd', name: 'app_dvd')]
    public function dvd(): Response
    {
        return $this->underConstruction();
    }

    #[Route('/spectacles', name: 'app_spectacles')]
    public function spectacles(): Response
    {
        return $this->underConstruction();
    }

    #[Route('/informatique', name: 'app_informatique')]
    public function informatique(): Response
    {
        return $this->underConstruction();
    }

    #[Route('/about-us', name: 'app_about-us')]
    public function aboutUs(): Response
    {

        return $this->render('default/about-us.html.twig', []);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {

        return $this->render('default/contact.html.twig', []);
    }

    private function underConstruction(): Response
    {
        return $this->render('default/under-construction.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
