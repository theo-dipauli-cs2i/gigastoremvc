<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function contact(Request $request, SessionInterface $session): Response
    {
        $donnees = [];
        $formulaire = $this->createForm(ContactType::class, data: $donnees);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $data = $formulaire->getData();

            $session->set('contact_data', $data);

            return $this->redirectToRoute('app_contact_confirmation');
        }

        return $this->render('default/contact.html.twig', [
            'vueForm' => $formulaire->createView()
        ]);
    }

    #[Route('/contact/confirmation', name: 'app_contact_confirmation')]
    public function contactConfirmation(SessionInterface $session): Response
    {
        $data = $session->get('contact_data', []);

        return $this->render('default/contact-confirmation.html.twig', [
            'nom' => $data['Nom'] ?? '',
            'email' => $data['Email'] ?? '',
            'message' => $data['Message'] ?? ''
        ]);
    }


    private function underConstruction(): Response
    {
        return $this->render('default/under-construction.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
