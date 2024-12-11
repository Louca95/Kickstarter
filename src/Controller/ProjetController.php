<?php

namespace App\Controller;

use App\Entity\Projet;
// use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'projet_index')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll();
        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    #[Route('/projet/{titre}', name: 'projet_show')]
    public function show(string $titre, ProjetRepository $projetRepository): Response
    {
        $projet = $projetRepository->findOneBy(['titre' => $titre]);

        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }
    
    #[Route('/new', name: 'projet_new', methods:['GET', 'POST'])]
    public function new(Request $request, ProjetRepository $projetRepository): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $projetRepository->save($projet, true);
            return $this->redirectToRoute('projet_index');
        }
        return $this->render('projet/new.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    #[Route("/projet/{id}/supprimer", name:"projet_delete", methods:["POST"])]
     
    public function delete(Projet $projet, EntityManagerInterface $entityManager): RedirectResponse
    {
        // Supprimer le projet de la base de données
        $entityManager->remove($projet);
        $entityManager->flush();

        // Rediriger vers la liste des projets
        $this->addFlash('success', 'Le projet a été supprimé avec succès.');
        return $this->redirectToRoute('projet_index');
    }

    

    // #[Route('/home', name: 'home_page', methods:['GET', 'POST'])]
}
