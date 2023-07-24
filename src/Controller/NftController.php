<?php

namespace App\Controller;

use App\Entity\Nft;
use App\Form\NftType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class NftController extends AbstractController
{
    #[Route('/nft', name: 'app_nft')]
    public function index(): Response
    {
        return $this->render('nft/index.html.twig', [
            'controller_name' => 'NftController',
        ]);
    }

    #[Route('/nft/account', name: 'app_nft_user')]
    #[IsGranted('ROLE_USER')]
    public function nftUserId(): Response
    {
        return $this->render('nft/index.html.twig', [
            'controller_name' => 'NftController',
        ]);
    }

    #[Route('/nft/add', name: 'app_nft_form')]
    #[IsGranted('ROLE_USER')]
    public function nftAjout(): Response
    {
        $form = $this->createForm(NftType::class, new Nft());

        return $this->render('nft/form.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
