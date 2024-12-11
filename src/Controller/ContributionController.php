<?php

namespace App\Controller;


use App\Entity\Contribution;
use App\Form\ContributionType;
use App\Repository\ContributionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContributionController extends AbstractController
{
  #[Route('/contribu', name: 'contribution_contribu', methods:['GET', 'POST'])]
    public function contribu(Request $request, ContributionRepository $ContributionRepository): Response
    {
        $contribution = new Contribution();
        $form = $this->createForm(ContributionType::class, $contribution);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          $ContributionRepository->save($contribution, true);
            return $this->redirectToRoute('projet_index');
        }
        return $this->render('contribution/contribu.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

}
