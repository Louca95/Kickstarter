<?php

namespace App\Controller;

use App\Entity\Contribution;
use App\Form\ContributionType;
use App\Repository\ContributionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContributionController extends AbstractController
{
  #[Route('/contribu', name: 'contribution_contribu', methods: ['GET', 'POST'])]
public function contribu(
    Request $request,
    EntityManagerInterface $entityManager,
    ContributionRepository $contributionRepository
): Response {
    $contribution = new Contribution();
    $form = $this->createForm(ContributionType::class, $contribution);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($contribution);
        $entityManager->flush();

        // Redirection vers contribution_view avec l'ID du projet associé
        return $this->redirectToRoute('contribution_view', [
            'id' => $contribution->getProjet()->getId(),
        ]);
    }

    // Récupération des contributions liées à un projet (si applicable)
    $contributions = [];
    if ($contribution->getProjet()) {
        $contributions = $contributionRepository->findBy(['projet' => $contribution->getProjet()]);
    }

    return $this->render('contribution/contribu.html.twig', [
        'form' => $form->createView(),
        'contributions' => $contributions, // Transmettre contributions au template
    ]);
}


    #[Route('/contribution/projet/{id}', name: 'contribution_view', methods: ['GET'])]
    public function view(int $id, ContributionRepository $contributionRepository): Response
    {
      $contributions = $contributionRepository->findBy(['projet' => $id]);

    return $this->render('contribution/view.html.twig', [
        'contributions' => $contributions?: [],
        'projetId' => $id,
    ]);
}

    
}